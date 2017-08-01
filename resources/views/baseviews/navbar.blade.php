<nav class="navbar navbar-default" id="wholeNav">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">QuizLand</a>
        </div>

        <div class="collapse navbar-collapse" id="mainNav">
            <ul class="nav navbar-nav">
                @if(count($categories) > 0)
                    <li class="dropdown main">
                        <a href="#" class="dropdown-toggle main" data-toggle="dropdown" role="button" aria-expanded="false">Categories <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            @foreach($categories as $key => $value)
                                <li><a href="/categories/{{$key}}">{{$key}}</a></li>
                                <li class="divider"></li>
                            @endforeach
                        </ul>
                @endif
                @if( ! auth()->check())
                     <li id="last" class="main"><a href="/premium">Premium</a></li>
                @elseif(!((auth()->user()->premium == 1) || (auth()->user()->teacher == 1) || (auth()->user()->admin == 1)))
                     <li id="last" class="main"><a href="/premium">Premium</a></li>
                @endif
            </ul>
            @if(auth()->check())
                <ul class="nav navbar-nav navbar-right">
                    <li class="right-nav"><a href="#">{{auth()->user()->first_name}}</a></li>
                    <li><a href="/myquizzes/{{auth()->user()->id}}" >My quizes</a></li>
                </ul>
            @else
                <ul class="nav navbar-nav navbar-right">
                    <li id="login"><a href="/login">Login</a></li>
                    <li class="right-nav"><a href="/signup">SignUp</a></li>
                </ul>
            @endif
        </div>
    </div>
</nav>