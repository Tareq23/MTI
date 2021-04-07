@extends('layout.app')
@section('title','HOME')


@section('content')
    @include('component.topNav')
    <!-- <div class="my-5"></div> -->
    @include('component.topBanner')
    <div class="mb-5" style="margin-top:16rem;"></div>
    @include('component.usedTechnology')
    <div class="my-5"></div>
    @include('component.projects')
    <div class="my-5"></div>
    @include('component.teamMember')
    <div class="my-5"></div>
    @include('component.contact')
    <div class="my-5"></div>
    @include('component.footer')
@endsection




@section('script')
    <script type="text/javascript">
        $(document).ready(function(){
            //scroll top
            window.onbeforeunload = function () {
                window.scrollTo(0,0);
            };
            // $('iframe').css("width")
            console.log(window.innerWidth);
            if(window.innerWidth<=800)
            {
                let width = window.innerWidth
                $("iframe").outerWidth(width);
            }
            const posts = {!!$posts!!}
            $.each(posts,function(idx,post){
                $('<li class="list-group-item">').html(
                    '<a target="_blank" href="blog/post/'+post.slug+'">'+post.title+'</a>'
                ).appendTo("#footer_post_link");
            })
            function validateEmail(email) {
                const re = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(String(email).toLowerCase());
            }
            $("#contactMessageConfirmBtn").click(function(){
                let name = $("#contactName").val().trim();
                let email = $("#contactEmail").val().trim();
                let subject = $("#contactSubject").val().trim();
                let message = $("#contactMessage").val().trim();
                //let contactArray = [name,email,message,subject];
                if(name.length<4||name.length>45){
                    alert("Name Must be more than 4 characters and less than 40 characters");
                }
                else if(email.length<=5){
                    alert("Empty Email");
                }
                else if(!validateEmail(email)){
                   alert("inValid Email");
                }
                else if(subject.length<10){
                    alert("Subject More than 10 Characters");
                }
                else if(message.length<=0){
                    alert("Empty Message");
                }
                else{
                    axios.post('/contacts',{
                        name:name,
                        email:email,
                        subject:subject,
                        message:message
                    })
                    .then(function(response){
                        // console.log(response);
                        if(response.status==201)
                        {
                            alert("Message Sent success");
                        }
                        else{
                            alert("Something went to wrong!");
                        }
                    })
                    .catch(function(error){
                        console.log(error.response);
                    })
                }
            });
        })
    </script>
@endsection

