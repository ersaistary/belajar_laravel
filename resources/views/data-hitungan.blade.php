<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <a href="{{ url('belajar')}}">kembali</a>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Jenis</th>
            <th>Angka1</th>
            <th>Angka2</th>
            <th>Hasil</th>
            <th>Action</th>
        </tr>

        @foreach ($counts as $index => $data)
        <tr>
            <th>{{ $index + 1 }}</th>
            <th>{{ $data ->jenis }}</th>
            <th>{{ $data ->angka1 }}</th>
            <th>{{ $data ->angka2 }}</th>
            <th>{{ $data ->hasil }}</th>
            <th>
                <a href="{{  route ('edit.data-hitung', $data->id) }}">Edit</a>
                <form action="{{  route ('softDelete.data-hitung', $data->id) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Hapus sementara?')">Delete</button>
                </form>
            </th>
        </tr>
        @endforeach
    </table>
</body>
</html>