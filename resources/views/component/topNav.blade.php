
<nav id="topNav" class="navbar navbar-expand-md fixed-top">
  <a class="navbar-brand" href="#">MD TAREQUL ISLAM</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto pr-5">
      <li class="nav-item active">
        <a class="nav-link" href="/">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/#project">project</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/#teamMember">team</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/#contact">contact</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('blogHome')}}">blog</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          
        </a>
        <div class="dropdown-menu p-0" aria-labelledby="navbarDropdownMenuLink">
          @if(session()->has('userId'))
          <a class="dropdown-item" id="logoutBtn">logout</a>
          @else
          <a class="dropdown-item" id="loginBtn">login</a>
          <a class="dropdown-item" id="registerBtn">register</a>
          @endif
        </div>
      </li>
    </ul>
  </div>
</nav>

