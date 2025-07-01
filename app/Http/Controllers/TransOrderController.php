<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\TransOrders;
use App\Models\TransDetails;
use App\Models\Customers;
use App\Models\TypeOfServices;

class TransOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tittle= 'Order Transaction';
        $datas = TransOrders::with('customer')->orderBy('id', 'desc')->get();
        return view('trans.index',  compact('datas', 'tittle'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tittle = "Tambah Transaksi";
        $today=Carbon::now()->format('dmY');
        $countDay = TransOrders::whereDate('created_at', now()->toDateString())->count()+1;
        $runningNumber = str_pad($countDay, 3, '0', STR_PAD_LEFT);
        $order_code = "TR-" . $today . "-" .$runningNumber;

        $customers = Customers::OrderBy('id', 'desc')->get();
        $services = TypeOfServices::OrderBy('id', 'desc')->get();

        return view('trans.create', compact('tittle', 'order_code', 'customers', 'services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $transOrder = TransOrders::create([
            'id_customer' => $request->id_customer,
            'order_code' => $request->order_code,
            'order_end_date' => $request->order_end_date,
            'total' => $request->grand_total
        ]);

        foreach($request->id_service as $key => $data){
            $idTrans = $transOrder->id;
            TransDetails::create([
                'id_trans'=> $idTrans,
                'id_service'=> $request->id_service[$key],
                'qty'=> $request->qty[$key],
                'subtotal' => $request->total[$key]
            ]);
        }

        return redirect()->to('trans');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
