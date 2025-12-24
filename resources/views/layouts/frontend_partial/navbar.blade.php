@php
  $show=DB::table('sites')->get();
@endphp

@foreach($show as $row)

<nav class="navbar navbar-expand-lg navbar-light">
  <div class="container">
    <a href="index.html" class="navbar-brand">
      <!-- Reve<span class="text-primary">Tive.</span> -->

      <img src="{{ asset('uploads/logo/'.$row->image) }}" name="old_photo" style="height: 60px; width: 90px;">
    </a>

    <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="navbar-collapse collapse" id="navbarContent">
      <ul class="navbar-nav ml-auto pt-3 pt-lg-0">
          <li class="nav-item active">
              <a href="{{ url('/') }}" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
              <a href="{{ route('about') }}" class="nav-link">About</a>
          </li>
          <li class="nav-item">
              <a href="{{ route('service') }}" class="nav-link">Services</a>
          </li>
          <li class="nav-item">
              <a href="{{ route('project') }}" class="nav-link">Projects</a>
          </li>
          <li class="nav-item">
              <a href="{{ route('news') }}" class="nav-link">News</a>
          </li>
          <li class="nav-item">
              <a href="{{ route('contact-us') }}" class="nav-link">Contact</a>
          </li>

          {{-- Show these only when NOT logged in --}}
          @guest
              <li class="nav-item">
                  <a href="{{ route('register') }}" class="nav-link fa fa-user"> Register</a>
              </li>
              <li class="nav-item">
                  <a href="{{ route('login') }}" class="nav-link fa fa-sign-in"> Sign in</a>
              </li>
          @endguest

          {{-- Show this only when user IS logged in --}}
          @auth
              <li class="nav-item dropdown">
                  <a href="#" class="nav-link fa fa-lock dropdown-toggle" id="navbarDropdownBlog" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      {{ Auth::user()->name }}
                  </a>
                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownBlog">
                      <a class="dropdown-item" href="{{ route('home') }}">Profile</a>
                      <a class="dropdown-item" href="{{ route('customer.logout') }}">Logout</a>
                  </div>
              </li>
          @endauth
      </ul>

    </div>
  </div> <!-- .container -->
</nav> <!-- .navbar -->

@endforeach