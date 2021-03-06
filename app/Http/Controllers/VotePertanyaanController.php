<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Pertanyaan;
use Illuminate\Support\Facades\DB;
use Auth;

class VotePertanyaanController extends Controller
{
    public function up($id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);
        $user = $pertanyaan->user;
        
        $checkExist = $pertanyaan->vote->contains(Auth::user());
        if(!$checkExist){
            // jika tidak ada
            $pertanyaan->vote()->save(Auth::user(), ['vote_value' => 1]);
            $jumlah = 10 + $user->reputasi;
            $user->update(["reputasi" => $jumlah]);
            return redirect("/pertanyaan/$pertanyaan->id");
        }else{
            // jika udah menilai kemudian mendownkan vote
            $vote = DB::select(DB::raw("
                SELECT vote_value FROM vote_pertanyaans
                    WHERE user_id = :user_id
                    AND pertanyaan_id = :pertanyaan_id
            "),[
                "user_id"   => Auth::user()->id,
                "pertanyaan_id" => $pertanyaan->id,
            ])[0]->vote_value;
            if($vote == 0 && $checkExist){
                $jumlah = $user->reputasi + 11;
                DB::update(DB::raw(
                    "UPDATE vote_pertanyaans SET vote_value = :vote_value
                        WHERE 
                            user_id = :user_id     AND 
                            pertanyaan_id = :pertanyaan_id  
                    "
                ), [
                    "user_id"   => Auth::user()->id,
                    "pertanyaan_id" => $pertanyaan->id,
                    "vote_value"    => 1
                ]);
                $user->update(["reputasi" => $jumlah]);
                return redirect("/pertanyaan/$pertanyaan->id");
            }else{
                return redirect("/pertanyaan/$pertanyaan->id");
            }
        }
    }

    public function down($id)
    {
        $pertanyaan = Pertanyaan::findOrFail($id);
        $user = $pertanyaan->user;
        
        
        $checkExist = $pertanyaan->vote->contains(Auth::user());
        if(!$checkExist){
            // jika tidak ada
            $pertanyaan->vote()->save(Auth::user(), ['vote_value' => 0]);
            $jumlah = $user->reputasi - 1;
            $user->update(["reputasi" => $jumlah]);
            return redirect("/pertanyaan/$pertanyaan->id");
        }else{
            // jika ada 
            // jika udah menilai kemudian mendownkan vote
            $vote = DB::select(DB::raw("
                SELECT vote_value FROM vote_pertanyaans
                    WHERE user_id = :user_id
                    AND pertanyaan_id = :pertanyaan_id
            "),[
                "user_id"   => Auth::user()->id,
                "pertanyaan_id" => $pertanyaan->id,
            ])[0]->vote_value;
            if($vote == 1 && $checkExist){
                $jumlah = $user->reputasi - 11;
                DB::update(DB::raw(
                    "UPDATE vote_pertanyaans SET vote_value = :vote_value
                        WHERE 
                            user_id = :user_id     AND 
                            pertanyaan_id = :pertanyaan_id  
                    "
                ), [
                    "user_id"   => Auth::user()->id,
                    "pertanyaan_id" => $pertanyaan->id,
                    "vote_value"    => 0
                ]);
                $user->update(["reputasi" => $jumlah]);
                return redirect("/pertanyaan/$pertanyaan->id");
            }else{
                return redirect("/pertanyaan/$pertanyaan->id");
            }
        }
    }
}
