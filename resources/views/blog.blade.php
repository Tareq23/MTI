@extends('layout.app')
@section('title','MTI | BLOG')

@section('content')

    @include('component.topNav')
    @include('component.blogTopBanner')
    @include('component.login')

    @include('component.register')

    @include('component.blogPost')

    @include('component.footer')

@endsection


@section('script')
    <script type="text/javascript">

        // let registerForm = document.getElementById("register-form");
        // let registerSubmit = document.getElementById("registerSubmit");
        // let registerBtn = document.getElementById("registerBtn");

        // registerBtn.onclick = function()
        // {

        // }

        // window.onclick(function(event){
        //     if(event.target==document.getElementById("register-form")){
        //         document.getElementById("register-form").style.display = 'none';
        //     }
        // })

            $(document).ready(function(){
                //registration form
                $("#registerBtn").click(function(){
                    $("#register-form").removeClass("d-none");
                });
                $(document).mouseup(function(event){
                    let registerContainer = $("#register-form");
                    if(!registerContainer.is(event.target) && registerContainer.has(event.target).length===0)
                    {
                        $("#register-form").addClass("d-none");
                    }
                });

                //login form

                $("#loginBtn").click(function(){
                    $("#login-form").removeClass("d-none");
                });
                $(document).mouseup(function(event){
                    let loginContainer = $("#login-form");
                    if(!loginContainer.is(event.target)&&loginContainer.has(event.target).length===0)
                    {
                        loginContainer.addClass("d-none");
                    }
                })
            })




    </script>
@endsection