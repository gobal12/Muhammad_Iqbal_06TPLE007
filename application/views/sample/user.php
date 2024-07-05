<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Layout Admin</title>
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url();?>assets/css/layout.css">
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark bg-success">
            <div class="container-fluid">
                <a href="#" class="navbar-brand">Unpam TI</a>
                <div class="collpase navbar-collapse align-items-center justify-content-md-end">
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
                        <a href="#" class="list-group-item list-group-item-action"><i class="fas"></i> Dashboard</a>
                        <a href="#" class="list-group-item list-group-item-action active"> Users</a>
                        <a href="#" class="list-group-item list-group-item-action"> Settings</a>
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
                    <h3>Dashboard Users</h3>
                    
                    <div class="row">
                        <div class="col-12 col-xs-12 mb-4 mb-lg-0">
                            <div class="card">
                                <h5 class="card-header">Data Pengguna</h5>
                                
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <button  data-bs-target="#myModal" data-bs-toggle="modal" @click="showModal(null)" class="btn btn-primary">Tambah Data</button>
                                        </div>
                                    </div>
                                
                                    <div class="table-responsive">
                                        <table class="table text-center">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>UserID</th>
                                                    <th>Nama Pengguna</th>
                                                    <th>Email</th>
                                                    <th>Alamat</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody v-for="(row, index) in aData" :key="row.id">
                                                <tr>
                                                    <td>{{index + 1}}</td>
                                                    <td>{{row.username}}</td>
                                                    <td>{{row.nama}}</td>
                                                    <td>{{row.email}}</td>
                                                    <td>{{row.alamat}}</td>
                                                    <td>
                                                        <a href="#"  data-bs-target="#myModal" data-bs-toggle="modal" @click="showModal(row)" class="btn btn-sm btn-success">edit</a>
                                                        <a href="#" @click="hapusdata(row.id)" class="btn btn-sm btn-danger">delete</a>
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
                    <footer class="pt-5 d-flex justify-content-between">
                        <span>Copyright @ 2023 <a href="informatika.unpam.ac.id">Teknik Informatika Unpam</a></span>
                    </footer>
                </main>

            </div>

            <div class="modal" id="myModal">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content">
                        <div class="modal-header bg-success text-white">
                            <h5 class="modal-title" id="exampleModalLabel">{{oData.method == 'post' ? 'tambah' : 'edit'}} Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form class="need-validation">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Username</label>
                                                <input type="text" v-model="oData.username" class="form-control" id="id" required>
                                                <div class="invalid-feedback">
                                                    Valid Username is Requred
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Nama</label>
                                                <input type="text" v-model="oData.nama" class="form-control" id="nama" required>
                                                <div class="invalid-feedback">
                                                    Valid Nama is Requred
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Email</label>
                                                <input type="email" v-model="oData.email" class="form-control" id="email" required>
                                                <div class="invalid-feedback">
                                                    Valid email is Requred
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label>alamat</label>
                                                <input type="text" v-model="oData.alamat" class="form-control" id="alamat" required>
                                                <div class="invalid-feedback">
                                                    Valid alamat is Requred
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-sm-6">
                                                <label>Password</label>
                                                <input type="password" v-model="oData.password" class="form-control" id="password" required>
                                                <div class="invalid-feedback">
                                                    Valid Password is Requred
                                                </div>
                                            </div>

                                            <div class="col-sm-6">
                                                <label>Tipe User</label>
                                                <input type="text" v-model="oData.tipeuser" class="form-control" id="tipe User">
                                            </div>
                                        </div>
                                    
                            </form>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" @click="simpandata" class="btn btn-primary">Simpan</button>
                        </div>
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
                data:{
                    apiUrl: '',
                    aData: [],
                    pilihData: {},
                    oData: {
                        idx: '',
                        nama: '', 
                        username: '',
                        email: '', 
                        password: '', 
                        alamat: '', 
                        tipeuser: '',
                        method: '',
                    }
                },
                created(){
                    this.showdata();
                },
                methods:{
                    showModal(oRow){
                        if(oRow != null){
                            this.oData.idx = oRow.id;
                            this.oData.nama = oRow.nama;
                            this.oData.username = oRow.username;
                            this.oData.email = oRow.email;
                            this.oData.password = oRow.password;
                            this.oData.alamat = oRow.alamat;
                            this.oData.tipeuser = oRow.tipeuser;
                            this.oData.method = 'put';
                        }else{
                            this.oData.idx = '';
                            this.oData.nama = '';
                            this.oData.username = '';
                            this.oData.email = '';
                            this.oData.password = '';
                            this.oData.alamat = '';
                            this.oData.tipeuser = '';
                            this.oData.method = 'post';
                        }
                        $('#myModal').modal('show');
                    },
                    
                    showdata(){
                        this.apiUrl = "http://localhost:8080/restapi/index.php/api/";
                        //console.log(this.apiUrl);

                        axios.get(this.apiUrl+'user')
                            .then(response => {
                                this.aData = response.data;
                                //console.log(response.data);
                            })
                            .catch(error=>{
                                console.log(error);
                            });
                    },

                    hapusdata(idx){
                        var konfirmasi = confirm("Apakah yakin data akan dihapus?");

                        if(konfirmasi)
                            axios.delete(this.apiUrl+'user/'+idx)
                                .then(response => {
                                    //console.log("Data Berhasil dihapus");
                                    this.showdata();
                                })
                                .catch(error=>{
                                    console.log(error);
                                });
                        else console.log("data gak jadi dihapus bro!");
                    },

                    oFormData(obj){
                        var formData = new FormData();
                        for(var key in obj){
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

                    simpandata(){
                        var dt = this.oUriFormData(this.oData);
                        console.log(this.oData);
                        if(this.oData.method == 'post')
                            axios.post(this.apiUrl+'user', dt)
                                .then(response => {
                                    this.showdata();
                                    $('#myModal').modal('hide');
                                    console.log(response.data);
                                })
                                .catch(error=>{
                                    console.log(error);
                                });
                       else (this.oData.method == 'put')
                            axios.put(this.apiUrl+'user', dt, {
                                    headers: {'Content-Type': 'application/x-www-form-urlencoded'}
                                })
                                .then(response => {
                                    this.showdata();
                                    $('#myModal').modal('hide');
                                    console.log(response);
                                })
                                .catch(error=>{
                                    console.log(error);
                                });

                    }
                }

            })
        </script>

                
    </body>
</html>