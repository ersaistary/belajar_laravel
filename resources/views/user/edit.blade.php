@extends('app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <h3 class="card-title mt-3 ms-3">
                {{ $tittle }}
            </h3>
            <div class="card-body">
                <form action="{{ route('user.update', $edit->id) }}" method="post">
                    @csrf
                    @method('put')
                    <label for="" class="form-label">Name</label>
                    <input value="{{ $edit->name }}" type="text" name="name" id="" class="form-control">

                    <label for="" class="form-label">Email</label>
                    <input value="{{ $edit->email }}" type="text" name="email" id="" class="form-control">

                    <label for="" class="form-label">Password</label>
                    <input type="password" name="password" id="" class="form-control">

                    <button type="submit" class="btn btn-primary mt-2">Create</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
