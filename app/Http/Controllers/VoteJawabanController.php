<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\User;
use App\Jawaban;
use Auth;

class VoteJawabanController extends Controller
{
    public function up($id, Request $req)
    {
        $jawaban = Jawaban::findOrFail($id);
        $user = $jawaban->user;
        $id_pertanyaan = $req->id_pertanyaan;
        
        $checkExist = $jawaban->vote->contains(Auth::user());
        if(!$checkExist){
            // jika tidak ada
            $jawaban->vote()->save(Auth::user(), ['vote_value' => 1]);
            $jumlah = 10 + $user->reputasi;
            $user->update(["reputasi" => $jumlah]);
            return redirect("/pertanyaan/$id_pertanyaan");
        }else{
            // jika udah menilai kemudian mendownkan vote
            $vote = DB::select(DB::raw("
                SELECT vote_value FROM vote_jawabans
                    WHERE user_id = :user_id
                    AND jawaban_id = :jawaban_id
            "),[
                "user_id"   => Auth::user()->id,
                "jawaban_id" => $jawaban->id,
            ])[0]->vote_value;
            if($vote == 0 && $checkExist){
                $jumlah = $user->reputasi + 11;
                DB::update(DB::raw(
                    "UPDATE vote_jawabans SET vote_value = :vote_value
                        WHERE 
                            user_id = :user_id     AND 
                            jawaban_id = :jawaban_id  
                    "
                ), [
                    "user_id"   => Auth::user()->id,
                    "jawaban_id" => $jawaban->id,
                    "vote_value"    => 1
                ]);
                $user->update(["reputasi" => $jumlah]);
                return redirect("/pertanyaan/$id_pertanyaan");
            }else{
                return redirect("/pertanyaan/$id_pertanyaan");
            }
        }
    }

    public function down($id, Request $req)
    {
        $jawaban = Jawaban::findOrFail($id);
        $user = $jawaban->user;
        $id_pertanyaan = $req->id_pertanyaan;
        
        
        $checkExist = $jawaban->vote->contains(Auth::user());
        if(!$checkExist){
            // jika tidak ada
            $jawaban->vote()->save(Auth::user(), ['vote_value' => 0]);
            $jumlah = $user->reputasi - 1;
            $user->update(["reputasi" => $jumlah]);
            return redirect("/pertanyaan/$id_pertanyaan");
        }else{
            // jika ada 
            // jika udah menilai kemudian mendownkan vote
            $vote = DB::select(DB::raw("
                SELECT vote_value FROM vote_jawabans
                    WHERE user_id = :user_id
                    AND jawaban_id = :jawaban_id
            "),[
                "user_id"   => Auth::user()->id,
                "jawaban_id" => $jawaban->id,
            ])[0]->vote_value;
            if($vote == 1 && $checkExist){
                $jumlah = $user->reputasi - 11;
                DB::update(DB::raw(
                    "UPDATE vote_jawabans SET vote_value = :vote_value
                        WHERE 
                            user_id = :user_id     AND 
                            jawaban_id = :jawaban_id  
                    "
                ), [
                    "user_id"   => Auth::user()->id,
                    "jawaban_id" => $jawaban->id,
                    "vote_value"    => 0
                ]);
                $user->update(["reputasi" => $jumlah]);
                return redirect("/pertanyaan/$id_pertanyaan");
            }else{
                return redirect("/pertanyaan/$id_pertanyaan");
            }
        }
    }
}
