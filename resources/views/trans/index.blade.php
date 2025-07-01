@extends('app')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header mb-3">
                <h4>{{ $tittle }}</h4>
            </div>

            <div class="card-body">
                <div class="mb-3"  align="right">
                    <a href="{{ route('trans.create') }}" class="btn btn-primary">Tambah</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Pesanan</th>
                            <th>Customer</th>
                            <th>Tanggal Selesai</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($datas as $key => $data)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->order_code }}</td>
                                <td>{{ $data->customer->name }}</td>
                                <td>{{ $data->order_end_date }}</td>
                                <td>{{ $data->status_text }}</td>
                                <td>
                                    <a href="{{ route('trans.show', $data->id) }}" class="btn btn-primary" name="show">Show</a>
                                    <form action="{{ route('trans.destroy', $data->id) }}" method="post" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"  name="delete">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
