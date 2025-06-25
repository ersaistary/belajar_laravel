@extends('app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-10">
            <div class="card">
                <div class="card-header">
                    <h1>Add new services</h1>
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        @csrf
                        <label for="" class="form-label">Sevice Name</label>
                        <input type="text" name="service_name" id="" class="form-control">

                        <label for="" class="form-label">Price</label>
                        <input type="number" name="price" id="" class="form-control">

                        <label for="" class="form-label">Description</label>
                        <textarea name="description" id=""  class="form-control"></textarea>

                        <button type="submit" class="btn btn-primary mt-2">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
