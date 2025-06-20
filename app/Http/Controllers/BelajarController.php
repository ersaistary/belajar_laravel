<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BelajarController extends Controller
{
    public function index(){
        return view("aritmatika");
    }

    public function update($name){
        return "Selamat datang $name";
    }
    
    public function tambah(){
        $tittle = "Pertambahan";
        $jumlah = 0;
        // return view("tambah", [$tittle, $jumlah]);
        return view("tambah", compact('tittle', 'jumlah'));
    }

    public function tambahAction(Request $request){
        $angka1= $request->angka1;
        $angka2= $request->input('angka2');
        $jumlah = $angka1 + $angka2;
        return view('tambah', compact('jumlah'));
    }
}
