<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customers;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $datas = Customers::orderBy('id', 'desc')->get();
        $tittle = "Data customer";
        return view('customer.index', compact('datas', 'tittle'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tittle = "Tambah customer";
        return view('customer.create', compact('tittle'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Customers::create($request->all());
        return redirect()->to('customer');
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
        $tittle = "Edit customer";
        $customer = Customers::find($id); //KALO GA KETEMU BAKAL BLANK
        return view('customer.edit', compact('customer', 'tittle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = Customers::find($id);
        $customer->name = $request->name;
        $customer->phone = $request->phone;
        $customer->address = $request->address;

        $customer->save();
        return redirect()->to('customer');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customers::find($id);
        $customer->delete();
        return redirect()->to('customer');
    }
}
