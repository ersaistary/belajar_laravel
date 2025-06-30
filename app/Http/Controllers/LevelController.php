<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Levels;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $datas = Levels::all();
        $datas = Levels::orderBy('id', 'desc')->get();
        $tittle = "Data Level";
        return view('level.index', compact('datas', 'tittle'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tittle = "Tambah Level";
        return view('level.create', compact('tittle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Levels::create($request->all());
        return redirect()->to('level');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tittle = "Edit Level";
        $level = Levels::find($id); //KALO GA KETEMU BAKAL BLANK
        // $level = Levels::findOrFail($id); // KALO GA KETEMU BAKAL 404
        // $level = Levels::where('id', $id)->first();
        return view('level.edit', compact('level', 'tittle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $level = Levels::find($id);
        $level->name = $request->name;
        $level->save();
        return redirect()->to('level');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $level = Levels::find($id);
        $level->delete();
        return redirect()->to('level');
    }
}
