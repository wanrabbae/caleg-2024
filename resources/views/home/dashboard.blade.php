@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <!-- Content Row -->
        <div class="row">

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    DPT
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ $pemilih }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-calendar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Suara
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">1000</div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-chart-bar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Earnings (Monthly) Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Relawan
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $relawan }}</div>
                                    </div>
                                    <div class="col">

                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="far fa-user fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pending Requests Card Example -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Calon Pemilih
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-chart-pie"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-12 mb-4">

                <!-- Project Card Example -->
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">
                            <i class="fas fa-chart-bar text-lg"></i>
                            Perolehan Suara
                        </h6>
                    </div>
                    <div class="card-body" id="chart">
                        <script>
                            
                            // anychart.onDocumentReady(function() {
                            //     fetch("/dpt/fetch").then(resp => resp.json()).then(resp => {
                            //         console.log(resp)
                            //         let myArr = [];
                            //         // resp.forEach((v, i) => {
                            //         //     if (myArr.some(e => e[0].kecamatan == v.desa.kecamatan.nama_kecamatan)) {
                            //         //         v.jk == "Perempuan" ? myArr.find(e => e[0].kecamatan == v.desa.kecamatan.nama_kecamatan)[0].data[1][0]++ : myArr.find(e => e[0].kecamatan == v.desa.kecamatan.nama_kecamatan)[0].data[0][0]++
                            //         //     } else {
                            //         //         myArr.push([{kecamatan: v.desa.kecamatan.nama_kecamatan, data: [[v.jk === "Laki-Laki" ? 1 : 0], [v.jk === "Perempuan" ? 1 : 0]]}])
                            //         //     }
                            //         // })
                            //         // resp.forEach((v, i) => {
                            //         //     if (myArr.some(e => e[0] == v.desa.kecamatan.nama_kecamatan)) {
                            //         //         v.jk == "Laki-Laki" ? myArr.find(e => e[0] == v.desa.kecamatan.nama_kecamatan)[1]++ : myArr.find(e => e[0] == v.desa.kecamatan.nama_kecamatan)[2]++
                            //         //     } else {
                            //         //         myArr.push([v.desa.kecamatan.nama_kecamatan, v.jk === "Laki-Laki" ? 1 : 0, v.jk === "Perempuan" ? 1 : 0])
                            //         //     }
                            //         // })
                            //         // console.log(myArr);
                            //         // var data = {
                            //         //     rows: myArr
                            //         // }

                            //         // var chart = anychart.column()
                            //         // chart.data(data)
                            //         // chart.container("chart");
                            //         // chart.draw()
                            //     })
                            // })
                            fetch("/dpt/fetch").then(resp => resp.json()).then(resp => {
                                console.log(resp)
                                let myArr = [];
                                resp.forEach((v, i) => {
                                    if (myArr.some(e => e[0] == v.desa.kecamatan.nama_kecamatan)) {
                                        myArr.find(e => e[0] == v.desa.kecamatan.nama_kecamatan)
                                    }
                                })

                            let w = 500;
                            let h = 150;

                            let svg = d3.select("#chart")
                            .append("svg")
                            .attr("width", w)
                            .attr("height", h)
                            .selectAll("rect")

                            myArr.forEach((v, i) => {
                                console.log(v)
                                let rect = svg.data(v[0].data)
                                .enter()
                                .append("rect")
                                .attr("width", 50)
                                .attr("height", d => d * 30)
                                .attr("x", (d, i) => i * 60)
                                .attr("y", (d, i) => h - 3 * d)
                                .attr("fill", (d, i) => i == 0 ? "red" : "pink")
                            })
                            });

                        </script>
                    </div>
                </div>

            </div>
        </div>

        <form action="/update" method="POST">
            @csrf
        <div class="row">
                <button class="col-lg-6 mb-4 btn" name="warna" value="bg-primary">
                    <div class="card bg-primary text-white shadow">
                        <div class="card-body">
                            Primary
                            <div class="text-white-50 small">#4e73df</div>
                        </div>
                    </div>
                </button>
                <button class="col-lg-6 mb-4 btn" name="warna" value="bg-success">
                    <div class="card bg-success text-white shadow">
                        <div class="card-body">
                            Success
                            <div class="text-white-50 small">#1cc88a</div>
                        </div>
                    </div>
                </button>
                <button class="col-lg-6 mb-4 btn" name="warna" value="bg-info">
                    <div class="card bg-info text-white shadow">
                        <div class="card-body">
                            Info
                            <div class="text-white-50 small">#36b9cc</div>
                        </div>
                    </div>
                </button>
                <button class="col-lg-6 mb-4 btn" name="warna" value="bg-warning">
                    <div class="card bg-warning text-white shadow">
                        <div class="card-body">
                            Warning
                            <div class="text-white-50 small">#f6c23e</div>
                        </div>
                    </div>
                </button>
                <button class="col-lg-6 mb-4 btn" name="warna" value="bg-danger">
                    <div class="card bg-danger text-white shadow">
                        <div class="card-body">
                            Danger
                            <div class="text-white-50 small">#e74a3b</div>
                        </div>
                    </div>
                </button>
                <button class="col-lg-6 mb-4 btn" name="warna" value="bg-secondary">
                    <div class="card bg-secondary text-white shadow">
                        <div class="card-body">
                            Secondary
                            <div class="text-white-50 small">#858796</div>
                        </div>
                    </div>
                </button>
                <button class="col-lg-6 mb-4 btn" name="warna" value="bg-light">
                    <div class="card bg-light text-black shadow">
                        <div class="card-body">
                            Light
                            <div class="text-black-50 small">#f8f9fc</div>
                        </div>
                    </div>
                </button>
                <button class="col-lg-6 mb-4 btn" name="warna" value="bg-dark">
                    <div class="card bg-dark text-white shadow">
                        <div class="card-body">
                            Dark
                            <div class="text-white-50 small">#5a5c69</div>
                        </div>
                    </div>
                </button>
        </div>
    </form>


    </div>
@endsection
