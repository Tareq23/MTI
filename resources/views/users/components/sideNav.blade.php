<div id="userSideNav" class="d-none">
    <ul>
        <li id="user_project"><a>Projects</a></li>
        <li id="user_profile"><a>Profile</a></li>
        <li id="user_post"><a>Posts</a></li>
        @if(session()->has('admin'))
        <li id="admin_dashboard"><a href="{{url('/admin')}}">A-Dashboard</a></li>
        @endif
    </ul>
</div>