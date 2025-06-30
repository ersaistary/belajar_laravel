@extends('app')
@section('content')
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <h3 class="card-title">
                {{ $tittle }}
            </h3>
            <div class="mb-3" align="right">
                <a href="{{ route('service.create') }}" class="btn btn-primary">Create Service</a>
            </div>
            <table class="table table-bordered">
                <tr>
                    <th>No</th>
                    <th>Services Name</th>
                    <th>Price</th>
                    <th>Description</th>
                    <th>Action</th>
                </tr>
                @foreach ($datas as $key => $data)
                    <tr>
                        <th>{{$key + 1}}</th>
                        <th>{{ $data->service_name }}</th>
                        <th>{{ number_format($data->price) }}</th>
                        <th>{{ $data->description }}</th>
                        <th>
                            <a href="{{ route('service.edit', $data->id) }}" class="btn btn-primary btn-sm" name="edit">Edit</a>
                            <form action="{{ route('service.destroy', $data->id) }}" method="post" style="display: inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" >Delete</button>
                            </form>
                        </th>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
@endsection
