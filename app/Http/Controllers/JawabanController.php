<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Jawaban;
use App\Pertanyaan;

class JawabanController extends Controller
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
        $pertanyaan = Pertanyaan::findOrFail($id);

        $pertanyaan->jawabans()->create([
            "isi"       => $request->isi,
            "user_id"   => Auth::user()->id
        ]);

        return redirect("/pertanyaan/{$pertanyaan->id}")->with("msg", "terima kasih telah menjawab pertanyaan ini");
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
    public function edit($id, $idJawab)
    {
        Pertanyaan::findOrFail($id);
        $jawaban = Jawaban::findOrFail($idJawab);

        return view("jawaban.edit", compact("jawaban"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id, $idJawab)
    {
        Pertanyaan::findOrFail($id);
        $jawaban = Jawaban::findOrFail($idJawab);

        $jawaban->update([
            "isi"   => $request->isi
        ]);

        return redirect("/pertanyaan/$id")->with("msg", "jawaban berhasil di edit");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, $idJawab)
    {
        Pertanyaan::findOrFail($id);
        $jawaban = Jawaban::findOrFail($idJawab);
        $jawaban->delete();

        return redirect("/pertanyaan/$id")->with("msg", "jawaban berhasil dihapus");
    }
}
