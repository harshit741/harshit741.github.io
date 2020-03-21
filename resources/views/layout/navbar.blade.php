    
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container">
        <a class="navbar-brand" href="/">Blog In Laravel</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home</a>
                </li>
                @php($cats = App\Posts::pluck('category'))
                       @php($cats = $cats->unique())
                            @if(count($cats)> 0)
                <li class="dropdown nav-item"><a class="dropdown-toggle" data-toggle="dropdown">Categories <span class="caret"></span></a>
                    <ul class="dropdown-menu bg-dark">
                        
                                @foreach($cats as $cat)
                                <li class="nav-link bg-dark"><a href="/category/{{$cat}}">{{$cat}}</a></li>
                                @endforeach
                    </ul>
                  </li>
                  @endif
                <li class="nav-item">
                    <a class="nav-link" href="/about">About</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/contact">Contact</a>
                </li>
                @auth
                    
                <li class="nav-item">
                    <a class="nav-link" href="/posts/create"><i class="fas fa-plus"></i> Create Post</a>
            </li>
                @endauth
                <!-- Authentication Links -->
                @guest

                <li class="nav-item">
                    <a class="btn btn-outline-secondary" href="{{ route('login') }}">{{ __('Login') }}</a>
                </li>
                    @if (Route::has('register'))
                        
                </li>
                @endif
                @else
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="/dashboard/{{Auth::user()->name}}" role="button" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }} <span class="caret"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                        onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest

            </ul>
        </div>
        </div>
    </nav>