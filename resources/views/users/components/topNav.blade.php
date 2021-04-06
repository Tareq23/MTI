
<nav id="userTopNav" class="navbar navbar-expand-md bg-dark fixed-top">
  <p class="navbar-brand p-0 m-0"><i id="userMenuBarBtn" class="fas fa-2x fa-bars"></i></p>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto pr-5">
      <li class="nav-item active">
        <a class="nav-link" href="{{url('/')}}">Home</i></a>
      </li>
      <li class="nav-item" id="userMessageBtn">
        <a class="nav-link" href="#">Message <i class="fas fa-envelope-open-text"><span id="unread_user_message"></span></i></a>
        <ul class="message-dropdown d-none">
          <!-- <li class="user-list-item"><a href="#"><i class="fas fa-users"></i> Group Message</a></li>
          <li class="user-list-item"><a href="#"><i class="far fa-user"></i> user name</a></li>
          <li class="user-list-item"><a href="#"><i class="far fa-user"></i> user name</a></li>
          <li class="user-list-item"><a href="#"><i class="far fa-user"></i> user name</a></li>
          <li class="user-list-item"><a href="#"><i class="far fa-user"></i> user name</a></li> -->
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">project <i class="fas fa-code"></i></a>
      </li>
      <li class="nav-item" style="cursor:pointer;" id="userNotificationBtn">
        <a class="nav-link" >Notification <i class="fas fa-bell"><span id="user_unread_notification" style="font-size:1.3rem;" class="text-danger"></span></i></a>
        <ul class="notification-dropdown d-none">
          <!-- <li class="notify-list-item"><a href="#">create a new post</a></li>
          <li class="notify-list-item"><a href="#">create a new post</a></li>
          <li class="notify-list-item"><a href="#">create a new post</a></li>
          <li class="notify-list-item"><a href="#">create a new post</a></li> -->
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{url('/logout')}}">Logout <i class="fas text-danger fa-sign-out-alt"></i></a>
      </li>
    </ul>
  </div>
</nav>

