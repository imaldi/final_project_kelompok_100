<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Jawaban;
use Auth;
use App\JawabanComment;

class JawabanCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $jawaban = Jawaban::findOrFail($id);

        $jawaban->comment()->create([
            "isi"       => $request->comment_jawaban,
            "user_id"   => Auth::user()->id
        ]);

        return redirect("/pertanyaan/{$request->id_pertanyaan}");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $comment = JawabanComment::findOrFail($id);
        return view("commentJawaban.edit", compact("comment"));
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
        $comment = JawabanComment::findOrFail($id);
        $comment->update([
            "isi"   => $request->comment
        ]);
        
        return redirect("/pertanyaan/".$comment->jawaban->pertanyaan->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comment = JawabanComment::findOrFail($id);
        $comment->delete();
        
        return redirect("/pertanyaan/".$comment->jawaban->pertanyaan->id);
    }
}
