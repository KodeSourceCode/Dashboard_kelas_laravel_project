<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Data Kelas</title>
</head>
<body>
    <h1>Data Kelas</h1>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif

    @if($errors->any())
        <p>Terdapat kesalahan:</p>
        <ul>
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <p>
        <a href="{{ route('kelas.create') }}">Tambah Kelas</a>
    </p>

    <form action="{{ route('kelas.index') }}" method="GET">
        <label for="search">Cari Kelas</label>
        <input type="text" id="search" name="search" value="{{ request('search') }}">
        <button type="submit">Cari</button>
    </form>

    @if($kelas->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kelas</th>
                    <th>Wali Kelas</th>
                    <th>Ketua Kelas</th>
                    <th>Kursi</th>
                    <th>Meja</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($kelas as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_kelas }}</td>
                        <td>{{ $item->wali_kelas }}</td>
                        <td>{{ $item->ketua_kelas }}</td>
                        <td>{{ $item->kursi }}</td>
                        <td>{{ $item->meja }}</td>
                        <td>
                            @if($item->gambar_kelas)
                                <img src="{{ asset('images/' . $item->gambar_kelas) }}" alt="Gambar {{ $item->nama_kelas }}" style="width: 100px; height: auto;">
                            @else
                                <span>Tidak ada</span>
                            @endif
                        </td>
                        <td>
                            <div style="display: flex; gap: 10px;">
                                <a href="{{ route('kelas.edit', $item->id_kelas) }}">Edit</a>
                                <form action="{{ url('kelas') }}/{{ $item->id_kelas }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">Hapus</button>
                                </form>
                            </div>
                        </td?>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Belum ada data kelas.</p>
    @endif
</body>
</html>
