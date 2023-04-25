<header>
    <nav class="navbar navbar-expand-sm">
          <div class="container-fluid px-5">
            <a class="navbar-brand" href="{{url('/')}}">
                @php
                $logo = \DB::table('logos')->first();
                @endphp
                <img id="logo" src="{{ ($logo) ? asset('/adminTheme/uploads/logo/'.$logo->image) : asset("images") }}" /></a>
            <button class="navbar-toggler d-lg-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavId" aria-controls="collapsibleNavId"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavId">
                <ul class="navbar-nav ms-auto mt-2 mt-lg-0">
                    <li class="nav-item hover">
                        <a class="nav-link fw-bolder" href="javascript:void(0);">ABOUT US</a>
                    </li>
                    <li class="nav-item hover">
                        <a class="nav-link fw-bolder" href="{{route('listing')}}">RENTAL</a>
                    </li>
                    <li class="nav-item hover">
                        <a class="nav-link fw-bolder" href="javascript:void(0);">LOCO REWARDS</a>
                    </li>
                
                      <!-- Authentication Links -->
                      @if(!Auth::check())
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
                              LogOut
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
