@extends('app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <h3 class="card-title mt-3 ms-3">
                {{ $tittle }}
            </h3>
            <div class="card-body">
                <form action="{{ route('trans.store') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="" class="form-label">No Pesanan</label>
                            <input value="{{ $order_code ?? ''}}" name="order_code" id="" class="form-control" readonly>
                            <div class="mt-3 mb-3">
                                <label for="" class="form-label">Pelanggan</label>
                                <select name="id_customer" id="" class="form-control">
                                    <option value="">Pilih Pelanggan</option>
                                    @foreach ($customers as $data)
                                        <option value="{{ $data->id }}">{{ $data->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="mt-3 mb-3">
                                <label for="" class="form-label">Pakcage</label>
                                <select name="" id="id_service" class="form-control">
                                    <option value="">Select Pakcage</option>
                                    @foreach ($services as $data)
                                        <option data-price="{{ $data->price }}" value="{{ $data->id }}">{{ $data->service_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-3 mb-3">
                                <label for="" class="form-label">Order End Date</label>
                                <input type="date" name="order_end_date" class="form-control">
                            </div>
                            <label for="" class="form-label">Note</label>
                            <textarea name="note" id=""  class="form-control"></textarea>
                        </div>
                    </div>
                    <div class="mt-3 mb-3">
                        <div class="mb-3" align="right" >
                            <button type="button" class="btn btn-primary addRow">Add row</button>
                        </div>
                        <table class="table table-bordered" id="myTable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Paket</th>
                                    <th>Qty</th>
                                    <th>Sub Total</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <br>
                        <p>
                            <strong>Grand Total : Rp <span id="grandTotal">0</span></strong>
                            <div class="mb-3">
                                <input type="hidden" name="grand_total" id="grandTotalInput" value=0>
                            </div>
                        </p>
                    </div>


                    <button type="submit" class="btn btn-primary mt-2">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

