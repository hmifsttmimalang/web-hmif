<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Anggota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print {
            @page {
                size: A4;
                margin: 20mm;
            }

            body {
                margin: 0;
                -webkit-print-color-adjust: exact;
            }
        }

        .header-container {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            position: relative;
        }

        .img-container {
            position: absolute;
            left: 0;
            margin-left: 10px;
            top: 15px;
        }

        .img2-container {
            position: absolute;
            right: 0;
            margin-right: 10px;
            top: 5px;
        }

        .text-container {
            text-align: center;
        }

        .p-light {
            font-weight: 500;
        }

        .p-style p {
            margin: 0;
            padding: 0;
        }

        .ph-1 {
            font-size: 20px;
            font-weight: bold;
        }

        .ph-2 {
            font-size: 20px;
            font-weight: bold;
        }

        .ph-3 {
            font-size: 14px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }

        th,
        td {
            padding: 8px;
            text-align: left;
            word-wrap: break-word;
        }

        th {
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            font-size: 16px;
        }

        span {
            display: block;
            text-align: center;
            font-weight: bold;
        }

        .table-responsive {
            font-size: 12px;
            overflow-x: auto;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-container">
            <div class="img-container">
                <img src="{{ public_path('assets/img/logo_hmif.jpg') }}" alt="Logo HMIF"
                    style="width: 100px; height: auto;">
            </div>
            <div class="text-container p-3 p-style">
                <p class="ph-1">
                    HIMPUNAN MAHASISWA INFORMATIKA<br>
                </p>
                <p class="ph-2">
                    SEKOLAH TINGGI TEKNIK
                    <br>MULTIMEDIA INTERNASIONAL MALANG
                </p>
                <p class="ph-3">
                    Jl. Candi Panggung Bar. No. 48, Mojolangu, Kec. Lowokwaru, Kota Malang, 65142<br />
                    website: www.hmifsttmimalang.site, e-mail: hmifsttmlg@gmail.com<br />
                </p>
            </div>
            <div class="img2-container">
                <img src="{{ public_path('assets/img/cetak/logo_smi_no_bg.png') }}" alt="Logo SMI"
                    style="width: 100px; height: auto;">
            </div>
        </div>

        <div style="border-top: 3px solid black; margin: 10px 0;"></div>

        <center>
            <h5 class="mb-1 fw-bold">
                DATA ANGGOTA HMIF
            </h5>
            <br>
        </center>

        <table>
            <thead>
                <tr>
                    <th style="text-align: center;">No</th>
                    <th style="text-align: center;">NIM</th>
                    <th style="text-align: center;">Nama</th>
                    <th style="text-align: center;">Alamat</th>
                    <th style="text-align: center;">Prodi</th>
                    <th style="text-align: center;">Angkatan</th>
                    <th style="text-align: center;">Jabatan</th>
                    <th style="text-align: center;">Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($anggota as $i => $a)
                    <tr>
                        <td style="text-align: center;">{{ $i + 1 }}</td>
                        <td style="text-align: center;">{{ $a->nim }}</td>
                        <td>{{ $a->nama }}</td>
                        <td>{{ $a->memberRegistration->alamat ?? '-' }}</td>
                        <td>{{ $a->prodi }}</td>
                        <td style="text-align: center;">{{ $a->angkatan }}</td>
                        <td>{{ $a->jabatan ?? '-' }}</td>
                        <td style="text-align: center;">{{ $a->status }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
