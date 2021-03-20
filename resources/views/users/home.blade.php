@extends('layout.app')


@section('content')

    @include('users.components.topNav')
    <div id="user-wrapper">
        @include('users.components.sideNav')
        @include('users.components.post')
        @include('users.components.profile')
        @include('users.components.project')
    </div>

@endsection

@section('script')
    <script type="text/javascript">
    /*

        CK-EDITOR

    */
    //CKEDITOR.replace("post-editor")
    CKEDITOR.editorConfig = function( config ) {
    config.extraPlugins = 'imageuploader';
    };
    $("#post-editor").ckeditor(function(){
        $("#postSubmitConfirmBtn").click(function(){
            let postValue = $("#post-editor").val();
            console.log(postValue);
        });
    });

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

    $("#user_post").click(function(){
        $("#user_profile_show").addClass("d-none");
        $("#user_project_show").addClass("d-none");
        $("#user_post_show").removeClass("d-none");

        $("#addNewPostBtn").click(function(){
            $("#addNewPostModal").modal('show');
        })


    });

    $("#user_profile").click(function(){
        $("#user_post_show").addClass("d-none");
        $("#user_project_show").addClass("d-none");
        $("#user_profile_show").removeClass("d-none");
    });


    </script>
@endsection