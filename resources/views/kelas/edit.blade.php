<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Kelas</title>
</head>
<body>
    <h1>Edit Kelas</h1>

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
        <a href="{{ route('kelas.index') }}">Kembali ke Data Kelas</a>
    </p>

    @if($kelas->gambar_kelas)
        <p>Gambar saat ini: {{ $kelas->gambar_kelas }}</p>
    @endif

    <form action="{{ route('kelas.update', $kelas->id_kelas) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div>
            <label for="nama_kelas">Nama Kelas</label>
            <input type="text" id="nama_kelas" name="nama_kelas" value="{{ old('nama_kelas', $kelas->nama_kelas) }}" required>
            @error('nama_kelas')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="wali_kelas">Wali Kelas</label>
            <input type="text" id="wali_kelas" name="wali_kelas" value="{{ old('wali_kelas', $kelas->wali_kelas) }}" required>
            @error('wali_kelas')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="ketua_kelas">Ketua Kelas</label>
            <input type="text" id="ketua_kelas" name="ketua_kelas" value="{{ old('ketua_kelas', $kelas->ketua_kelas) }}" required>
            @error('ketua_kelas')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="kursi">Jumlah Kursi</label>
            <input type="number" id="kursi" name="kursi" value="{{ old('kursi', $kelas->kursi) }}" min="1" required>
            @error('kursi')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="meja">Jumlah Meja</label>
            <input type="number" id="meja" name="meja" value="{{ old('meja', $kelas->meja) }}" min="1" required>
            @error('meja')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <label for="gambar_kelas">Gambar Kelas (opsional)</label>
            <input type="file" id="gambar_kelas" name="gambar_kelas" accept="image/*">
            @error('gambar_kelas')
                <p>{{ $message }}</p>
            @enderror
        </div>

        <div>
            <button type="submit">Update</button>
        </div>
    </form>
</body>
</html>
