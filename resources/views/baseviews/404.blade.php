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
        span {
            position:relative;
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
                <h3><span id="1">Sorry</span>, <span id="2">but</span> <span id="3">this</span> <span id="4">page</span> <span id="5">not</span>  <span id="6">found</span></h3>
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

<script src="http://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>

<script>
    $(document).ready(function() {

       var first  = $('#1');
       var second = $('#2');
       var third  = $('#3');
       var fourth = $('#4');
       var fifth  = $('#5');
       var sixth  = $('#6');

       $(function () {

           first.animate({'top' : '-10px', 'left' : '-5px'}, 500).delay(300).animate({'top' : '0px', 'left' : '0px'}, 1500).delay(100)
               .animate({'top' : '-5px', 'left' : '+6px'}, 500).delay(800).animate({'top' : '0px', 'left' : '0px'}, 100).delay(600)
               .animate({'top' : '+4px', 'left' : '-9px'}, 700).delay(300).animate({'top' : '0px', 'left' : '0px'}, 300).delay(400)
               .animate({'top' : '+8px', 'left' : '+6px'}, 500).delay(700).animate({'top' : '0px', 'left' : '0px'}, 500).delay(300);

           second.animate({'top' : '-5px', 'left' : '+6px'}, 300).delay(600).animate({'top' : '0px', 'left' : '0px'}, 900).delay(300)
               .animate({'top' : '7px', 'left' : '+6px'}, 600).delay(300).animate({'top' : '0px', 'left' : '0px'}, 100).delay(800)
               .animate({'top' : '-9px', 'left' : '+6px'}, 700).delay(500).animate({'top' : '0px', 'left' : '0px'}, 500).delay(500)
               .animate({'top' : '-9px', 'left' : '-9px'}, 200).delay(800).animate({'top' : '0px', 'left' : '0px'}, 500).delay(500);

           third.animate({'top' : '8px', 'left' : '+6px'}, 600).delay(200).animate({'top' : '0px', 'left' : '0px'}, 100).delay(500)
               .animate({'top' : '2px', 'left' : '-8px'}, 300).delay(400).animate({'top' : '0px', 'left' : '0px'}, 1000).delay(900)
               .animate({'top' : '0px', 'left' : '+5px'}, 600).delay(400).animate({'top' : '0px', 'left' : '0px'}, 800).delay(300)
               .animate({'top' : '-8px', 'left' : '-0px'}, 400).delay(500).animate({'top' : '0px', 'left' : '0px'}, 400).delay(100);

           fourth.animate({'top' : '5px', 'left' : '-6px'}, 400).delay(200).animate({'top' : '0px', 'left' : '0px'}, 400).delay(800)
               .animate({'top' : '6px', 'left' : '0px'}, 500).delay(600).animate({'top' : '0px', 'left' : '0px'}, 600).delay(1000)
               .animate({'top' : '-2px', 'left' : '+8px'}, 200).delay(400).animate({'top' : '0px', 'left' : '0px'}, 400).delay(600)
               .animate({'top' : '-9px', 'left' : '-9px'}, 200).delay(400).animate({'top' : '0px', 'left' : '0px'}, 500).delay(500);

           fifth.animate({'top' : '6px', 'left' : '-2px'}, 600).delay(300).animate({'top' : '0px', 'left' : '0px'}, 500).delay(300)
               .animate({'top' : '0px', 'left' : '10px'}, 700).delay(500).animate({'top' : '0px', 'left' : '0px'}, 400).delay(100)
               .animate({'top' : '-6px', 'left' : '2px'}, 800).delay(200).animate({'top' : '0px', 'left' : '0px'}, 100).delay(1300)
               .animate({'top' : '10px', 'left' : '0px'}, 400).delay(600).animate({'top' : '0px', 'left' : '0px'}, 900).delay(400);

           sixth.animate({'top' : '0px', 'left' : '-2px'}, 400).delay(200).animate({'top' : '0px', 'left' : '0px'}, 400).delay(300)
               .animate({'top' : '5px', 'left' : '5px'}, 300).delay(600).animate({'top' : '0px', 'left' : '0px'}, 500).delay(400)
               .animate({'top' : '-8px', 'left' : '9px'}, 300).delay(700).animate({'top' : '0px', 'left' : '0px'}, 600).delay(1400)
               .animate({'top' : '-9px', 'left' : '-9px'}, 200).delay(700).animate({'top' : '0px', 'left' : '0px'}, 500).delay(500);
       })

    });
</script>

</body>
</html>