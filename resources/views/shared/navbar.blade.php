<nav class="navbar navbar-expand-lg bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="{{ route('posts.index') }}">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Posts
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item {{ request()->routeIs('posts.index') ? 'active' : '' }}" href="{{ route('posts.index') }}">Posts List</a></li>
            <li><a class="dropdown-item {{ request()->routeIs('posts.create') ? 'active' : '' }}" href="{{ route('posts.create') }}">New Post</a></li>
          </ul>
        </li>
      </ul>
    </div>
  </div>
</nav>
