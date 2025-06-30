<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TypeOfServices;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $datas = TypeOfServices::all();
        $datas = TypeOfServices::orderBy('id', 'desc')->get();
        $tittle = "Data Service";
        return view('service.index', compact('datas', 'tittle'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tittle = "Tambah Service";
        return view('service.create', compact('tittle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        TypeOfServices::create($request->all());
        return redirect()->to('service');
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
        $tittle = "Edit Service";
        $service = TypeOfServices::find($id); //KALO GA KETEMU BAKAL BLANK
        // $level = TypeOfServices::findOrFail($id); // KALO GA KETEMU BAKAL 404
        // $level = TypeOfServices::where('id', $id)->first();
        return view('service.edit', compact('service', 'tittle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $service = TypeOfServices::find($id);
        $service->service_name = $request->service_name;
        $service->price = $request->price;
        $service->description = $request->description;
        $service->save();
        return redirect()->to('service');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = TypeOfServices::find($id);
        $service->delete();
        return redirect()->to('service');
    }
}
