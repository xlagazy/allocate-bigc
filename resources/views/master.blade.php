<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Allocate Big C</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">
	
	<!-- Kanit fonts -->
	<link href="https://fonts.googleapis.com/css2?family=Kanit" rel="stylesheet">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Libraries Stylesheet -->
    <link href="/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="/css/style.css" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="/bootstrap/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="/bootstrap-icons/font/bootstrap-icons.min.css">
    <script src="/bootstrap/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Jquery 3.7.1 -->
    <script src="/js/jquery-3.7.1.min.js"></script>

    <!-- Sweet Alert2 -->
    <link href="/sweetalert/sweetalert2.min.css" rel="stylesheet">
    <script src="/sweetalert/sweetalert2.all.min.js"></script>

    <!-- Dropzone JS -->
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
	
</head>

<body style="background-color:#F3F3F3;">
    <!-- Spinner Start -->
    <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->

    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="/" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0" style="color:#7034fc;"><i class="fa fa-book me-3"></i>Allocate Big C</h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav p-4 p-lg-0">
                <a href="/upload" class="nav-item nav-link">Allocate</a>
                <a href="/article" class="nav-item nav-link">สินค้า</a>
                <a href="/condition" class="nav-item nav-link">เงื่อนไข</a>
            </div>
        </div>
        <div class=" ms-auto m-3"> 
            @if(empty(Cookie::get('name')))
                <button id="loginbtn" class="loginbtn" data-bs-toggle="modal" data-bs-target="#loginmodal">Login</button>

                <script>
                    $(function() {
                        $('#loginbtn').click();
                    });
                </script>
            @else
                <span class="nav-item nav-link">
                    <a class="link-danger" href="/logout">ออกจากระบบ</a>
                </span>
            @endif
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Contain Start -->
    <div class="container-fluid p-0">
        @yield('contents')
    </div>
    <!-- Contain End -->     

    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer wow fadeIn d-flex justify-content-center align-items-end" data-wow-delay="0.1s">
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; 2024, Allowcate Big C.

                        <br><br>
                        Distributed By <a class="border-bottom" href="#">IT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer End -->

    <script type="text/javascript">
        $(document).ready(function () {
            var links = document.querySelectorAll('a');

            for (link of links) {
                if (window.location.pathname == link.getAttribute('href')) {
                    link.classList.add('active')
                } else {
                    link.classList.remove('active')
                }
            }        
        });
    </script>

    @include('login')

    <!-- JavaScript Libraries -->
    <script src="/lib/wow/wow.min.js"></script>
    <script src="/lib/easing/easing.min.js"></script>
    <script src="/lib/waypoints/waypoints.min.js"></script>
    <script src="/lib/owlcarousel/owl.carousel.min.js"></script>

    <!-- Template Javascript -->
    <script src="/js/main.js"></script>
    <script src="/bootstrap/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>

</html>