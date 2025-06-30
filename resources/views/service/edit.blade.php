@extends('app')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <h3 class="card-title mt-3 ms-3">
                    {{ $tittle }}
                </h3>
                <div class="card-body">
                    <form action="{{ route('service.update', $service->id) }}" method="post">
                        @csrf
                        @method('PUT')
                        <label for="" class="form-label">Sevice Name</label>
                        <input value="{{ $service->service_name }}" type="text" name="service_name" id="" class="form-control">

                        <label for="" class="form-label">Price</label>
                        <input value="{{ $service->price }}" type="number" name="price" id="" class="form-control">

                        <label for="" class="form-label">Description</label>
                        <textarea name="description" id=""  class="form-control">{{ $service->description }}</textarea>

                        <button type="submit" class="btn btn-primary mt-2">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
