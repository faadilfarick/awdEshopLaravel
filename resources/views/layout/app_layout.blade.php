<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Simple Responsive Admin</title>
    <!-- BOOTSTRAP STYLES-->
    <link href="/vendor/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- FONTAWESOME STYLES-->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!-- CUSTOM STYLES-->
    <link href="/css/styles.css" rel="stylesheet" />
    <!-- GOOGLE FONTS-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>

    @include("includes.header_nav")

    <div class="page-content">
        <div class="row">
            <div class="col-md-2">
                @include("includes.side_nav")
            </div>

            <div class="col-md-10">

                @yield("content")
            </div>

        </div>
    </div>


<!-- /. WRAPPER  -->
<!-- SCRIPTS -AT THE BOTOM TO REDUCE THE LOAD TIME-->
<!-- JQUERY SCRIPTS -->
<script src="/vendor/jquery/dist/jquery.min.js"></script>
<!-- BOOTSTRAP SCRIPTS -->
<script src="/vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- CUSTOM SCRIPTS -->
<script src="/js/custom.js"></script>
<script src="/js/app/session.js"></script>
@yield('js')

</body>
</html>
