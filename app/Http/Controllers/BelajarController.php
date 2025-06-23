<?php

namespace App\Http\Controllers;
use App\Models\Count;
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
        $jumlah = null;
        $error = null;
        // return view("tambah", [$tittle, $jumlah]);
        return view("tambah", compact('tittle', 'jumlah'));
    }

    public function tambahAction(Request $request){
        $request->validate([
            'angka1' => 'required',
            'angka2' => 'required',
        ]);

        $angka1= $request->angka1;
        $angka2= $request->input('angka2');
        $error = null;
        $jumlah = null;
        
        if(!is_numeric($angka1) || !is_numeric($angka2)){
            $error= 'Data harus numeric';
        }else{
            $jumlah = $angka1 + $angka2;
        }

        if($error == null){
            // INSERT KE TABLE Count(ada di model)
            Count::create([
                'jenis' => $request->jenis,
                'angka1' => $angka1,
                'angka2' => $angka2,
                'hasil' => $jumlah
            ]);
            return view('tambah', compact('jumlah', 'error'));
        }
    }

    public function viewHitungan(){
        $counts = Count::all();
        return view('data-hitungan', compact('counts'));
    }

    public function editDataHitung(string $id){
        
        $error = null;
        $jumlah = null;

        $count = Count::findorFail($id);
        $jenis = $count->jenis;

        if($jenis == "tambah"){
            $tittle = "Edit penambahan";
            if(!is_numeric($count->angka1) || !is_numeric($count->angka2)){
                $error = "Inputan harus numeric";
            } else {
                $jumlah = $count->angka1 + $count->angka2;
            }
            return view('tambah.edit', compact('tittle', 'error', 'jumlah', 'count'));
        }
    }

    public function updateTambahan(Request $request, string $id){
        $angka1 = $request->angka1;
        $angka2 = $request->angka2;
        $count = $angka1 + $angka2;

        $data = Count::findorFail($id);
        $data->jenis = $request->jenis;
        $data->angka1 = $angka1;
        $data->angka2 = $angka2;
        $data->hasil = $count;
        $data->save();
        return redirect()->route('edit.data-hitung', $id)->with(['status' => 'data berhasil di Update']);

    }

    public function softDeleteTambahan(string $id){
        $sDel = Count::findorFail($id);
        $sDel->delete();

        return redirect()->route('data.hitungan')->with('status', 'Data dihapus sementara');
    }

    public function kurang(){
        $tittle="Pengurangan";
        $jumlah = null;
        $error = null;
        return view("kurang", compact('tittle', 'jumlah'));
    }

    public function kurangAction(Request $request){
        $angka1= $request->angka1;
        $angka2= $request->input('angka2');
        $jumlah = $angka1 - $angka2;
        return view('kurang', compact('jumlah'));
    }
}
