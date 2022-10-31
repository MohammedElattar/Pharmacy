@php($url = '/pharm/public/')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css"
        integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ $url }}css/vendor/bootstrap.min.css">
    <link rel="stylesheet" href="{{ $url }}css/vendor/jquery.dataTables.css">
    <link rel="stylesheet" href="{{ $url }}css/sidebar.css">
    <link rel="stylesheet" href="{{ $url }}css/app.css">
    <title>@yield('title')</title>
</head>

<body>

    <!--Main Navigation-->
    <header>
        <!-- Sidebar -->
        <nav id="sidebarMenu" class="sidebar-links collapse d-lg-block sidebar collapse bg-white">
            <div class=""style="overflow-y:auto;height:550px">
                <div class="list-group list-group-flush mx-3 mt-4">
                    <a href={{ route('dashboard') }}
                        class="list-group-item list-group-item-action py-2 ripple dashboard" aria-current="true">
                        <i class="fas fa-tachometer-alt fa-fw me-3"></i><span>Dashboard</span>
                    </a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple"><i
                            class="fas fa-chart-line fa-fw me-3"></i><span>Analytics</span></a>
                    <a href={{ route('orders') }} class="list-group-item list-group-item-action py-2 ripple orders"><i
                            class="fas fa-chart-bar fa-fw me-3"></i><span>Orders</span></a>
                    <a href={{ route('partners') }}
                        class="list-group-item list-group-item-action py-2 ripple partners"><i
                            class="fas fa-building fa-fw me-3"></i><span>Partners</span></a>
                    <a href={{ route('users') }} class="list-group-item list-group-item-action py-2 ripple users"><i
                            class="fas fa-users fa-fw me-3"></i><span>Users</span></a>
                    <a href={{ route('customer') }}
                        class="list-group-item list-group-item-action py-2 ripple customer"><i
                            class="fas fa-users fa-fw me-3"></i><span>Customers</span></a>
                    <a href="#" class="list-group-item list-group-item-action py-2 ripple sales"><i
                            class="fas fa-money-bill fa-fw me-3"></i><span>Sales</span></a>
                    <a href={{ route('logs') }} class="list-group-item list-group-item-action py-2 ripple logs"><i
                            class="fas fa-history fa-fw me-3"></i><span>Logs</span></a>
                    <a href={{ route('medicine_categories') }}
                        class="list-group-item list-group-item-action py-2 ripple categories"><i
                            class="fa-solid fa-notes-medical fa-fw me-3"></i><span>Categories</span></a>
                    <a href={{ route('type') }} class="list-group-item list-group-item-action py-2 ripple type"><i
                            class="fa-solid fa-notes-medical fa-fw me-3"></i><span>Medicine Types</span></a>
                    <a href={{ route('product') }}
                        class="list-group-item list-group-item-action py-2 ripple product"><i
                            class="fa-solid fa-list fa-fw me-3"></i><span>Products</span></a>
                    <a href={{ route('receiving') }}
                        class="list-group-item list-group-item-action py-2 ripple receiving"><i
                            class="fa-solid fa-file-alt fa-fw me-3"></i><span>Receiving</span></a>
                </div>
            </div>
        </nav>
        <!-- Sidebar -->

        <!-- Navbar -->
        <nav id="main-navbar" class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
            <!-- Container wrapper -->
            <div class="container-fluid">
                <!-- Toggle button -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Brand -->
                <a class="navbar-brand" href="#">
                    <h3>Pharmacy System</h3>
                </a>
                <!-- Right links -->
                <ul class="navbar-nav ms-auto d-flex flex-row">
                    <!-- Notification dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link me-3 me-lg-0 dropdown-toggle hidden-arrow" href="#"
                            id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-bell"></i>
                            <span class="badge rounded-pill badge-notification bg-danger">1</span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">Some news</a></li>
                            <li><a class="dropdown-item" href="#">Another news</a></li>
                            <li>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                        </ul>
                    </li>
                    <!-- Avatar -->
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle hidden-arrow d-flex align-items-center" href="#"
                            id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="https://mdbootstrap.com/img/Photos/Avatars/img (31).jpg" class="rounded-circle"
                                height="22" alt="" loading="lazy" />
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="#">My profile</a></li>
                            <li><a class="dropdown-item" href="#">Settings</a></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- Container wrapper -->
        </nav>
        <!-- Navbar -->
    </header>
    <!--Main Navigation-->

    <!--Main layout-->
    <main style="margin-top: 58px">
        <div class="container pt-4">

        </div>
    </main>
    <!--Main layout-->
    <section class="container content">
        @yield('content')
    </section>
    <script src="{{ $url }}js/vendor/jquery.min.js"></script>
    <script src="{{ $url }}js/vendor/bootstrap.min.js"></script>
    <script src="{{ $url }}js/vendor/bootstrap.bundle.min.js"></script>
    <script src="{{ $url }}js/vendor/jquery.dataTables.js"></script>
</body>

</html>

@yield('active')
<script>
    // document.querySelector(".active").removeAttribute("href")
</script>
