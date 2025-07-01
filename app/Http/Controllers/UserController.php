<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $datas = User::orderBy('id', 'desc')->get();
        $tittle = "Data User";
        return view('user.index', compact('datas', 'tittle'));

    }
    public function create()
    {
        $tittle = "Tambah User";
        return view('user.create', compact('tittle'));
    }
    public function store(Request $request)
    {
        User::create($request->all());
        return redirect()->to('user');
    }
    public function show(string $id)
    {
        //
    }
    public function edit(string $id)
    {
        $tittle = "Edit User";
        $edit = User::find($id); //KALO GA KETEMU BAKAL BLANK
        return view('user.edit', compact('edit', 'tittle'));
    }
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if($request->password){
            $user->password = $request->password;
        }
        $user->save();
        return redirect()->to('user');
    }
    public function destroy(string $id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->to('user');
    }
}
