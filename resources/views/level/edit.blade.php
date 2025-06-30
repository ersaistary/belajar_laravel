@extends('app')
@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <h3 class="card-title mt-3">
                    {{ $tittle }}
                </h3>
                <div class="card-body">
                    <form action="{{ route('level.update', $level->id) }}" method="post">
                        @csrf
                        @method('put')
                        <div class="mb-3">
                            <label for="">Nama Level: *</label>
                            <input value="{{ $level->name }}" placeholder="Enter level name" class="form-control" name="name" required>
                        </div>
                        <div class="mb-3">
                            <button class="btn btn-primary" type="submit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
