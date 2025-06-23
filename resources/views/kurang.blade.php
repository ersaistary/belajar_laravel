<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengurangan</title>
</head>
<body>
    <h1>{{$tittle ?? ''}}</h1>
    <a href="{{ url()->previous() }}">kembali</a>

    <form action="{{route('kurang-action')}}" method="post">
        @csrf
        <label for="">angka1</label>
        <input type="number" placeholder="Masukkan angka ke-1" name="angka1">
        <br>
        <label for="">angka2</label>
        <input type="number" placeholder="Masukkan angka ke-2" name="angka2">
        <br>
        <button type="submit">Simpan</button>
    </form>
    <h1>Hasilnya adalah: {{$jumlah}}</h1>
</body>
</html>