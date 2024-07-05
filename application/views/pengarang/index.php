<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layout Admin</title>
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/layout.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5em;
        }
        .sidebar {
            background: #343a40;
            color: #fff;
        }
        .sidebar a {
            color: #fff;
        }
        .sidebar .active {
            background: #495057;
        }
        .breadcrumb {
            background: #f8f9fa;
            border-radius: .25rem;
        }
        .card {
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
        footer {
            margin-top: 2rem;
            padding-top: 1rem;
            border-top: 1px solid #e9ecef;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-success">
        <div class="container-fluid">
            <a href="#" class="navbar-brand">UAS Muhammad Iqbal</a>
            <div class="collapse navbar-collapse align-items-center justify-content-md-end">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="#" class="nav-link">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="app" class="container-fluid">
        <div class="row">
            <!-- sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky">
                    <a href="<?php echo site_url(); ?>/buku" class="list-group-item list-group-item-action"> Buku</a>
                    <a href="<?php echo site_url(); ?>/pengarang" class="list-group-item list-group-item-action active"> Pengarang</a>
                </div>
            </nav>

            <!-- main content -->
            <main class="col-md-9 col-lg-10 ml-sm-auto px-md-4 py-4">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
                    </ol>
                </nav>
                <h3>Dashboard Pengarang</h3>

                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card">
                            <h5 class="card-header">Data Pengarang</h5>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <button data-bs-target="#myModal" data-bs-toggle="modal" @click="showModal(null)" class="btn btn-primary">Tambah Data</button>
                                    </div>
                                </div>
                            
                                <div class="table-responsive">
                                    <table class="table table-bordered text-center">
                                        <thead class="table-dark">
                                            <tr>
                                                <th>No.</th>
                                                <th>Id Pengarang</th>
                                                <th>Nama Pengarang</th>
                                                <th>Email</th>
                                                <th>No Telp</th>
                                                <th>Alamat</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody v-for="(row, index) in aData" :key="row.id_pengarang">
                                            <tr>
                                                <td>{{index + 1}}</td>
                                                <td>{{row.id_pengarang}}</td>
                                                <td>{{row.nama_pengarang}}</td>
                                                <td>{{row.email}}</td>
                                                <td>{{row.no_telp}}</td>
                                                <td>{{row.alamat}}</td>
                                                <td>
                                                    <a href="#" data-bs-target="#myModal" data-bs-toggle="modal" @click="showModal(row)" class="btn btn-sm btn-success">Edit</a>
                                                    <a href="#" @click="hapusdata(row.id_pengarang)" class="btn btn-sm btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- footer -->
                <footer class="pt-4 d-flex justify-content-between">
                    <span>&copy; MI 2024 <a href="informatika.unpam.ac.id">Teknik Informatika Unpam</a></span>
                </footer>
            </main>
        </div>

        <div class="modal fade" id="myModal">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <form class="needs-validation" novalidate>
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title">{{oData.method == 'post' ? 'Tambah' : 'Edit'}} Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Id Pengarang</label>
                                    <input type="text" id="id_pengarang" v-model="oData.id_pengarang" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Nama Pengarang</label>
                                    <input type="text" id="nama_pengarang" v-model="oData.nama_pengarang" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>No Telepon</label>
                                    <input type="number" id="no_telp" v-model="oData.no_telp" class="form-control" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>E-Mail</label>
                                    <input type="email" id="email" v-model="oData.email" class="form-control" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label>Alamat</label>
                                    <input type="text" id="alamat" v-model="oData.alamat" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" @click="simpandata" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url();?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/jquery.min.js"></script>
    <script src="<?php echo base_url();?>assets/js/vue.js"></script>
    <script src="<?php echo base_url();?>assets/js/axios.min.js"></script>

    <script>
        var v = new Vue({
            el: "#app",
            data: {
                apiUrl: '',
                aData: [],
                pilihData: {},
                oData: {
                    id_pengarang: '',
                    nama_pengarang: '',
                    no_telp: '',
                    email: '',
                    alamat: '',
                    method: '',
                }
            },
            created() {
                this.showdata();
            },
            methods: {
                showModal(oRow) {
                    if (oRow == null) {
                        this.oData.method = 'post';
                        this.oData.id_pengarang = '';
                        this.oData.nama_pengarang = '';
                        this.oData.no_telp = '';
                        this.oData.email = '';
                        this.oData.alamat = '';
                    } else {
                        this.oData.method = 'put';
                        this.oData.id_pengarang = oRow.id_pengarang;
                        this.oData.nama_pengarang = oRow.nama_pengarang;
                        this.oData.no_telp = oRow.no_telp;
                        this.oData.email = oRow.email;
                        this.oData.alamat = oRow.alamat;
                    }
                    $('#myModal').modal('show');
                },
                
                showdata() {
                    this.apiUrl = "<?php echo base_url();?>index.php/api/";
                    axios.get(this.apiUrl + 'pengarang')
                        .then(response => {
                            this.aData = response.data;
                        })
                        .catch(error => {
                            console.log(error);
                        });
                },

                hapusdata(idx) {
                    var konfirmasi = confirm("Apakah yakin data akan dihapus?");
                    if (konfirmasi)
                        axios.delete(this.apiUrl + 'pengarang/' + idx)
                            .then(response => {
                                this.showdata();
                            })
                            .catch(error => {
                                console.log(error);
                            });
                    else console.log("data gak jadi dihapus bro!");
                },

                oFormData(obj) {
                    var formData = new FormData();
                    for (var key in obj) {
                        formData.append(key, obj[key]);
                    }
                    return formData;
                },

                oUriFormData(obj) {
                    var formData = new URLSearchParams();
                    for (var key in obj) {
                        formData.append(key, obj[key]);
                    }
                    return formData.toString();
                },

                simpandata() {
                    var dt = this.oUriFormData(this.oData);
                    if (this.oData.method == 'post')
                        axios.post(this.apiUrl + 'pengarang', dt)
                            .then(response => {
                                this.showdata();
                                $('#myModal').modal('hide');
                            })
                            .catch(error => {
                                console.log(error);
                            });
                    else {
                        axios.put(this.apiUrl + 'pengarang', dt, {
                                headers: { 'Content-Type': 'application/x-www-form-urlencoded' }
                            })
                            .then(response => {
                                this.showdata();
                                $('#myModal').modal('hide');
                            })
                            .catch(error => {
                                console.log(error);
                            });
                    }
                }
            }
        });
    </script>
</body>
</html>
