<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Data Anggota Baru</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            color: #333;
        }

        h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th,
        td {
            border: 1px solid #999;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #efefef;
        }
    </style>
</head>

<body>
    <h3>Data Anggota Baru</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Alamat</th>
                <th>Prodi</th>
                <th>Angkatan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($anggotaBaru as $index => $a)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $a->nama }}</td>
                    <td>{{ $a->nim }}</td>
                    <td>{{ $a->memberRegistration->alamat }}</td>
                    <td>{{ $a->prodi }}</td>
                    <td>{{ $a->angkatan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
