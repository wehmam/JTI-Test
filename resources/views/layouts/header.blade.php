<nav class="navbar navbar-expand-lg navbar-light bg-light my-2 shadow rounded">
  <div class="container-fluid">
    <a class="navbar-brand" href="/dashboard">{{ __('Dashboard') }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end float-right" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="profileLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ Auth::user()->name }}
          </a>
          <ul class="dropdown-menu" aria-labelledby="profileLink">
            <li>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit" class="dropdown-item">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
