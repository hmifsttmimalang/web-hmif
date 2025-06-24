<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Data Anggota HMIF</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        th,
        td {
            border: 1px solid #333;
            padding: 4px;
            text-align: left;
        }

        th {
            background: #eee;
        }
    </style>
</head>
<body>
    <h2>Data Anggota HMIF</h2>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>Prodi</th>
                <th>Angkatan</th>
                <th>Jabatan</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anggota as $i => $a)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $a->nim }}</td>
                    <td>{{ $a->nama }}</td>
                    <td>{{ $a->alamat }}</td>
                    <td>{{ $a->prodi }}</td>
                    <td>{{ $a->angkatan }}</td>
                    <td>{{ $a->jabatan ?? '-' }}</td>
                    <td>{{ $a->status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
