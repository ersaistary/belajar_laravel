<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah</title>
</head>
<body>
    <h1>{{$tittle ?? ''}}</h1>
    <a href="{{ url()->previous() }}">kembali</a>

    <form action="{{route('update.tambahan', $count->id)}}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="jenis" value="tambah">
        <label for="">angka1</label>
        <input type="text" placeholder="Masukkan angka ke-1" name="angka1" value="{{ $count->angka1 }}">
        <br>
        <label for="">angka2</label>
        <input type="text" placeholder="Masukkan angka ke-2" name="angka2" value="{{ $count->angka2 }}">
        <br>
        <button type="submit">Simpan</button>
    </form>

    @if (isset($jumlah))
        <h1>Hasilnya adalah: {{$jumlah}}</h1>
    @endif

    @if (isset($error))
        <h1>{{$error}}</h1>
    @endif

    <a href="{{ url('data/hitungan') }}">Data Hitungan</a>
</body>
</html>