<header>
  <div>
    <h3 class="float-md-start mb-0"> Naufal Adriansyah </h3>
    <nav class="nav nav-masthead justify-content-center float-md-end">
      <a class="nav-link {{ Request::path() == '/' ? 'active' : '' }}" href="{{ url('/') }}"> Home </a>
      <a class="nav-link {{ Request::path() == 'projects' ? 'active' : '' }}" href="{{ url('/projects') }}"> Projects </a>
      <a class="nav-link {{ Request::path() == 'contents' ? 'active' : '' }}" href="{{ url('/contents') }}"> Contact </a>
    </nav>
  </div>
</header>