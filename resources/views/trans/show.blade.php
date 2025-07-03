@extends('app')
@section('content')
    <div class="row">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        Data Pelanggan
                    </h3>
                    <table class="table table-bordered">
                        <tr>
                            <th>Nama</th>
                            <th>:</th>
                            <td>{{ $details->customer->name }}</td>
                        </tr>
                        <tr>
                            <th>Phone</th>
                            <th>:</th>
                            <td>{{ $details->customer->phone }}</td>
                        </tr>
                        <tr>
                            <th>Address</th>
                            <th>:</th>
                            <td>{{ $details->customer->address }}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        Order Transaction
                    </h3>
                    <table class="table table-bordered">
                        <tr>
                            <th>Order Code</th>
                            <th>:</th>
                            <td>{{ $details->order_code }}</td>
                        </tr>
                        <tr>
                            <th>Estimation</th>
                            <th>:</th>
                            <td>{{ date('d F Y', strtotime($details->order_end_date))  }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <th>:</th>
                            <td>{{ $details->status_text}}</td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>


        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="card-title">
                        {{ $tittle }}
                    </h3>
                    <form action="" method="post" id="paymentForm" data-order-id={{ $details->id }}>

                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Service</th>
                                <th>Qty</th>
                                <th>Price</th>
                                <th>Total</th>
                            </tr>
                            </thead>
                            <tbody>
                                @foreach ($details->details as $index => $detail)
                                <tr>
                                    <td>{{ $index =+ 1 }}</td>
                                    <td>{{ $detail->service->service_name }}</td>
                                    <td align="right">{{ $detail->qty/1000}}</td>
                                    <td align="right">{{ number_format($detail->service->price) }}</td>
                                    <td align="right">{{  number_format($detail->subtotal)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th colspan="2">Grand Total</th>
                                    <th colspan="3" class="text-end">{{ number_format($details->total)}}</th>
                                    <input type="hidden" class="form-control" id="totalInput" value="{{ $details->total }}" required>
                                </tr>
                                <tr>
                                    <th colspan="2">Bayar</th>
                                    <th colspan="3" class="text-end">
                                        <input type="number" class="form-control" id="order_pay" required>
                                    </th>
                                </tr>
                                <tr>
                                    <th colspan="2">Kembali</th>
                                    <th colspan="3" class="text-end">
                                        <input type="text" id="order_change_display" class="form-control" readonly>
                                        <input type="hidden" class="form-control" id="order_change" required>
                                    </th>
                                </tr>
                            </tfoot>
                        </table>
                    <div class="mt-3">
                        <button class="btn btn-primary" type="submit" name="payment_method" value="cash">Bayar Cash</button>
                        <button class="btn btn-success" type="submit" name="payment_method" value="midtrans">Cashless</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
    @endsection
