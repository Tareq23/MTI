@extends('layout.app')


@section('content')

    @include('users.components.topNav')
    <div id="user-wrapper">
        @include('users.components.sideNav')
        @include('users.components.post')
        @include('users.components.profile')
        @include('users.components.project')
    </div>
    @include('users.components.message')
    <!-- @include('users.components.groupMessage') -->
@endsection

@section('script')
    <script type="text/javascript">
    /*

        CK-EDITOR

    */
    // $("#post-editor").ckeditor(function(){
    //     $("#postSubmitConfirmBtn").click(function(){
    //         let postValue = $("#post-editor").val();
    //         console.log(postValue);
    //     });
    // });

    /* side nav show/hide  */
    let menuBarCount = 0;
    $("#userMenuBarBtn").click(function(){
        if(menuBarCount%2==0)
        {
            $("#userSideNav").removeClass("d-none");
        }
        else{
            $("#userSideNav").addClass("d-none");
        }
        menuBarCount++;
    })

    $("#user_project").click(function(){
        $("#user_post_show").addClass("d-none");
        $("#user_profile_show").addClass("d-none");
        $("#user_project_show").removeClass("d-none");

        $("#addNewProjectBtn").click(function(){
            $("#addNewProjectModal").modal("show");
        })


    });


    /* User Post Section */

    function getUserPostShow(){
        axios.get('users/getUserPost')
            .then(function(res){
                if(res.status==200)
                {
                    let posts = res.data;
                    $("#post-show-div").empty();
                    $.each(posts,function(idx,item){
                        $('<div class="single-post mt-3">').html(
                            '<div class="post-title">'+
                                '<p><a target="_blank" href="/blog/post/'+item.slug+'" data-slug="'+item.slug+'">'+item.title+'</a></p>'+
                            '</div>'+
                            '<div class="post-content">'+ item.content +'</div>'
                        ).appendTo("#post-show-div");
                    });

                }
            }).catch(function(error){   
                console.log(error.response);
            })
    }

    $("#user_post").click(function(){
        $("#user_profile_show").addClass("d-none");
        $("#user_project_show").addClass("d-none");
        $("#user_post_show").removeClass("d-none");
        
        getUserPostShow();

        $("#addNewPostBtn").click(function(){
            $("#create_post").removeClass("d-none");
            axios.get('/users/getCategory')
                .then(function(res){
                    if(res.status==200)
                    {
                        let categories = res.data;
                        $("#categories").empty();
                        $('<option value="0">').text("Select Category").appendTo("#categories");
                        $.each(categories,(idx,item) => {
                            console.log(item.name);
                            $('<option value="'+ item.id +'">').text(item.name).appendTo("#categories");
                        });
                    }
                })
                // .catch(function(error){
                //     // console.log(error.response);
                // })
            let categoryId = '';
            $("#categories").change(function(){
                categoryId = $(this).val();
                if(categoryId === "0"){
                    $(this).css("borderColor","red");
                }
                else{
                    $(this).css("borderColor","green");
                    // console.log(categoryId);
                }
            })
            
            $("#postConfirmSubmitBtn").click(function(){
                console.log("Post Submit");
                let postHtmlText = postTextField.document.getElementsByTagName('body')[0].innerHTML;
                postHtmlText = postHtmlText.trim();
                let postMainTitle = $("#postMainTitle").val().trim();
                let tagsArray = [];
                let titleWordArray = postMainTitle.split(" ");
                let titleWordCount = titleWordArray.length;
                for(let i = 0; i<titleWordCount;i++)
                {
                    if(titleWordArray[i].length>2)
                    {
                        let tagTrimValue = titleWordArray[i].split(".");
                        let newTags = tagTrimValue.length == 1 ? tagTrimValue[0] : tagTrimValue[0] == "." ? tagTrimValue[1] : tagTrimValue[0]; 
                        let flag = tagsArray.find(tag => 
                            tag===newTags.toLowerCase()
                        );
                        if(!flag){
                            tagsArray.push(newTags.toLowerCase());
                        }
                    }
                }

                if(postMainTitle.length<10 && postMainTitle.length>295){
                    alert("Title Must be less than 250 characters and greater than 50 characters")
                }
                else if(categoryId.length<0){
                    alert("Select Category");
                }
                else{
                    axios.post('users/createPost',{
                        tags:tagsArray,
                        content:postHtmlText,
                        title : postMainTitle,
                        category : parseInt(categoryId),
                    }).then(function(res){
                        if(res.data)
                        {
                            $("#postMainTitle").val("");
                            getUserPostShow();
                        }
                    })
                    .catch(function(error){
                        console.log(error.response);
                    })
                }
            });
        })
        $("#addNewPostBtn").dblclick(function(){
            $("#create_post").addClass("d-none");
        })
    });




    /* User Profile */

    let edu_count = 0;
    function getUserProfile()
    {
        edu_count = 0;
        axios.get('/users/getProfile')
            .then(function(res){
                let user = res.data;
                if(res.status==200)
                {
                    let split_url= user.image.split('/');
                    let imgUrl = split_url[split_url.length-2]==="default" ? "{!!asset('"+user.image+"')!!}" : user.image;
                    $("#user_profile_image").attr('src',imgUrl);
                    $("#user_name").val(user.name)
                    $("#user_email").text(user.email);
                    $("#user_short_desc").val(user.description)
                    const social_link = JSON.parse(user.social_link);
                    // console.log(social_link.facebook);
                    $("#user_github").val(social_link.github);
                    $("#user_linkedin").val(social_link.linkedin);
                    $("#user_facebook").val(social_link.facebook);
                    let education = JSON.parse(user.education);
                    let today = new Date();
                    let month = today.getMonth()+1 < 10 ? "0"+(today.getMonth()+1) : (today.getMonth()+1);
                    let today_date = today.getFullYear()+"-"+month+"-"+today.getDate();
                    // console.log(today_date);
                    $("#educationAppend").empty();
                    $.each(education,function(idx,item){
                        if(education[idx].end_time === "present"){
                            $('<p>').html(
                                '<input type="text" placeholder="institution name" class="user_institute'+ edu_count +'" value="'+ education[idx].institute_name +'" /></br>' +
                                '<input type="date" placeholder="institute" class="start_time'+ edu_count +'" value="'+education[idx].start_time +'" /></br>'+ 
                                '<input type="date" placeholder="institute" class="end_time'+ edu_count +'" value="'+ today_date +'" /></br>'
                            ).appendTo("#educationAppend");
                        }
                        else{
                            $('<p>').html(
                                '<input type="text" placeholder="institution name" class="user_institute'+ edu_count +'" value="'+ education[idx].institute_name +'" /></br>' +
                                '<input type="date" placeholder="institute" class="start_time'+ edu_count +'" value="'+education[idx].start_time +'" /></br>'+ 
                                '<input type="date" placeholder="institute" class="end_time'+ edu_count +'" value="'+education[idx].end_time +'" /></br>'
                            ).appendTo("#educationAppend");
                        }
                        edu_count++;
                    })
                }
                else{
                    console.log("user get profile wrong");
                }
            })
            .catch(function(error){
                console.log(error.response);
            });
    }
    $("#user_profile").click(function(){
        $("#user_post_show").addClass("d-none");
        $("#user_project_show").addClass("d-none");
        $("#user_profile_show").removeClass("d-none");
        
        
        getUserProfile();
        let descriptionUpdate = '';
        $("#user_short_desc").change(function(){
            descriptionUpdate = $(this).val();
        });
        $("#update_short_desc_btn").click(function(){
            if(descriptionUpdate.trim().length>0)
            {
                axios.post('users/descriptionUpdate',{description:descriptionUpdate})
                .then(function(res){
                    if(res.status==200)
                    {
                        getUserProfile();
                    }
                })
                .catch(function(error){
                    console.log(error.response);
                });
            }
        });
        let facebookUrl = '',linkedinUrl='',githubUrl = '';
        $("#user_facebook").change(function(){
            facebookUrl = $(this).val().trim();
            githubUrl = $("#user_github").val().trim();
            linkedinUrl = $("#user_linkedin").val().trim();
        });
        $("#user_linkedin").change(function(){
            linkedinUrl = $(this).val().trim();
            githubUrl = $("#user_github").val().trim();
            facebookUrl = $("#user_facebook").val().trim();
        });
        $("#user_github").change(function(){
            githubUrl = $(this).val().trim();
            linkedinUrl = $("#user_linkedin").val().trim();
            facebookUrl = $("#user_facebook").val().trim();
        });
        $("#update_social_link_btn").click(function(){
            if(facebookUrl.length>0||linkedinUrl.length>0||githubUrl.length>0)
            {
                //console.log(facebookUrl+"\n"+linkedinUrl+"\n"+githubUrl);
                const linkObj = {
                    facebook : facebookUrl,
                    linkedin : linkedinUrl,
                    github : githubUrl
                };
                const linked_stringify = JSON.stringify(linkObj);
                axios.post('users/socialLinkUpdate',{
                    social_link : linked_stringify
                })
                .then(function(res){
                    if(res.status==200)
                    {
                        getUserProfile();
                    }
                })
                .catch(function(error){
                    console.log(error.response);
                })
            }
        })
        
        $("#update_profile_image").change(function(){
            $("#profile_image_error").addClass("d-none");
            let profileImgFile = $(this).prop('files')[0];
            let current_image_url =  $("#user_profile_image").attr('src');
            // console.log("current image : "+current_image_url);
            if(profileImgFile.size <= 1024 * 1000)
            {
                let fileReader = new FileReader();
                fileReader.readAsDataURL(this.files[0]);
                fileReader.onload = (event) =>{
                    let imgUrl = event.target.result;
                    $("#user_profile_image").attr('src',imgUrl);
                }

                $("#update_profile_image_btn").click(function(){
                    let formData = new FormData();
                    let imgFile = profileImgFile;;
                    formData.append('profile_image',imgFile);
                    formData.append('current_image_url',current_image_url);
                    axios.post('/users/imageUpdate',formData)
                        .then((res)=>{
                            if(res.status==200)
                            {
                                getUserProfile();
                            }
                        })
                        .catch((error)=>{
                            console.log(error.response);
                        })

                    // console.log("adds ok")
                    // console.log(imgFile);
                });
            }
            else{
                $("#profile_image_error").removeClass("d-none");
            }
            // console.log(profileImgFile);
        });


        let education_info = [];
        $("#addEducation").click(function(){
            // console.log("add Education");
            $('<p>').html(
                '<input type="text" placeholder="institution name" class="user_institute'+ edu_count +'" /></br>' +
                '<input type="date" placeholder="institute" class="start_time'+ edu_count +'" /></br>' +
                '<input type="date" placeholder="institute" class="end_time'+ edu_count +'" /></br>'
            ).appendTo("#educationAppend");
            edu_count++;
        });
        $("#update_education_info_btn").click(function(){
            for(let idx=0;idx<edu_count;idx++)
            {
                let user_institute_class = ".user_institute"+idx;
                let start_time_class = ".start_time"+idx;
                let end_time_class = ".end_time"+idx;
                let today = new Date();
                let month = today.getMonth()+1 < 10 ? "0"+(today.getMonth()+1) : (today.getMonth()+1);
                // console.log("month : "+month);
                let today_date = today.getFullYear()+"-"+month+"-"+today.getDate();
                // console.log(today_date);
                let user_institute = $(user_institute_class).val().trim();
                let start_times = $(start_time_class).val().trim();
                let end_times = $(end_time_class).val().trim();
                if(user_institute.length>2){
                    let user_edu_obj = {
                        institute_name : user_institute,
                        start_time : start_times,
                        end_time : end_times===today_date ? "present" : end_times
                    }
                    education_info.push(user_edu_obj);
                }
            }
            if(education_info.length>0)
            {
                // console.log(JSON.stringify(education_info));
                axios.post('users/educationUpdate',{
                    education : JSON.stringify(education_info)
                }).then(function(res){
                    if(res.status==200)
                    {
                        getUserProfile();
                    }
                })
                .catch(function(error){
                    
                })
            }
            else{
                alert("Your Education Field is empty");
            }
        });
    });


    function getMessageShow(id)
    {
        axios.get('/users/showMessages/'+id)
            .then(function(res){
                if(res.status==200)
                {
                    let messages = res.data;
                    $.each(messages,function(idx,item){
                        if(item.sender === id)
                        $('<p class="incoming-msg"></p>').text(item.text).appendTo(".message-body");
                        else $('<p class="outgoing-msg"></p>').text(item.text).appendTo(".message-body");
                    });
                }
            })  
            .catch(function(error){
                console.log(error.response);
            })
    }


    let messageBtnClickCount = 0;
    let message_receiver_id = 0;
    $("#userMessageBtn").click(function(){
        // $(".message-dropdown").toggleClass("d-none");
        if(messageBtnClickCount%2==0)
        {
            $(".message-dropdown").removeClass("d-none")
            
            axios.get('/users/getAllUser')
                .then(function(res){
                    if(res.status==200)
                    {
                        // console.log(res.data);
                        let users = res.data;
                        $(".message-dropdown").empty();
                        $('<li class="user-list-item">').html(
                            '<a href="#"><i class="fas fa-users"></i> Group Message</a>'
                        ).appendTo(".message-dropdown");
                        $.each(users,function(idx,item){
                            $('<li class="user-list-item" data-name="'+item.name+'" data-id="'+item.id+'">').html(
                                '<a ><i class="far fa-user"></i> '+ item.name +'</a>'
                            ).appendTo(".message-dropdown");
                        });
                        $(".user-list-item").click(function(){
                            let recipient_id = $(this).data('id');
                            message_receiver_id = recipient_id;
                            let name = $(this).data('name');
                            $(".message-box").removeClass("d-none");
                            $(".message-box").empty();
                            


                            /* Message Header */
                            
                            $('<div class="message-header d-flex justify-content-between"></div>').html(
                                '<img class="message-img" src="{{asset('images/default/user.png')}}" alt="user"/>'+
                                '<p>'+name+' <span class="close">&#x2716;</span></p>'
                            ).appendTo(".message-box");
                            
                            /* Message Body */

                                // '<p class="incoming-msg">in-coming</p>'+
                                // '<p class="outgoing-msg">out-going</p>'
                            $('<div class="message-body">').html('').appendTo('.message-box');

                            /* Message Footer */

                            $('<div class="message-footer">').html(
                                '<input type="text" class="message-input" placeholder="text" />'
                            ).appendTo('.message-box');

                            getMessageShow(recipient_id);
                            
                            $(".message-box .close").click(function(){
                                $(".message-box").addClass("d-none");
                            })

                            $(".message-input").change(function(){
                                let text = $(this).val();
                                $(this).val("");
                                if(text.length>0)
                                {
                                    axios.post('/users/sentMessage',{
                                        message : text,
                                        recipient: recipient_id
                                    })
                                    .then(function(res){
                                        if(res.data.status==404){
                                            alert(res.data.error);
                                        }
                                        else{
                                            console.log(res.data);
                                        }
                                    })
                                    .catch(function(error){
                                        console.log(error.response);
                                    })
                                }
                            });


                       

                        });
                    }
                }).catch(function(error){
                    console.log(error.response);
                });


        }
        else{
            $(".message-dropdown").addClass("d-none")
        }
        messageBtnClickCount++;
    });

    /* PUSHER FOR REALTIME DATA PASS */

    let pusher = new Pusher('816c91b939c2f0948fb7', {
                cluster: 'ap2'
            });
            let channel = pusher.subscribe('message-channel');
            channel.bind('message-event', function(data) {
                // console.log(data);
                if(data.message.sender == message_receiver_id)
                $('<p class="incoming-msg"></p>').text(data.message.text).appendTo(".message-body");
                else $('<p class="outgoing-msg"></p>').text(data.message.text).appendTo(".message-body");
            });
    
    </script>
@endsection