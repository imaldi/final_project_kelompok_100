<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertanyaan;
use App\PertanyaanComment;
use App\JawabanComment;
use App\Tag;
use Auth;
use Illuminate\Support\Facades\DB;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pertanyaans = Pertanyaan::orderBy("created_at", "DESC")->get();
        $tags = Tag::all();
        return view("pertanyaan.index", compact("pertanyaans","tags"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        // dd($tags);
        return view("pertanyaan.create", compact("tags"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pertanyaan = Pertanyaan::create([
            "judul"     => $request->judul,
            "isi"       => $request->isi,
            "user_id"   => Auth::user()->id
        ]);
        
        // masih satu tag
        $tagArr = explode(",",$request->tag);
        // dd($tagArr);
        $tagsMulti = [];
        foreach($tagArr as $strTag){
            $tagArrAsc["tag_name"] = strtolower($strTag);
            $tagsMulti[] = $tagArrAsc;
        }

        foreach($tagsMulti as $tagCheck){
            $tag = Tag::firstOrCreate($tagCheck);
            $pertanyaan->tags()->attach($tag->id);
        }
        

        
        

        return redirect("/pertanyaan")->with("msg", "pertanyaan berhasil dibuat");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pertanyaan = Pertanyaan::with(["tags", "jawabans"])->findOrFail($id);
        $comments = PertanyaanComment::orderBy("created_at", "DESC")->get();
        $comments_jawaban = JawabanComment::orderBy("created_at","DESC")->get();
        
        $positif = DB::select(DB::raw(
            "SELECT COUNT(vote_value) AS positif FROM vote_pertanyaans
                WHERE 
                    pertanyaan_id = :pertanyaan_id   AND
                    vote_value = :vote_value
            "
        ), [
            
            "pertanyaan_id" => $pertanyaan->id,
            "vote_value"    => 1
        ])[0]->positif;

        $negatif = DB::select(DB::raw(
            "SELECT COUNT(vote_value) AS negatif FROM vote_pertanyaans
                WHERE 
                    pertanyaan_id = :pertanyaan_id   AND
                    vote_value = :vote_value
            "
        ),[
            "pertanyaan_id" => $pertanyaan->id,
            "vote_value"    => 0
        ])[0]->negatif;
        
        $jumlah = $positif - $negatif;
        // dd($positif);
        return view("pertanyaan.show", compact(["pertanyaan", "jumlah","comments","comments_jawaban"]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pertanyaan = Pertanyaan::with("tags")->findOrFail($id);
        $tag = Tag::get();

        return view("pertanyaan.edit", compact(["pertanyaan", "tag","id"]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pertanyaan = Pertanyaan::with("tags")->findOrFail($id);

        $pertanyaan->update([
            "judul"     => $request->judul,
            "isi"       => $request->isi,            
        ]);
        // for update m to m no replace
         // masih satu tag
         $tagArr = explode(",",$request->tag);
         // dd($tagArr);
         $tagsMulti = [];
         foreach($tagArr as $strTag){
             $tagArrAsc["tag_name"] = strtolower($strTag);
             $tagsMulti[] = $tagArrAsc;
         }
 
         $hasilTag = [];
         foreach($tagsMulti as $tagCheck){
             $tag = Tag::firstOrCreate($tagCheck);
             array_push($hasilTag, $tag->id);
         }
         $pertanyaan->tags()->sync($hasilTag);
        // $pertanyaan->tags()->sync($request->tag);
        return redirect("/pertanyaan")->with("msg", "pertanyaan berhasil diedit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pertanyaan = Pertanyaan::with("tags")->findOrFail($id);
        $pertanyaan->tags()->detach();
        $pertanyaan->delete();

        return redirect("/pertanyaan")->with("msg", "pertanyaan berhasil dihapus");
    }
    //@foreach($pertanyaans->tag as $p_tags) @if($pertanyaan->id == $p->id)selected="selected"@endif @endforeach
}
