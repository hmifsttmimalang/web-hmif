<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Kartu Anggota</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .kartu {
            border: 1px solid #333;
            padding: 20px;
            width: 350px;
        }

        .judul {
            font-weight: bold;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .foto {
            width: 80px;
            height: 100px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .field {
            margin-bottom: 5px;
        }
    </style>
</head>

<body>
    <div class="kartu">
        <div class="judul">Kartu Anggota HMIF</div>
        <img class="foto" src="{{ public_path('storage/' . $anggota->foto) }}" alt="Foto" />
        <div class="field">NIM: {{ $anggota->nim }}</div>
        <div class="field">Nama: {{ $anggota->nama }}</div>
        <div class="field">Prodi: {{ $anggota->prodi }}</div>
        <div class="field">Angkatan: {{ $anggota->angkatan }}</div>
        <div class="field">Status: {{ $anggota->status }}</div>
    </div>
</body>
</html>
