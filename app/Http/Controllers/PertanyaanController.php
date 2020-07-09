<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Pertanyaan;
use App\Tag;
use Auth;

class PertanyaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pertanyaan = Pertanyaan::orderBy("created_at", "DESC")->get();
        return view("pertanyaan.index", compact("pertanyaan"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tag = Tag::get();
        return view("pertanyaan.create", compact("tag"));
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
        $pertanyaan->tags()->attach($pertanyaan);

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
        $pertanyaan = Pertanyaan::with("tags")->findOrFail($id);

        return view("pertanyaan.show", compact("pertanyaan"));
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

        return view("pertanyaan.edit", compact(["pertanyaan", "tag"]));
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
        $pertanyaan->tags()->sync($request->tag);
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
}
