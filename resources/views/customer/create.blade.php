@extends('app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <h3 class="card-title mt-3 ms-3">
                {{ $tittle }}
            </h3>
            <div class="card-body">
                <form action="{{ route('customer.store') }}" method="post">
                    @csrf
                    <label for="" class="form-label">Name</label>
                    <input type="text" name="name" id="" class="form-control">

                    <label for="" class="form-label">Phone</label>
                    <input type="text" name="phone" id="" class="form-control">

                    <label for="" class="form-label">Address</label>
                    <textarea name="address" id=""  class="form-control"></textarea>

                    <button type="submit" class="btn btn-primary mt-2">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
