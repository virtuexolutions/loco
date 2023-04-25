<header>
    <nav class="navbar navbar-expand-sm">
          <div class="container-fluid px-5">
            <a class="navbar-brand" href="index.html"><img id="logo" src="{{ asset("images") }}/logo.png" /></a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item hover">
                        <a class="nav-link fw-bolder" href="#">ABOUT US</a>
                    </li>
                    <li class="nav-item hover">
                        <a class="nav-link fw-bolder" href="#">RENTAL</a>
                    </li>
                    <li class="nav-item hover">
                        <a class="nav-link fw-bolder" href="#">LOCO REWARDS</a>
                    </li>
                
                      <!-- Authentication Links -->
                      @guest
                      <li class="nav-item hover">
                          <a class="nav-link fw-bolder" href="{{ route('login') }}">{{ __('Login') }}</a>
                      </li>
                      @if (Route::has('register'))
                          <li class="nav-item hover">
                              <a class="nav-link fw-bolder" href="{{ route('register') }}">{{ __('Register') }}</a>
                          </li>
                      @endif
                  @else
                      <li class="nav-item dropdown">
                          <a id="navbarDropdown"  onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                              {{ Auth::user()->name }}
                          </a>

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                              <a class="dropdown-item" href="{{ route('logout') }}"
                                 onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                  {{ __('Logout') }}
                              </a>

                              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                  @csrf
                              </form>
                          </div>
                      </li>
                  @endguest
                </ul>
            </div>
      </div>
    </nav>
    
</header>
