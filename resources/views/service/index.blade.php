@extends('app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-10">
                <div class="card">
                    <div class="card-header">
                        <h1>Service manager</h1>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('insert/service') }}" class="btn btn-primary mt-3 mb-3">Add new Service</a>
                        <table class="table table-bordered">
                            <tr>
                                <th>No</th>
                                <th>Services Name</th>
                                <th>Price</th>
                                <th>Description</th>
                                <th>Action</th>
                            </tr>
                            <tr>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>
                                    <a href="" class="btn btn-success" name="edit">Edit</a>
                                    <form action="" method="post" style="display: inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"  name="delete">Delete</button>
                                    </form>
                                </th>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
