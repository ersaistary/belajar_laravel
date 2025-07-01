@extends('app')
@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header mb-3">
                <h4>Data User</h4>
            </div>

            <div class="card-body">
                <div class="mb-3"  align="right">
                    <a href="{{ route('user.create') }}" class="btn btn-primary">Tambah</a>
                </div>
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($datas as $key => $data)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->email }}</td>
                                <td>
                                    <a href="{{ route('user.edit', $data->id) }}" class="btn btn-primary" name="edit">Edit</a>
                                    <form action="{{ route('user.destroy', $data->id) }}" method="post" style="display: inline">
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
