<!doctype html>
<html lang="eng">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Font -->
    <link href='https://fonts.googleapis.com/css?family=Walter Turncoat' rel='stylesheet'>

    <link rel="stylesheet" href="/css/bootstrap_paper_theme.css">

    <style>
        section#page404 {
            margin-top: 20vh;
            font-family: 'Walter Turncoat';;
        }
        img {
            width: 20%;
        }
        .img {
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 10vh;
        }
        #settings {
            width: 7%;
            margin-top: 5vh;
            -webkit-animation:spin 4s linear infinite;
            -moz-animation:spin 4s linear infinite;
            animation:spin 4s linear infinite
        }

        @-moz-keyframes spin { 100% { -moz-transform: rotate(360deg); } }
        @-webkit-keyframes spin { 100% { -webkit-transform: rotate(360deg); } }
        @keyframes spin { 100% { -webkit-transform: rotate(360deg); transform:rotate(360deg); } }

    </style>

</head>
<body>

<section id="page404">
    <div class="container">
        <div class="row">
            <div class="col-md-3 img">
                <img src="/images/static/pokeball.png">
            </div>
            <div class="col-md-6 text-center">
                <h1>404</h1>
                <h3>Sorry, but this page not found</h3>
            </div>
            <div class="col-md-3 img">
                <img src="/images/static/think.png">
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 img">
                <img src="/images/static/settings.png" id="settings">
            </div>
        </div>
    </div>
</section>

</body>
</html>