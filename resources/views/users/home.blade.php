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

    $("#user_post").click(function(){
        $("#user_profile_show").addClass("d-none");
        $("#user_project_show").addClass("d-none");
        $("#user_post_show").removeClass("d-none");

        $("#addNewPostBtn").click(function(){
            $("#create_post").removeClass("d-none");

            $("#postConfirmSubmitBtn").click(function(){
                console.log("Post Submit");
                let postHtmlText = postTextField.document.getElementsByTagName('body')[0].innerHTML;
                console.log(postHtmlText);
            });
        })
        $("#addNewPostBtn").dblclick(function(){
            $("#create_post").addClass("d-none");
        })


    });

    $("#user_profile").click(function(){
        $("#user_post_show").addClass("d-none");
        $("#user_project_show").addClass("d-none");
        $("#user_profile_show").removeClass("d-none");
        let edu_count = 0;
        let education_info = [];
        $("#addEducation").click(function(){
            // console.log("add Education");
            $('<p>').html(
                '<input type="text" placeholder="institute" class="user_institute'+ edu_count +'" /></br>' +
                '<input type="date" placeholder="institute" class="start_time'+ edu_count +'" /></br>' +
                '<input type="date" placeholder="institute" class="end_time'+ edu_count +'" /></br>'
            ).appendTo("#educationAppend");
            edu_count++;
        });
        $("#educationAddBtn").click(function(){
            for(let idx=0;idx<edu_count;idx++)
            {
                let user_institute = ".user_institute"+idx;
                let start_time = ".start_time"+idx;
                let end_time = ".end_time"+idx;
                let user_edu_obj = {
                    user_institute : $(user_institute).val(),
                    start_time : $(start_time).val(),
                    end_time : $(end_time).val(),
                }
                education_info.push(user_edu_obj);
            }
            console.log(education_info);
        });




    });


    </script>
@endsection