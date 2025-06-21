<template>
    <div class="container-fluid">
        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
        <div class="row">

            <!-- Card Pendaftar Masuk -->
            <div class="col-md-6">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h3 font-weight-bold text-info text-uppercase mb-1">
                                    Pendaftar Masuk
                                </div>
                                <div class="h5 mt-3 font-weight-bold">22 Orang</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-info" role="progressbar" style="width: 100%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300" style="font-size: 90px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card Pendaftar Lolos Seleksi -->
            <div class="col-md-6">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="h3 font-weight-bold text-success text-uppercase mb-1">
                                    Total Anggota
                                </div>
                                <div class="h5 mt-3 font-weight-bold">10 Orang</div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col">
                                        <div class="progress progress-sm mr-2">
                                            <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                                aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user fa-2x text-gray-300" style="font-size: 90px;"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <hr class="mt-3">
        <h2 class="text-gray-800">Data Pendaftar Baru</h2>
        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                    <thead class="text-center align-middle">
                        <tr>
                            <th>No</th>
                            <th>NIM</th>
                            <th>Nama</th>
                            <th>Alamat</th>
                            <th>Prodi</th>
                            <th>Angkatan</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-center align-middle">1</td>
                            <td class="text-center align-middle">423025</td>
                            <td>Adi Chandra</td>
                            <td>Jl. Dieng Atas</td>
                            <td class="text-center align-middle">Teknik Informatika</td>
                            <td class="text-center align-middle">2023</td>
                            <td class="text-center align-middle"><span class="badge badge-info">Baru</span></td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">2</td>
                            <td class="text-center align-middle">423025</td>
                            <td>Ardiansyah</td>
                            <td>Jl. Candi Panggung</td>
                            <td class="text-center align-middle">Teknik Informatika</td>
                            <td class="text-center align-middle">2023</td>
                            <td class="text-center align-middle"><span class="badge badge-info">Baru</span></td>
                        </tr>
                        <tr>
                            <td class="text-center align-middle">3</td>
                            <td class="text-center align-middle">423025</td>
                            <td>Aventus Akong</td>
                            <td>Jl. Candi Panggung Barat</td>
                            <td class="text-center align-middle">Teknik Informatika</td>
                            <td class="text-center align-middle">2023</td>
                            <td class="text-center align-middle"><span class="badge badge-info">Baru</span></td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</template>