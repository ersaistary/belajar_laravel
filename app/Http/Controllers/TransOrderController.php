<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\TransOrders;
use App\Models\TransDetails;
use App\Models\Customers;
use App\Models\TypeOfServices;
use Midtrans\Config;
use Midtrans\Snap;

class TransOrderController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }
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
            'total' => $request->grandTotal
        ]);

        foreach($request->id_service as $key => $data){
            $idTrans = $transOrder->id;
            $qtyConvert = floatval($request->qty[$key]) * 1000; // Convert kg to grams
            TransDetails::create([
                'id_trans'   => $idTrans,
                'id_service' => $data,
                'qty'        => $qtyConvert,
                'subtotal'   => $request->total[$key]
            ]);
        }


        return redirect()->to('trans');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $tittle = "Transaction Detail";
        $details = TransOrders::with(['customer', 'details.service'])->where('id', $id)->first();
        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => 10.000,
            ],
            'customer_details' => [
                'first_name' => "asdfs",
                'last_name' => "faefa",
                'email' => "asda@gmail.com",
                'phone' => "578458458",
            ],
        ];

        // $snapToken = Snap::getSnapToken($params);
        return view('trans.show', compact('tittle', 'details'));
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

    public function printInvoice(string $id){
        $details = TransOrders::with(['customer', 'details.service'])->where('id', $id)->first();
        // return $details;
        return view('trans.print', compact('details'));
    }

    public function snap(Request $request, $id){
        $details = TransOrders::with(['details', 'customer'])->findOrFail($id);

        $params = [
            'transaction_details' => [
                'order_id' => rand(),
                'gross_amount' => $details->total,
            ],
            'customer_details' => [
                'first_name' => $details->customer->name ?? 'Umum',
                'email' => $details->customer->email ?? 'dummy@gmail.com',
            ],
        ];

        $snap = Snap::createTransaction($params);
        return response()->json(['token'=>$snap->token]);
    }
}
