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

    //scroll top
    
    window.onbeforeunload = function () {
                window.scrollTo(0,0);
            };


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
    function getUserProjects()
    {
        axios.get('/users/userProjects')
            .then(function(res){
                if(res.status==200)
                {
                    let projects = res.data;
                    $("#userAllProjects").empty();
                    $.each(projects,function(idx,item){
                        $('<div class="user-projects" title="'+item.name+'">').html(
                            '<a target="_blank" href="'+item.url+'" ><img src="'+item.image+'" alt="'+item.name+'"/></a>'
                        ).appendTo("#userAllProjects");
                    })
                    $(".user-proejcts").tooltip();
                }
            })
            .catch(function(error){
                alert("something went to wrong");
            });
    }

    $("#user_project").click(function(){
        $("#user_post_show").addClass("d-none");
        $("#user_profile_show").addClass("d-none");
        $("#user_project_show").removeClass("d-none");

        $("#addNewProjectBtn").click(function(){
            $("#addNewProjectModal").modal("show");
        })

        getUserProjects()

        $("#projectImage").change(function(){
            let projectImgFile = $(this).prop('files')[0];
            if(projectImgFile.size <= 1024 * 1000)
            {
                    $("#project_image_error").addClass("d-none");

                    let fileReader = new FileReader();
                    fileReader.readAsDataURL(this.files[0]);
                    fileReader.onload = (event) =>{
                        let imgUrl = event.target.result;
                        $(".project-image-preview").removeClass("d-none");
                        $("#projectImagePreviewId").attr('src',imgUrl);
                    }



                    $("#postAddConfirmBtn").click(function(){
                        let formData = new FormData();
                        let imgFile = projectImgFile;;
                        formData.append('project_image',imgFile);

                        let project_name = $("#projectName").val().trim();
                        let project_url = $("#projectLiveUrl").val().trim();

                        if(project_name.length<5&&project_name.length>150)
                        {
                            $("#project_name_error").removeClass("d-none");
                        }
                        else if(project_url.length<5)
                        {
                            $("#project_url_error").removeClass("d-none");
                        }
                        else{
                            formData.append('project_name',project_name);
                            formData.append('project_url',project_url);
                            // console.log(formData);
                            axios.post('/users/createProject',formData)
                            .then((res)=>{
                                if(res.data.status==200)
                                {
                                    // console.log(res.data);
                                    $("#projectName").val("");
                                    $("#projectLiveUrl").val("");
                                    $("#projectImage").val("");
                                    $(".project-image-preview").addClass("d-none");
                                    $("#project_url_error").addClass("d-none");
                                    $("#project_name_error").addClass("d-none");
                                    $("#addNewProjectModal").modal('hide');
                                }
                            })
                            .catch((error)=>{
                                console.log(error.response);
                            })
                        }
                        
                        // console.log("adds ok")
                        // console.log(imgFile);
                    });
            }
            else{
                $("#project_image_error").removeClass("d-none");
                $(".project-image-preview").addClass("d-none");
            }
        });







       
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
                        let content = JSON.parse(item.content);
                        $('<div class="single-post mt-3">').html(
                            '<div class="post-title">'+
                                '<p><a target="_blank" href="/blog/post/'+item.slug+'" data-slug="'+item.slug+'">'+item.title+'</a></p>'+
                            '</div>'+
                            '<div class="post-img">'+
                                '<img src="'+content.image+'" alt="'+item.title+'"/>'+
                            '</div>'+
                            '<div class="post-content">'+content.text +'</div>'
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
                            // console.log(item.name);
                            $('<option value="'+ item.id +'">').text(item.name).appendTo("#categories");
                        });
                    }
                })
                .catch(function(error){
                    console.log(error.response);
                })
            let categoryId = '-1';
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

                function isValidURL(str) {
                    var regex = /(http|https):\/\/(\w+:{0,1}\w*)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%!\-\/]))?/;
                    if(!regex .test(str)) {
                        return false;
                    } else {
                        return true;
                    }
                }

                let image_url = $("#postMainImage").val();
                // console.log(image_url);
                if((postMainTitle.length<10 || postMainTitle.length>295)){
                    alert("Title Must be less than 250 characters and greater than 10 characters")
                }
                else if((parseInt(categoryId)<=0)|| !isValidURL(image_url)){
                    alert("Invalid Input Field");
                }
                else if(postHtmlText.length<500)
                {
                    alert("Please Add More Text as Post Content")
                }
                else{
                    axios.post('users/createPost',{
                        tags:tagsArray,
                        url:image_url,
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
                    console.log(user.image);
                    let split_url= user.image.split('/');
                    let imgUrl = split_url[split_url.length-2]==="default" ? "{!!asset('"+user.image+"')!!}" : user.image;
                    $("#user_profile_image").attr('src',imgUrl);
                    console.log(res);
                    $("#user_name").val(user.name)
                    $("#user_email").text(user.email);
                    $("#user_short_desc").val(user.description)

                    if(user.social_link !== null ){
                        const social_link = JSON.parse(user.social_link);
                        console.log(social_link);
                        $("#user_github").val(social_link.github);
                        $("#user_linkedin").val(social_link.linkedin);
                        $("#user_facebook").val(social_link.facebook);
                    }
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
                    console.log(messages);
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
                            // $(".message-body").animate({ scrollBottom: $(".message-body")[0].scrollHeight },0);
                            // $(".message-body").scrollTo(0,document.body.scrollHeight);
                            let message_box_height = $(".message-body").scrollTop(100);
                            console.log(message_box_height);
                            $(".message-box .close").click(function(){
                                $(".message-box").addClass("d-none");
                            })

                            $(".message-input").change(function(){
                                let text = $(this).val();
                                $(this).val("");
                                if(text.length>0)
                                {
                                    console.log("reciver : "+recipient_id);
                                    axios.post('/users/sentMessage',{
                                        message : text,
                                        recipient: recipient_id
                                    })
                                    .then(function(res){
                                        if(res.data.status==404){
                                            alert(res.data.error);
                                        }
                                    })
                                    .catch(function(error){
                                    })
                                }
                            });


                       

                        });
                    }
                }).catch(function(error){
                });
        }
        else{
            $(".message-dropdown").addClass("d-none")
        }
        messageBtnClickCount++;
    });

    /* User Notification */
    let notificationBtnClickCount=0;
    $("#userNotificationBtn").click(function(){
        if(notificationBtnClickCount%2==0)
        {
            $(".notification-dropdown").removeClass("d-none");

            //$("#userNotificationBtn").click(function(){
                axios.get('/users/getNotification')
                    .then(function(res){
                        if(res.status==200)
                        {
                            $("#user_unread_notification").text('');
                            let notifies = res.data;
                            $(".notification-dropdown").empty();
                            $.each(notifies,function(idx,notify){
                                let data = JSON.parse(notify.data);
                                if(data.type=='post')
                                {
                                    if(data.details.verified==0)
                                    {
                                        $('<li class="notify-list-item">').html(
                                            '<a>waiting for verified by admin</a>'
                                        ).appendTo(".notification-dropdown");
                                        // console.log("your post pending");
                                    }
                                    else{
                                        $('<li class="notify-list-item">').html(
                                            '<a>Your Post Is Verified</a>'
                                        ).appendTo(".notification-dropdown");
                                    }   
                                }
                                else if(data.type=='project'){
                                    if(data.details.verified==0)
                                    {
                                        $('<li class="notify-list-item">').html(
                                            '<a>waiting for verified by admin</a>'
                                        ).appendTo(".notification-dropdown");
                                        // console.log("your post pending");
                                    }
                                    else{
                                        $('<li class="notify-list-item">').html(
                                            '<a>Your project Is Verified</a>'
                                        ).appendTo(".notification-dropdown");
                                    }   
                                }
                            })
                        }
                    })
                    .catch(function(error){
                        console.log(error.response);
                    })
            // });
        }
        else{
            $(".notification-dropdown").addClass("d-none");
        }
        notificationBtnClickCount++;
    })

    /* PUSHER FOR REALTIME Message PASS */

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


            let notify = {!!$notify!!}
            // console.log(notify);
            if(notify>0)
            {
                $("#user_unread_notification").text(notify);
            }
            let post_modified_pusher = new Pusher('816c91b939c2f0948fb7', {
                cluster: 'ap2'
            });
            let post_modified_channel = post_modified_pusher.subscribe('post_modified_channel');
            post_modified_channel.bind('post_modified_event', function(data) {
                let unread_notification = $("#user_unread_notification").text()==''?0:parseInt($("#user_unread_notification").text());
                $("#user_unread_notification").text(unread_notification+1)
                console.log(unread_notification);
            });
            
    </script>
@endsection