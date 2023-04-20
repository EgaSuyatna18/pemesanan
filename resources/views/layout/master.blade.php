<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>{{ $title }}</title>
        <link href="/asset/sbadmin/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="/asset/select2/css/select2.min.css">
        {{-- <link rel="stylesheet" href="/asset/bootstrap/css/bootstrap.min.css"> --}}
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        {{-- datatables --}}
        <link rel="stylesheet" href="/asset/datatables/jquery.dataTables.min.css">
        <link rel="stylesheet" href="/asset/datatables/buttons.dataTables.min.css">
        <script src="/asset/datatables/jquery-3.5.1.js"></script>
        <script src="/asset/datatables/jquery.dataTables.min.js"></script>
        <script src="/asset/datatables/dataTables.buttons.min.js"></script>
        <script src="/asset/datatables/jszip.min.js"></script>
        <script src="/asset/datatables/pdfmake.min.js"></script>
        <script src="/asset/datatables/vfs_fonts.js"></script>
        <script src="/asset/datatables/buttons.html5.min.js"></script>
        <script src="/asset/datatables/buttons.print.min.js"></script>
        {{-- end datatables --}}
    </head>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="/dashboard">Pemesanan App</a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-auto me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="/profil">Profil</a></li>
                        <li><a class="dropdown-item" href="/logout">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Dashboard</div>
                            <a class="nav-link" href="/dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            @if (auth()->user()->role == 'ktu')
                            <div class="sb-sidenav-menu-heading">menu ktu</div>
                            <a class="nav-link" href="/user">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                User
                            </a>
                            <a class="nav-link" href="/produk">
                                <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                                Produk
                            </a>
                            <a class="nav-link" href="/customer">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Customer
                            </a>
                            <a class="nav-link" href="/transportir">
                                <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                                Transportir
                            </a>
                            <a class="nav-link" href="/order">
                                <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                Order
                            </a>
                            <a class="nav-link" href="/penawaranharga">
                                <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                                Penawaran Harga
                            </a>
                            <a class="nav-link" href="/purchaseorder">
                                <div class="sb-nav-link-icon"><i class="fas fa-dollar"></i></div>
                                Purchase Order
                            </a>
                            <a class="nav-link" href="/purchaseorder/pengiriman">
                                <div class="sb-nav-link-icon"><i class="fas fa-paper-plane"></i></div>
                                Pengiriman
                            </a>
                            <div class="sb-sidenav-menu-heading">menu ktu</div>
                            <a class="nav-link" href="/order/laporan">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Laporan Order
                            </a>
                            <a class="nav-link" href="/penawaranharga/laporan">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Laporan Penawaran Harga
                            </a>
                            <a class="nav-link" href="/purchaseorder/laporan">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Laporan Purchase Order
                            </a>
                            <a class="nav-link" href="/pengiriman/laporan">
                                <div class="sb-nav-link-icon"><i class="fas fa-list"></i></div>
                                Laporan Pengiriman
                            </a>
                            @elseif(auth()->user()->role == 'staff_ppic')
                            <div class="sb-sidenav-menu-heading">menu staff ppic</div>
                            <a class="nav-link" href="/produk">
                                <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                                Produk
                            </a>
                            <a class="nav-link" href="/order">
                                <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                Order
                            </a>
                            <a class="nav-link" href="/penawaranharga">
                                <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                                Penawaran Harga
                            </a>
                            <a class="nav-link" href="/purchaseorder">
                                <div class="sb-nav-link-icon"><i class="fas fa-dollar"></i></div>
                                Purchase Order
                            </a>
                            @elseif(auth()->user()->role == 'krani_ppic')
                            <div class="sb-sidenav-menu-heading">menu krani ppic</div>
                            <a class="nav-link" href="/produk">
                                <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                                Produk
                            </a>
                            <a class="nav-link" href="/order">
                                <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                Order
                            </a>
                            <a class="nav-link" href="/penawaranharga">
                                <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                                Penawaran Harga
                            </a>
                            @elseif(auth()->user()->role == 'kepala_gudang')
                            <div class="sb-sidenav-menu-heading">kepala gudang</div>
                            <a class="nav-link" href="/produk">
                                <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                                Produk
                            </a>
                            <a class="nav-link" href="/purchaseorder">
                                <div class="sb-nav-link-icon"><i class="fas fa-dollar"></i></div>
                                Purchase Order
                            </a>
                            @elseif(auth()->user()->role == 'krani_gudang')
                            <div class="sb-sidenav-menu-heading">krani gudang</div>
                            <a class="nav-link" href="/produk">
                                <div class="sb-nav-link-icon"><i class="fas fa-cubes"></i></div>
                                Produk
                            </a>
                            <a class="nav-link" href="/customer">
                                <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                                Customer
                            </a>
                            <a class="nav-link" href="/transportir">
                                <div class="sb-nav-link-icon"><i class="fas fa-truck"></i></div>
                                Transportir
                            </a>
                            <a class="nav-link" href="/order">
                                <div class="sb-nav-link-icon"><i class="fas fa-shopping-cart"></i></div>
                                Order
                            </a>
                            <a class="nav-link" href="/penawaranharga">
                                <div class="sb-nav-link-icon"><i class="fas fa-tags"></i></div>
                                Penawaran Harga
                            </a>
                            <a class="nav-link" href="/purchaseorder">
                                <div class="sb-nav-link-icon"><i class="fas fa-dollar"></i></div>
                                Purchase Order
                            </a>
                            <a class="nav-link" href="/purchaseorder/pengiriman">
                                <div class="sb-nav-link-icon"><i class="fas fa-paper-plane"></i></div>
                                Pengiriman
                            </a>
                            @endif
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ auth()->user()->name }}
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main class="p-4">
                    @yield('content')
                </main>
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                            <div class="text-muted">Copyright &copy; Your Website 2022</div>
                            <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
            <div id="liveToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
              <div class="toast-header">
                <strong class="me-auto">Notifikasi</strong>
                <small>now</small>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
              </div>
              <div class="toast-body">
                @if ($errors->any())
                    @foreach ($errors->all() as $message)
                        <p class="text-danger">{{ $message }}</p>
                    @endforeach
                @endif
                @if (session()->has('notif'))
                    <p class="text-success">{{ session()->get('notif') }}</p>
                @endif
              </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="/asset/sbadmin/js/scripts.js"></script>
        <script src="/asset/select2/js/select2.min.js"></script>
        {{-- <script src="/asset/bootstrap/js/bootstrap.min.js"></script> --}}
        
        <script>
            $(document).ready(function() {
                $('.select2Tambah').select2({
                    dropdownParent: $('#tambahModal')
                });

                $('.select2Ubah').select2({
                    dropdownParent: $('#ubahModal')
                });

                $('.select2Kirim').select2({
                    dropdownParent: $('#kirimModal')
                });
            });
        </script>

        @if ($errors->any() || session()->has('notif'))
            <script>
                const toast = document.getElementById('liveToast');
                const on = new bootstrap.Toast(toast);
                on.show();
                console.log(on);
            </script>
        @endif

        <script>
            $(document).ready(function () {
                $('#datatable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        'excel', 'pdf', 'print'
                    ]
                });
            });

            $(document).ready(function () {
                $('#datatable-user').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3 ]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3 ]
                            }
                        },
                        {
                            extend: 'print',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3 ]
                            }
                        },
                    ]
                });
            });
          </script>
        
    </body>
</html>