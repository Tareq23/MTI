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
                                        //    if(response.data==1)
                                        //    {
                                        //         $("#register-form").addClass("d-none");
                                        //         $(location).attr('href',"http://127.0.0.1:8000");
                                        //    }
                                            console.log(response.data);
                                            // if(response.data.status==200)
                                            // {
                                            //     alert(response.data.message);
                                            // }
                                            // else{
                                            //     alert("Somthing went wrong");
                                            // }
                                        })
                                        .catch(function(error){
                                            console.log(error.response);
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
                                $(location).attr('href',"http://127.0.0.1:8000/dashboard");
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
                    axios.get('/logout').then(function(response){
                        if(response.data==1){
                            $(location).attr('href',"/blog");
                        }
                        else{
                            alert("something went to wrong");
                        }
                    }).catch(function(error){
                        console.log(error.response);
                    })
                })
            });
    </script>
@endsection