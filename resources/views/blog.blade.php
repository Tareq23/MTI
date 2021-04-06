@extends('layout.app')
@section('title','MTI | BLOG')

@section('content')

    @include('component.topNav')
    @include('component.blogTopBanner')
    @include('component.login')
    @include('component.reset_password')

    @if(isset($reset_password))
        @include('component.new_password')
    @endif
    
    @include('component.register')

    @include('component.blogPost')

    @include('component.footer')

@endsection


@section('script')
    <script type="text/javascript">
            function isEmail(email) {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return regex.test(email);
            }
            $(document).ready(function(){
                //registration form
                $("#registerBtn").click(function(){
                    $("#register-form").removeClass("d-none");
                });

                $("#registerSubmit").click(function(){
                    let registerEmail = $("#registerEmail").val();
                    if(isEmail(registerEmail.trim())){
                        //console.log(email);
                        axios.post('/checkEmail',{email:registerEmail})
                            .then(function(response){
                                console.log(response.data);
                                if(response.data==0)
                                {
                                    
                                    let registerName = $("#registerName").val().trim();
                                    let registerPassword = $("#registerPassword").val().trim();
                                    if(registerName.length>45 || registerName.length<4)
                                    {
                                        alert("Your Name must be more than 4 characters and less than 45 characters");
                                    }
                                    else if(registerPassword.length<8)
                                    {
                                        alert("Password Length more than 8 Eight");
                                    }
                                    else{
                                        axios.post('/register',{
                                            name:registerName,
                                            email:registerEmail,
                                            password:registerPassword
                                        }).then(function(response){
                                            if(response.status==200||response.status==201)
                                            {
                                                $("#register-form").addClass("d-none");
                                                alert("Please Check Your Email For Verified");
                                            }
                                            else{
                                                alert("something went to wrong");
                                            }
                                        })
                                        .catch(function(error){
                                            // console.log(error.response);
                                            alert("something went to wrong");
                                        });
                                    }
                                }
                                else{
                                    alert("This Email already used")
                                }
                            })
                            .catch(function(error){
                                console.log("error");
                            })
                    }
                    else{
                        alert("Invalid Email")
                    }
                })

                $(document).mouseup(function(event){
                    let registerContainer = $("#register-form");
                    if(!registerContainer.is(event.target) && registerContainer.has(event.target).length===0)
                    {
                        $("#register-form").addClass("d-none");
                    }
                });

                //login form

                $(document).mouseup(function(event){
                    $("#loginBtn").click(function(){
                        $("#login-form").removeClass("d-none");
                    });
                    let loginContainer = $("#login-form");
                    if(!loginContainer.is(event.target)&&loginContainer.has(event.target).length===0)
                    {
                        loginContainer.addClass("d-none");
                    }
                });
                $("#loginConfirmBtn").click(function(){
                    let userEmail = $("#loginEmail").val();
                    let userPassword = $("#loginPassword").val();
                    if(isEmail(userEmail)&&userPassword.length>7&&userPassword.length<=20)
                    {
                        axios.post('/login',{
                            email:userEmail,
                            password:userPassword
                        }).then(function(response){
                            if(response.data){
                                $("#login-form").addClass("d-none");
                                $(location).attr('href',"/"+response.data);
                            }
                            else{
                                $("#login-form").addClass("d-none");
                                alert("Invalid Email or Password");
                            }
                        }).catch(function(error){
                            alert("Something went to wrong");
                        })
                    }
                    else{
                        alert("Invalid Email or Password");
                    }
                });
                $("#logoutBtn").click(function(){
                    console.log("user logout");
                    axios.get('/logout').then(function(response){

                        if(response.data==1){
                            $(location).attr('href',"/blog");
                        }
                        else{
                            alert("something went to wrong");
                        }
                    }).catch(function(error){
                        console.log(error.response);
                    });
                });
                $("#haveAccount").click(function(){
                    $("#reset-password-form").addClass("d-none");
                    $("#login-form").removeClass("d-none");
                });
                $("#forgetPasswordBtn").click(function(){
                    $("#reset-password-form").removeClass("d-none");
                    $("#login-form").addClass("d-none");
                });

                $(document).mouseup(function(event){
                    // $("#reset_password_confirm_btn").click(function(){
                    //     $("#login-form").removeClass("d-none");
                    // });
                    let passwordContainer = $("#reset-password-form");
                    if(!passwordContainer.is(event.target)&&passwordContainer.has(event.target).length===0)
                    {
                        passwordContainer.addClass("d-none");
                    }
                });


                $("#reset_password_confirm_btn").click(function(){
                    let user_email = $("#userEmail").val().trim();
                    // let new_password = $("#").val().trim();
                    if(!isEmail(user_email))
                    {   
                        alert("Invalid Email");
                    }
                    else{
                        axios.post('/password-reset',{
                            email:user_email
                        }).then(function(response){
                            if(response.data==200||response.data==201)
                            {
                                alert("Please Check Your Email for reset password")
                                $("#reset-password-form").addClass("d-none");
                            }
                            else{
                                alert("Your Email Not found!");
                                console.log(response.data);
                            };
                        })
                        .catch(function(error){
                            console.log(error.response);
                        });
                    }
                })

                $("#new_password_confirm_btn").click(function(){
                    let user_email = $("#newPassword_email").val();
                    let new_pass = $("#newPassword").val().trim();
                    let confirm_pass = $("#confirmPassword").val().trim();
                    console.log(user_email);
                    if(new_pass.length<8||new_pass>20)
                    {
                        alert("Password Must be Eight Characters");
                    }
                    else if(new_pass!==confirm_pass)
                    {
                        alert("Password must be matched");
                    }
                    else{
                        axios.post('/newpassword',{
                            password:new_pass,
                            email : user_email
                        })
                        .then(function(res){
                            if(res.status==200||res.status==201)
                            {
                                $("#new-password-form").addClass("d-none");
                                $(location).attr('href', '/blog');
                            }
                            else{
                                alert("somethin went wrong");
                            }
                        }).catch(function(error){
                            console.log(error.response)
                        })
                    }
                });
            });
    </script>
@endsection