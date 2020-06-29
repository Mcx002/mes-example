<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>403 Forbidden</title>
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <!-- page css -->
    <link href="{{ asset('dist/css/pages/error-pages.css') }}" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body class="skin-default-dark fixed-layout">
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body text-center">
                <h1>403</h1>
                <h3 class="text-uppercase">금지 된 오류!</h3>
                <p class="text-muted m-t-30 m-b-30">이 서버에 대한 액세스 권한이 없습니다.</p>
                <a href="{{ route('kr_checklevel') }}" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">홈으로</a> </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="{{ asset('') }}/assets/node_modules/jquery/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="{{ asset('') }}/assets/node_modules/popper/popper.min.js"></script>
    <script src="{{ asset('') }}/assets/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <!--Wave Effects -->
    <script src="{{ asset('') }}dist/js/waves.js"></script>
</body>


<!-- Mirrored from www.wrappixel.com/demos/admin-templates/elegant-admin/main/pages-error-403.html by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 21 Apr 2018 18:47:05 GMT -->
</html>