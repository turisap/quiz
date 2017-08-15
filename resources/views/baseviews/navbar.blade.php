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
                    <li class="dropdown main" id="categories">
                        <a href="#" class="dropdown-toggle main" data-toggle="dropdown" role="button" aria-expanded="false">Categories <span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            @foreach($categories as $key => $value)
                                <li><a href="/categories/{{$key}}">{{$key}}</a></li>
                                <li class="divider"></li>
                            @endforeach
                        </ul>
                    </li>
                @endif
                @if( ! auth()->check())
                     <li id="last" class="main"><a href="/premium">Premium</a></li>
                @elseif(!((auth()->user()->premium == 1) || (auth()->user()->teacher == 1) || (auth()->user()->admin == 1)))
                     <li id="last" class="main"><a href="/premium">Premium</a></li>
                @endif
            </ul>
            @if(auth()->check())
                <ul class="nav navbar-nav navbar-right">
                    <li class="right-nav dropdown main">
                        <a class="dropdown-toggle main" data-toggle="dropdown" role="button" aria-expanded="false">{{auth()->user()->first_name}}</a>
                        <ul class="dropdown-menu" role="menu" id="profile">
                            <li><a href="/profile/{{auth()->user()->id}}">Profile <i class="fa fa-cog" aria-hidden="true"></i></a></li>
                            <li class="divider"></li>
                            <li><a href="/logout">Logout</a></li>
                        </ul>
                    </li>
                    @if(auth()->user()->teacher != 1 && auth()->user()->admin != 1)
                    <li id="myQuizzes"><a href="/myquizzes/{{auth()->user()->id}}" >My quizes</a></li>
                    @else
                    <li id="myQuizzes"><a href="/author/{{auth()->user()->id}}">My Quizzes <span>(author)</span></a></li>
                    @endif
                    @if(auth()->user()->admin == 1)
                    <li><a href="/admin">Admin</a></li>
                    @endif
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