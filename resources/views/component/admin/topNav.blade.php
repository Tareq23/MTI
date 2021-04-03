
<nav id="adminTopNav" class="navbar navbar-expand-md bg-dark fixed-top">
  <p class="navbar-brand p-0 m-0"><i id="menuBarBtn" class="fas fa-2x fa-bars"></i></p>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto pr-5">
    <li class="nav-item active">
        <a class="nav-link" href="{{url('/')}}">Home</i></a>
      </li>
      <li class="nav-item active">
        <a class="nav-link" href="#">Message <i class="fas fa-envelope-open-text"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">project <i class="fas fa-code"></i></a>
      </li>
      <li class="nav-item" id="adminNotificationBtn">
        <a class="nav-link" href="#">Notification <i class="fas fa-bell"><span id="new_notification_show" style="font-size:1.2rem;" class="text-danger"></span></i></a>
        <ul class="notification-dropdown d-none">
          <li class="notify-list-item"><a href="#">create a new post</a></li>
          <li class="notify-list-item"><a href="#">create a new post</a></li>
          <li class="notify-list-item"><a href="#">create a new post</a></li>
          <li class="notify-list-item"><a href="#">create a new post</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>

