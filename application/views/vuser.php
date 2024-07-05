<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Layout Admin</title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/layout.css">
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
                        <a href="#" class="list-group-item list-group-item-action active">Users</a>
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
                    <p>Welcome To The Jungle</p>
                    <div class="row">
                        <div class="col-12 col-xs-12 mb-4 mb-lg-0">
                            <div class="card">
                                <h5 class="card-header">Data Pengguna</h5>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table text-center">
                                            <thead>
                                                <tr>
                                                    <th>No.</th>
                                                    <th>Nama Pengguna</th>
                                                    <th>Email</th>
                                                    <th>Alamat</th>
                                                    <th>tipe user</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody v-for="(row, index) in aData" :key="row.id">
                                                <tr>
                                                    <td>{{index + 1}}</td>
                                                    <td>{{row.username}}</td>
                                                    <td>{{row.email}}</td>
                                                    <td>{{row.alamat}}</td>
                                                    <td>{{row.tipeuser}}</td>
                                                    <td>
                                                        <a href="#" class="btn btn-sm btn-success">edit</a>
                                                        <a href="#" class="btn btn-sm btn-danger">delete</a>
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
        </div>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>   
        
        <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

        <script>
            var v = new Vue({
                el : '#app',
                data: {
                    url: '',
                    aData: [],
                    chooseData: {}
                },
                created(){
                    this.showdata();
                },
                methods:{
                    showdata(){
                        var curl = window.location.href.split('/');
                        var baseUrl = curl.slice(0, 4).join('/');
                        this.url = baseUrl+'/index.php/api/';
                        console.log(this.url);
                        axios.get(this.url + 'users')
                            .then(response => {
                                this.aData = response.data;
                                console.log(response.data);
                            })
                            .catch(error => {console.log(error);});
                    }
                }

            });
        </script>
    </body>
</html>