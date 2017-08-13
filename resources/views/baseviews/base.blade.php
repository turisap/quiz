<!doctype html>
<html lang="eng">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Styles -->
    <link rel="stylesheet" href="/css/bootstrap_paper_theme.css">
    <link rel="stylesheet" href="/css/components/base.css">
    <link rel="stylesheet" href="/css/views/views.css">

    <!-- ANIMATE.CSS -->
    <link rel="stylesheet" href="/css/plugins/animate.css">

</head>
<body>

@yield('home')

@include('baseviews.navbar')

@if($flash = session('message'))
    <div class="flash_message alert alert-success" role="alert">
        {{$flash}}
    </div>
@endif

@yield('content')



<footer>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <p>Quizland 2017</p>
            </div>
        </div>
    </div>
</footer>

<!-- Jquery -->
<script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
<!-- Bootstrap JS -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--jQuery Validate -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/jquery.validate.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.17.0/additional-methods.min.js"></script>
<!-- MY JS -->
<script src="/js/my_js.js"></script>
<!-- Fileinput -->
<script src="/js/components/bootstrap.file-input.js"></script>
<!-- WOW -->
<script  src="/js/components/wow.js" type="text/javascript"></script>

@yield('footer')

</body>
</html>