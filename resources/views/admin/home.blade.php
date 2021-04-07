@extends('layout.app')


@section('content')

    @include('component.admin.topNav')
    <div class="admin-wrapper">
        <div id="sideNav" class="">
            @include('component.admin.sideNav')
        </div>
        <div id="admin_other" class="d-none">
            @include('component.admin.others')
        </div>
        <div  id="admin_role" class="d-none">
            @include('component.admin.userRole')
        </div>
        <div id="admin_project" class="d-none">
            @include('component.admin.project')
        </div>
        <div id="admin_technology" class="d-none">
            @include('component.admin.technology')
        </div>
        <div id="admin_contact" class="d-none">
            @include('component.admin.contact')
        </div>
        <div id="admin_team" class="d-none">
            @include('component.admin.team_member')
        </div>
        <div id="admin_gallery" class="d-none">
            @include('component.admin.gallery')
        </div>
        <div id="admin_site_home_page" class="d-none">
            @include('component.admin.home_page')
        </div>
        <div id="admin_post" class="d-none">
            @include('component.admin.post')
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">


        //scroll top
        window.onbeforeunload = function () {
                window.scrollTo(0,0);
            };
            
        let sideNavToggleCount = 0;
        let sideNavWidth = $("#sideNav").width();
        let windowWidth = $(window).width();
        // console.log(sideNavWidth+"\n"+windowWidth);
        $("#menuBarBtn").click(function(){
            sideNavToggleCount++;
            if(sideNavToggleCount%2==1){
                $("#sideNav").removeClass("d-none");
                
            }
            else{
                $("#sideNav").addClass("d-none");
            }
        })


        /* Notification */
        let pusher = new Pusher('816c91b939c2f0948fb7', {
            cluster: 'ap2'
        });
        let channel = pusher.subscribe('new_post_channel');
        channel.bind('new_post_event', function(item){
            let unread_notification = $("#new_notification_show").text();
            $("#new_notification_show").text(unread_notification==''?1:parseInt(unread_notification)+1);
        });
        let unread_notification = {!!$notify!!};
        // console.log(unread_notify);
        $("#new_notification_show").text(unread_notification==0?'':unread_notification);
        let notificationBtnClickCount = 0;
        $("#adminNotificationBtn").click(function(){
            if(notificationBtnClickCount%2==0)
            {
                $(".notification-dropdown").removeClass("d-none");
                $("#new_notification_show").text('');
                $(".notification-dropdown").empty();
                axios.get('admin/allNotification')
                    .then(function(res){
                        let notify_data = res.data;
                        let item_details = '';
                        $.each(notify_data,function(idx,item){
                            item_details = JSON.parse(item.data);
                            $('<li class="notify-list-item">').html(
                                '<a class="notifyListBtn" data-type="'+item_details.type+'" data-id="'+item_details.details.id+'">created a new '+item_details.type+' by '+item_details.created_by+'</a>'
                            ).appendTo(".notification-dropdown");
                        });

                        $(".notifyListBtn").click(function(){
                            let type=$(this).data('type');
                            if(type=="post")
                            {
                                let post_id = $(this).data('id');
                                
                            }
                            else{

                            }
                        })

                    }).catch(function(error){
                        console.log(error.response);
                    });
            }
            else{
                $(".notification-dropdown").addClass("d-none");
            }
            notificationBtnClickCount++;
        })


        /* Post Section */

        function showAllPost(){
            axios.get('/admin/getAllPost')
                .then(function(res){    
                    if(res.status==200)
                    {
                        let posts = res.data;
                        $("#post_table").empty();
                        $.each(posts,function(idx,post){
                            let verified = post.verified==0 ? "" : "selected";
                            let pending = post.verified==0? "selected" : "";
                            let verified_class = post.verified==0 ? "text-danger" : "text-success"
                            $('<tr></tr>').html(
                                '<td>'+post.title+'</td>'+
                                '<td>'+
                                    '<select id="select_post_'+post.id+'" data-id="'+post.id+'" class="form-control post_verified_btn '+verified_class+'">'+
                                        '<option  '+pending+' value="0">pending</option>'+
                                        '<option  '+verified+' value="1">verified</option>'+
                                    '</select>'
                                +'</td>'+
                                '<td><a class="postDetailsBtn" data-id="'+post.id+'"><i class="fas fa-eye"></i></a></td>'+
                                '<td><a class="postDeleteBtn" data-id="'+post.id+'"><i class="fas fa-trash-alt"></i></a></td>'
                            ).appendTo("#post_table");
                        })
                        $(".postDeleteBtn").click(function(){
                            let post_id = $(this).data('id');
                            $("#postDeleteModal").modal('show');
                            $("#post_delete_id").val(post_id);
                            
                        });
                        $("#postDeleteConfirmBtn").click(function(){
                            let post_id = $("#post_delete_id").val();
                            console.log("Delete Post Id : "+post_id);
                            axios.post('/admin/deletePost',{id:post_id})
                                .then(function(res){
                                    if(res.data)
                                    {
                                        alert("Delete Success");
                                        showAllPost();
                                    }
                                    else{
                                        alert("Something Went to Wrong");
                                    }
                                    $("#postDeleteModal").modal('hide');
                                })      
                                .catch(function(error){
                                    console.log(error.response);
                                })                      
                        })
                        $(".postDetailsBtn").click(function(){
                            let post_id = $(this).data('id');
                            axios.post('/admin/singlePostShow',{id:post_id})
                                .then(function(res){
                                    // console.log(res.data);
                                    if(res.status==200)
                                    {
                                        $("#postDetailsShowModal").modal('show');
                                        // let string_parse = JSON.parse(res.data.content);
                                        $.parseHTML(res.data.content);
                                        $("#post_content_details").html($.parseHTML(res.data.content));
                                    }
                                    else{
                                        // $("#postDetailsShowModal").modal('s');
                                    }
                                })
                                .catch(function(error){
                                    console.log(error.response);
                                })
                        })
                        $(".post_verified_btn").change(function(){
                            let post_id = $(this).data('id');
                            let verified_value = $(this).val();
                            let select_post_id = '#select_post_'+post_id;
                            axios.post('/admin/postVerified',{id:post_id,value:parseInt(verified_value)})
                                .then(function(res){
                                        console.log("verified_post : "+post_id);
                                    if(res.status==200||res.status==201){
                                        if(parseInt(verified_value)){
                                            $(select_post_id).removeClass("text-danger")
                                            $(select_post_id).addClass("text-success");
                                        }
                                        else{
                                            $(select_post_id).addClass("text-danger")
                                            $(select_post_id).removeClass("text-success");
                                        }
                                    }
                                })
                                .catch(function(error){
                                    console.log(error.response);
                                })
                        })
                    }
                }).catch(function(error){
                    console.log(error.response);
                });
        }
        function showCategoryPost(category_id)
        {
            axios.post('/admin/categoryPost',{id:category_id})
                .then(function(res){
                   if(res.status==200)
                   {
                       let posts = res.data;
                       $("#post_table").empty();
                        $.each(posts,function(idx,post){
                            let verified = post.verified==0 ? "" : "selected";
                            let pending = post.verified==0 ? "selected" : "";
                            let verified_class = post.verified==0 ? "text-danger" : "text-success"
                            $('<tr></tr>').html(
                                '<td>'+post.title+'</td>'+
                                '<td>'+
                                    '<select id="select_post_'+post.id+'"  data-id="'+post.id+'" class="form-control post_verified_btn '+verified_class+'">'+
                                        '<option '+pending+' value="0">pending</option>'+
                                        '<option '+verified+' value="1">verified</option>'+
                                    '</select>'
                                +'</td>'+
                                '<td><a class="postDetailsBtn" data-id="'+post.id+'"><i class="fas fa-eye"></i></a></td>'+
                                '<td><a><i class="fas fa-trash-alt"></i></a></td>'
                            ).appendTo("#post_table");
                        })


                        $(".postDetailsBtn").click(function(){
                            let post_id = $(this).data('id');
                            axios.post('/admin/singlePostShow',{id:post_id})
                                .then(function(res){
                                    // console.log(res.data);
                                    if(res.status==200)
                                    {
                                        $("#postDetailsShowModal").modal('show');
                                        // let string_parse = JSON.parse(res.data.content);
                                        $.parseHTML(res.data.content);
                                        $("#post_content_details").html($.parseHTML(res.data.content));
                                    }
                                    else{
                                        // $("#postDetailsShowModal").modal('s');
                                    }
                                })
                                .catch(function(error){
                                    console.log(error.response);
                                })
                        })

                        $(".post_verified_btn").change(function(){
                            let post_id = $(this).data('id');
                            let verified_value = $(this).val();
                            let select_post_id = '#select_post_'+post_id;
                            // console.log(post_id);
                            axios.post('/admin/postVerified',{id:post_id,value:parseInt(verified_value)})
                                .then(function(res){
                                    if(res.status==200||res.status==201){
                                        if(parseInt(verified_value)){
                                            $(select_post_id).removeClass("text-danger")
                                            $(select_post_id).addClass("text-success");
                                        }
                                        else{
                                            $(select_post_id).addClass("text-danger")
                                            $(select_post_id).removeClass("text-success");
                                        }
                                    }
                                })
                                .catch(function(error){
                                    console.log(error.response);
                                })
                        })
                   }
                }).catch(function(error){
                    console.log(error.response);
                });
        }
        function showCategory(){
            axios.get('/admin/getCategory')
                .then(function(res){
                    if(res.status==200)
                    {
                        let categories = res.data;
                        // $("#select_category_for_post").
                        $("#select_category_for_post").empty();
                        $('<option value="0">All Category</option>').appendTo("#select_category_for_post");
                        $.each(categories,function(idx,item){
                            $('<option value="'+item.id+'">'+item.name+'</option>').appendTo("#select_category_for_post");
                        })
                        $("#select_category_for_post").change(function(){
                            let cat_id = $(this).val();
                            if(cat_id==0)
                            {
                                showAllPost();
                            }
                            else{
                            showCategoryPost(cat_id);
                            }
                        })
                    }
                })
                .catch(function(error){
                    console.log(error.response);
                })
        }
        
        
        $("#sideNav_postBtn").click(function(){

            $("#admin_technology").addClass("d-none");
            $("#admin_project").addClass("d-none");
            $("#admin_contact").addClass("d-none");
            $("#admin_team").addClass("d-none");
            $("#admin_other").addClass("d-none");
            $("#admin_gallery").addClass("d-none");
            $("#admin_site_home_page").addClass("d-none");
            $("#admin_role").addClass("d-none");
            $("#admin_post").removeClass("d-none");
            /* Show All Category*/
            showCategory();
            /* Showing All Posts */
            showAllPost()
        });

        /* ADMIN ROLE SET FOR TEAM MEMBERS OR BLOGGERS */
        $("#sideNav_roleBtn").click(function(){
            $("#admin_technology").addClass("d-none");
            $("#admin_project").addClass("d-none");
            $("#admin_contact").addClass("d-none");
            $("#admin_team").addClass("d-none");
            $("#admin_other").addClass("d-none");
            $("#admin_gallery").addClass("d-none");
            $("#admin_site_home_page").addClass("d-none");
            $("#admin_post").addClass("d-none");
            $("#admin_role").removeClass("d-none");
            $(document).ready(function() {
                axios.get('/admin/getAllVerifiedUser').then(function(response){
                    if(response.status==200)
                    {
                        let userData = response.data;
                        let roles='';
                        let userCounter = 0;
                        $('#userRoleTableBody').empty();
                        $.each(userData,function(idx,item){
                            
                            axios.post('/admin/getRole',{id:userData[idx].id}).then(function(response){
                                let roleData = response.data;

                                $.each(roleData,function(idx2,item2){
                                     roles +=  roleData[idx2].name + ','
                                });
                                
                                roles = roles.substring(0,roles.length-1);
                                let user_role_class = ".user-role"+idx;
                                $(user_role_class).html(roles);
                                roles = '';
                                userCounter++;

                            }).catch(function(error){
                                console.log(error.response);
                            });
                            // console.log("scope outside : "+ $("#role-html-id").val())
                            
                            $('<tr>').html(
                                '<td>'+userData[idx].email+'</td>'+
                                '<td class="user-role'+idx+'"> </td>' + 
                                '<td><a class="roleEditBtn" data-id='+ userData[idx].id +'><i class="fas fa-edit"></i></a></td>'
                            ).appendTo("#userRoleTableBody");
                            $(".roleEditBtn").click(function(event){
                                event.preventDefault();
                                let userId = $(this).data('id');
                                 $("#updateUserRoleModal").modal('show');
                                updateRole(userId);
                            })
                        });
                    }
                    else{
                    
                    }
                }).
                catch(function(error){
                    console.log(error.response);
                })
            } );
            $("#addRoleConfirmBtn").click(function(){
                let role = $("#roleInputValue").val().trim();
                    if(role.length>=4){
                    axios.post('admin/add/role',{name:role}).then(function(response){
                        if(response.data==0){
                            alert("This name already used");
                        }
                        else if(response.data==1){
                            $("#roleInputValue").val("");
                            $("#addUserRoleModal").modal('hide');
                            alert("Successfully Added");
                        }
                        else{
                            alert("Something went to wrong");
                        }
                    }).catch(function(error){
                        console.log(error.response)
                        alert("something missing");
                    });
                }
                else{
                    alert("At least 4 Characters Required!");
                }
            })
        });

        function updateRole(userId)
        {   
            let roleCheckValue = '';
            let currentRole = '';
            $("#updateRoleUserId").val(userId)
            axios.post('/admin/getRole',{id:userId}).then(function(response){
                if(response.status==200){
                    let userRole;
                    userRole = response.data;
                        currentRole = '';
                    $.each(userRole,function(idx){
                        currentRole += userRole[idx].id + ',';
                    });
                    
                    axios.get('/admin/allRoles')
                        .then(function(response){
                            if(response.status==200)
                            {
                                let roles = response.data;
                                $("#updateRoleModalShowRole").empty();
                                $.each(roles,function(idx,item){
                                    $('<div class="roleCheckBox">').html(
                                        '<label ><input type="checkbox" class="roleCheckItem" value="'+ roles[idx].id +'"/>'+roles[idx].name+'</label>'
                                    ).appendTo('#updateRoleModalShowRole');

                                });
                                $(".roleCheckItem").click(function(){
                                    roleCheckValue='';
                                    $(".roleCheckItem:checked").each(function(){
                                        roleCheckValue += $(this).val() + ',';
                                    })
                                })
                                // $("#updateRoleConfirmBtn").click(function(){
                                //     if(roleCheckValue.length>0){
                                //         let roles = roleCheckValue.substring(0,roleCheckValue.length-1);
                                //         console.log(roles); 
                                //     }
                                // })
                            }
                        }).catch(function(error){
                            console.log(error.response);
                        })
                }
            }).catch(function(error){
                console.log(error.response);
            })
           
            $("#updateRoleConfirmBtn").click(function(){
                let userId = $("#updateRoleUserId").val();
                if(roleCheckValue.length>0){
                    let rolesUpdate = roleCheckValue.substring(0,roleCheckValue.length-1);
                    let presentRole = currentRole.substring(0,currentRole.length-1);
                    // console.log(rolesUpdate);
                    // console.log("userCurrentRole : "+currentRole);
                    axios.post('/admin/setRole',{
                        id:userId,
                        currentRole:presentRole,
                        updateRole:rolesUpdate,
                    }).then(function(response){
                        console.log(response.data);
                        if(response.data==1)
                        {
                            $("#updateUserRoleModal").modal('show');
                            $(location).attr('href','/admin');
                        }
                    })
                    .catch(function(error){
                        console.log(error.response);
                    })
                    roleCheckValue=''; 
                }
            })
            
        }

        /* ADMIN TECHNOLOGY PORTION */

        function showAllTechnology()
        {
            axios.get('/admin/getAllTechnology')
                .then(function(res){
                   if(res.status==200)
                   {
                       $("#technologyTable").empty();
                       let technologies = res.data;
                       $.each(technologies,function(idx,item){
                            $('<tr>').html(
                                '<td>'+item.name+'</td>'+
                                '<td><a style="cursor:pointer;color:red;" class="technologyDeleteBtn" data-id="'+item.id+'"><i class="fas fa-trash"></i></a></td>'
                            ).appendTo("#technologyTable");
                       });
                       $(".technologyDeleteBtn").click(function(){
                            let tech_id = $(this).data('id');
                            $("#technologyDeleteConfirmBtn").val(tech_id);
                            $("#technologyDelectModal").modal('show');
                       })
                   }
                })
                .catch(function(error){
                    console.log(error.response);
                })
        }
        $("#technologyDeleteConfirmBtn").click(function(){
            let tech_id = $(this).val();
            axios.post('/admin/deleteTechnology',{
                technology_id : tech_id
            }).then(function(res){
                if(res.status==200)
                {
                    $("#technologyDelectModal").modal('hide');
                    showAllTechnology();
                }
            })
            .catch(function(error){
                console.log(error.response);
            })
        })
        $("#sideNav_technologyBtn").click(function(){
            $("#admin_project").addClass("d-none");
            $("#admin_contact").addClass("d-none");
            $("#admin_team").addClass("d-none");
            $("#admin_role").addClass("d-none");
            $("#admin_gallery").addClass("d-none")
            $("#admin_other").addClass("d-none");
            $("#admin_site_home_page").addClass("d-none");
            $("#admin_post").addClass("d-none");
            $("#admin_technology").removeClass("d-none");
            showAllTechnology();
            $("#addTechnologyBtn").click(function(){
                $("#addTechnologyDiv").removeClass("d-none");

                $("#technology_name").change(function(){
                    let technology = $(this).val();
                    $("#addTechnologyConfirmBtn").click(function(){
                        if(technology.length<=2 || technology.length>=80)
                        {
                            $("#technology_error").removeClass("d-none");
                        }
                        else{
                            axios.post('admin/addTechnology',{
                                technology_name:technology
                            }).then(function(res){
                                if(res.status==201||res.status==200)
                                {
                                    $("#technology_name").val("");
                                    $("#technology_error").addClass("d-none");
                                    $("#addTechnologyDiv").addClass("d-none");
                                    showAllTechnology();
                                }
                            })
                            .catch(function(error){
                                console.log(error.response);
                            })
                        }
                    });
            });



            })
            $("#addTechnologyBtn").dblclick(function(){
                $("#addTechnologyDiv").addClass("d-none");
            });
            $("#addTechnologyCancelBtn").click(function(){
                $("#addTechnologyDiv").addClass("d-none");
            })
            

        })


        function adminGetAllProjects()
        {
            axios.get('/admin/getAllProject')
                .then(function(res){
                   let projects = res.data;
                   $("#projectTable").empty();
                   $.each(projects,function(idx,item){
                        let styled = '';
                        if(item.confirm==0) styled = 'style=color:red;';
                        else styled = 'style=color:green;';
                        $('<tr></tr>').html(
                            '<td>'+item.name+'</td>'+
                            '<td><img src="'+item.image+'"/></td>'+
                            '<td><a target="_blank" href="'+item.url+'"><i class="fas fa-eye"></i></a></td>'+
                            '<td><a class="projectConfirmChangeBtn" '+styled+' data-confirm="'+item.confirm+'" data-id="'+item.id+'"><i class="far fa-check-circle"></i></a></td>'+
                            '<td><a class="projectDeleteBtn" data-id="'+item.id+'"><i class="fas fa-trash"></i></a></td>'
                        ).appendTo("#projectTable");
                   });
                   $(".projectConfirmChangeBtn").click(function(){
                        $("#selectProjectConfirmChange").val($(this).data('confirm'));
                        $("#project_id").val($(this).data('id'));
                        // console.log($("#project_user_id").val());
                        $("#projectConfirmChangeModal").modal('show');
                   })
                   $(".projectDeleteBtn").click(function(){
                        let project_id = $(this).data('id');
                        $("#projectDelectModal").modal('show');
                        $("#projectDeleteConfirmBtn").val(project_id);
                   });
                   
                })
                .catch(function(error){
                    console.log(error.response);
                })
        }
        let  projectConfirmValue=-1;
        $("#selectProjectConfirmChange").change(function(){
            projectConfirmValue = $(this).val();
        });
        $("#selectProjectConfirmChange_saveBtn").click(function(){
            if(projectConfirmValue>=0){
                let project_id = $("#project_id").val();
                axios.post('admin/projectConfirm',{
                    projectId : project_id,
                    confirmValue : projectConfirmValue
                })
                .then(function(res){
                    if(res.status==200||res.status==201)
                    {
                        $("#projectConfirmChangeModal").modal('hide');
                        alert("update Success");
                        adminGetAllProjects();
                    }
                })
                .catch(function(error){
                    console.log(error.response);
                });
            }
        });

        $("#projectDeleteConfirmBtn").click(function(){
            let project_id = $(this).val();
            axios.post('/admin/projectDelete',{
                id:project_id
            })
            .then(function(res){
                if(res.status==200)
                {
                    $("#projectDelectModal").modal('hide');
                    alert("delete Success");
                    adminGetAllProjects();
                }
            })
            .catch(function(error){
                console.log(error.response);
            })
        })

        /* ADMIN PROJECT PROTION */
        $("#sideNav_projectBtn").click(function(){
            $("#admin_technology").addClass("d-none");
            $("#admin_contact").addClass("d-none");
            $("#admin_team").addClass("d-none");
            $("#admin_role").addClass("d-none");
            $("#admin_gallery").addClass("d-none")
            $("#admin_other").addClass("d-none");
            $("#admin_site_home_page").addClass("d-none");
            $("#admin_post").addClass("d-none");
            $("#admin_project").removeClass("d-none");

            adminGetAllProjects();
        })





        function getAllUsersProfile()
        {
            axios.get('/admin/usersProfile')
                .then(function(res){
                    console.log(res.data);
                    if(res.status==200)
                    {
                        $("#team_member_table").empty();
                        let users = res.data;
                        $.each(users,function(idx,user){
                            let social_link = JSON.parse(user.social_link);
                            let confirm = user.confirm==0?"text-danger" : "text-success";
                            $('<tr>').html(
                                '<td><img src="'+user.image+'" alt="'+user.name+'"/></td>'+
                                '<td>'+user.name+'</td>'+
                                '<td style="cursor:pointer;" class="userProfilePriorityBtn" data-id="'+user.id+'">'+user.priority_serial+'</td>'+
                                '<td><a style="cursor:pointer;" class="userProfileDetailsBtn " data-id="'+user.id+'"><i class="fas fa-eye"></i><a/></td>'+
                                '<td><a style="cursor:pointer;" data-confirm="'+user.confirm+'" class="userProfileConfirmBtn '+confirm+'" data-id="'+user.id+'"><i class="fas fa-check-circle"></i></a></td>'
                            ).appendTo("#team_member_table");
                        });
                        $(".userProfileConfirmBtn").click(function(){
                            let profile_id = $(this).data('id');
                            let confirm_value = $(this).data('confirm');
                            // console.log(profile_id);
                            // $("#profileUpdateConfirmModal").modal('show');
                            axios.post('admin/teamMemberConfirm',{id:profile_id,value:confirm_value})
                                .then(function(res){
                                    getAllUsersProfile();
                                }).catch(function(error){
                                    console.log(error.response);
                                })
                            // console.log(profile_id)
                        });
                        $(".userProfileDetailsBtn").click(function(){
                            let profile_id = $(this).data('id');
                            axios.post('admin/profileDetails',{id:profile_id})
                                .then(function(res){
                                    console.log(res.data);
                                    $("#userProfileDetailsModal").modal('show');
                                    let user = res.data;
                                    let social_link = JSON.parse(user.social_link);
                                    $("#profile_social_link").empty();
                                    $('<li>').html(
                                        '<a target="_blank" href="'+social_link.facebook+'">Facebook</a>'
                                    ).appendTo("#profile_social_link");
                                    $('<li>').html(
                                        '<a target="_blank" href="'+social_link.linkedin+'">LinkedIn</a>'
                                    ).appendTo("#profile_social_link");
                                    $('<li>').html(
                                        '<a target="_blank" href="'+social_link.github+'">Github</a>'
                                    ).appendTo("#profile_social_link");
                                    $("#profile_description").text(user.description);
                                })
                                .catch(function(error){
                                    console.log(error.response);
                                })
                        })
                    }
                })  
                .catch(function(error){
                    console.log(error.response);
                })
        }


        /* ADMIN TEAM MEMBERS */
        $("#sideNav_teamBtn").click(function(){
            $("#admin_technology").addClass("d-none");
            $("#admin_project").addClass("d-none");
            $("#admin_contact").addClass("d-none");
            $("#admin_role").addClass("d-none");
            $("#admin_gallery").addClass("d-none")
            $("#admin_other").addClass("d-none");
            $("#admin_site_home_page").addClass("d-none");
            $("#admin_post").addClass("d-none");
            $("#admin_team").removeClass("d-none");

            getAllUsersProfile();








        })
















        // <li><a id="sideNav_contactBtn">contact message</a></li>
        /* GALLERY IMAGE */
        $("#sideNav_galleryBtn").click(function(){
            $("#admin_technology").addClass("d-none");
            $("#admin_project").addClass("d-none");
            $("#admin_team").addClass("d-none");
            $("#admin_role").addClass("d-none");
            $("#admin_contact").addClass("d-none");
            $("#admin_other").addClass("d-none");
            $("#admin_site_home_page").addClass("d-none");
            $("#admin_post").addClass("d-none");
            $("#admin_gallery").removeClass("d-none")
            showGalleryImage();
        })

        function showGalleryImage()
        {
            axios.get('/admin/getTopEightImageUlr')
                .then((res)=>{
                    let imageUrl = res.data;
                    $("#galleryImage").empty();
                    $.each(imageUrl,(idx,item)=>{
                        $('<div class="galleryImgDiv col-md-3 col-sm-6">').html(
                            '<img class="galleryImgTag" src="'+imageUrl[idx].url+'" alt="gallery image" data-id="'+ imageUrl[idx].id +'"/>'
                        ).appendTo("#galleryImage");
                    });
                    
                    let lastImageId = $(".galleryImgDiv:last img").data('id');
                    $("#imageLoadMoreBtn").val(lastImageId);
                    // $("#imageLoadMoreBtn").attr("data-id",lastImageId);
                }).catch((error)=>{
                    console.log(error.response);
                });
        }
        
        $("#imageLoadMoreBtn").click(function(){
            let imageId = $(this).val();
            loadMoreImage(imageId);
        })
        function loadMoreImage(imageId){
            axios.post('/admin/loadMoreGalleryImage',{id:imageId})
                .then((res)=>{
                    console.log(res.data);
                    let imageUrl = res.data;

                    $.each(imageUrl,(idx,item)=>{
                        $('<div class="galleryImgDiv col-md-3 col-sm-6">').html(
                            '<img class="galleryImgTag" src="'+imageUrl[idx].url+'" alt="gallery image" data-id="'+ imageUrl[idx].id +'"/>'
                        ).appendTo("#galleryImage");
                    });
                    
                    let lastImageId = $(".galleryImgDiv:last img").data('id');
                    $("#imageLoadMoreBtn").val(lastImageId);
                })
                .catch((error)=>{
                    console.log(error.response);
                })
        }

        $("#addNewImageBtn").click(function(){
            $("#addNewImageModal").modal('show');
        });

        $("#inputImageFile").change(function(){
            let fileReader = new FileReader();
            fileReader.readAsDataURL(this.files[0]);
            $("#imgPreview").removeClass("d-none");
            fileReader.onload = (event) =>{
                let imgUrl = event.target.result;
                $("#previewImgTagId").attr('src',imgUrl);
            }

            $("#addNewImageConfirmBtn").click(function(){
                let formData = new FormData();
                let imgFile = $("#inputImageFile").prop('files')[0];
                formData.append('image',imgFile);
                axios.post('/admin/uploadImageFile',formData)
                    .then((res)=>{
                        console.log(res);
                    })
                    .catch((error)=>{
                        console.log(error.response);
                    })

                // console.log("adds ok")
                // console.log(imgFile);
            });
        })

        




        /* ADMIN CONTACT PORTION */
        $("#sideNav_contactBtn").click(function(){
            $("#admin_technology").addClass("d-none");
            $("#admin_project").addClass("d-none");
            $("#admin_team").addClass("d-none");
            $("#admin_role").addClass("d-none");
            $("#admin_gallery").addClass("d-none")
            $("#admin_other").addClass("d-none");
            $("#admin_site_home_page").addClass("d-none");
            $("#admin_post").addClass("d-none");
            $("#admin_contact").removeClass("d-none");
            
                // $('#contactDataTable').DataTable();
            adminShowContact();
            
        })
        function adminShowContact()
        {
            axios.get('/admin/getContactAll')
            .then(response => {
                if(response.status==200){
                    $("#contactDataTableBody").empty();
                    let contactData = response.data;
                    // console.log(contactData);
                    $.each(contactData,function(idx,item){
                        $('<tr>').html(
                            '<td>'+ contactData[idx].name +'</td>'+
                            '<td>'+ contactData[idx].email +'</td>'+
                            '<td>'+ contactData[idx].subject+'</td>'+
                            '<td class="text-center"><a style="cursor:pointer;" class="contactMessageDetailsBtn" data-id='+ contactData[idx].id +'><i class="fas fa-envelope"></i></a></td>'+
                            '<td class="text-center"><a style="cursor:pointer;" class="contactMessageDeleteBtn" data-id='+ contactData[idx].id +'><i class="far fa-trash-alt"></i></a></td>'
                        ).appendTo("#contactDataTableBody");
                    });
                    $(".contactMessageDeleteBtn").click(function(){
                        let contactId = $(this).data('id');
                        $("#contactDeleteModal").modal('show');

                        $("#ContactDeleteConfirmBtn").click(function(){
                            axios.post('/admin/contactDelete',{id:contactId})
                                .then(res=>{
                                    if(res.data==1){
                                        $("#contactDeleteModal").modal('hide');
                                        adminShowContact();
                                        alert("Delete Success");
                                    }
                                })
                                .catch(error=>{
                                    alert("something went to wrong");
                                })
                        })
                    })
                    $(".contactMessageDetailsBtn").click(function(){
                        let contactId = $(this).data('id');
                        console
                        axios.get('/admin/getMessage/'+contactId,)
                        .then(res=>{
                            console.log(res.data);
                            $("#contactDataMessage").html(res.data.message);
                            $("#contactMessageModal").modal('show');
                        })
                        .catch(error=>{
                            console.log(error.response);
                        })
                    });
                }
            })
            .catch(error => {
                console.log(error.response);
                alert("something went to wrong");
            });
        }


        /* Other Portions like category and tags */


        function getCategoryShow()
        {
            axios.get('/admin/showCategory')
                .then(function(res){
                    if(res.status==200)
                    {
                        // $("#categoryTableBody").empty();
                        $("#categoryTableBody").empty();

                        let categories = res.data;

                        $.each(categories,function(idx,item){
                            $('<tr>').html(
                                '<td>'+categories[idx].name+'</td>'+
                                '<td><a style="cursor:pointer;" class="categoryUpdateBtn" data-name="'+ categories[idx].name +'" data-id="'+ categories[idx].id +'"><i class="fas fa-edit"></i></a></td>'+
                                '<td><a style="cursor:pointer;" class="categoryDeleteBtn" data-id="'+ categories[idx].id +'"><i class="far fa-trash-alt"></i></a></td>'
                            ).appendTo("#categoryTableBody");
                        });
                        $(".categoryDeleteBtn").click(function(){
                            let id = $(this).data('id');
                            $("#deleteCategoryId").val(id);
                            $("#deleteCategoryModalShow").modal('show');
                        })
                        $(".categoryUpdateBtn").click(function(){
                            let id = $(this).data('id');
                            $("#updateCategoryId").attr('data-id',id);
                            $("#updateCategoryId").val($(this).data('name'));
                            $("#updateCategoryModalShow").modal('show');
                        })
                    }
                }).catch(function(error){
                    console.log("something went to wrong");
                })
        }
        $("#deleteCategoryConfirmBtn").click(function(){
            deleteCategory($("#deleteCategoryId").val());
        });
        function deleteCategory(catId)
        {
            axios.post('/admin/deleteCategory',{id:catId})
                .then(function(res){
                    if(res.status==200){
                        alert("Delete Success");
                        $("#deleteCategoryModalShow").modal('hide');
                        getCategoryShow();
                    }
                })
                .catch(function(error){
                    console.log(error.response);
                })   
        }
        $("#updateCategoryId").change(function(){
            $("#updateCategoryConfirmBtn").click(function(){
                updateCategory($("#updateCategoryId").val(),$("#updateCategoryId").data('id'));
            });
        })
        function updateCategory(catName,catId)
        {
            axios.post('/admin/updateCategory',{id:catId,name:catName})
                .then(function(res){
                    if(res.status==200){
                        alert("update Success");
                        $("#updateCategoryModalShow").modal('hide');
                        getCategoryShow();
                    }
                })
                .catch(function(error){
                    console.log(error.response);
                })   
        }

        function addCategory(category)
        {
            axios.post('admin/addCategory',{name:category})
                    .then(function(res){
                        if(res.status==201)
                        {
                            $("#categoryInputValue").val("");
                            $("#addCategoryInputDiv").addClass("d-none");
                            alert("Add Success");
                            getCategoryShow();
                        }
                    }).catch(function(error){
                        // console.log(error.response);
                        alert("Something went to wrong");
                    })
        }

        function getTagShow()
        {
            axios.get('/admin/showTag')
                .then(function(res){
                    $("#tagListShow").empty();
                    if(res.status==200)
                    {
                        let tags = res.data;
                        $.each(tags,function(idx,item){
                            $('<span class="tag-item" data-id="'+ item.id +'">').text(
                                item.name
                            ).appendTo("#tagListShow");
                        })
                    }
                })
                .catch(function(error){
                    alert("something went to wrong");
                })
        }

        $("#sideNav_otherBtn").click(function(){
            $("#admin_technology").addClass("d-none");
            $("#admin_project").addClass("d-none");
            $("#admin_contact").addClass("d-none");
            $("#admin_team").addClass("d-none");
            $("#admin_gallery").addClass("d-none");
            $("#admin_role").addClass("d-none");
            $("#admin_site_home_page").addClass("d-none");
            $("#admin_post").addClass("d-none");
            $("#admin_other").removeClass("d-none");

            /* Category portion */
            getCategoryShow();

            $("#addCategoryBtn").click(function(){
                $("#addCategoryInputDiv").removeClass("d-none");
            });
            $("#addCategoryCancelBtn").click(function(){
                $("#categoryInputValue").val("");
                $("#addCategoryInputDiv").addClass("d-none");
            });
            
            $("#addCategoryConfirmBtn").click(function(){
                let category = $("#categoryInputValue").val();
                axios.post('admin/checkCategory',{name:category})
                    .then(function(res){
                            // console.log(res.data);
                        if(res.data >= 1)
                        {
                            alert("Name Already Exists");
                        }
                        else{
                            addCategory(category);
                        }
                    })
                    .catch(function(error){
                        console.log(error.response);
                    });
            });

            /* Tag Portion */
           
            getTagShow();
            $("#addTagBtn").click(function(){
                $("#addTagInputDiv").removeClass("d-none")
            });

            $("#addTagCancelBtn").click(function(){
                $("#addTagInputDiv").addClass("d-none");
            });



            $("#addTagConfirmBtn").click(function(){
                let tagName = $("#TagInputValue").val().trim();
                if(tagName.length>0){
                    axios.post('admin/addTag',{name:tagName.toLowerCase()})
                        .then(function(res){
                            // console.log(res);
                            if(res.status==201||res.status==200)
                            {
                                alert("Tag Add Success");
                                $("#TagInputValue").val("")
                                getTagShow();
                            }
                        }).catch(function(error){
                            alert("Something went to be wrong");
                        });
                }
                else{
                    alert("Empty Field");
                }
            });

        });



        function get_site_home_page_data()
        {
            axios.get('/admin/getHomPage')
                .then(function(res){
                    if(res.status==200||res.status==201)
                    {
                        let data=res.data;
                        $("#home_page_image_preview").attr('src',data[0].image);
                        $("#home_name").val(data[0].name);
                        $("#home_work").val(data[0].work_position);
                        $("#home_desc").val(data[0].short_description);
                        $("#footer_short_desc").val(data[0].footer);
                        $("#google_map_locaction_url").val(data[0].map_link);
                    }
                }).catch(function(error){
                    console.log(error.response);
                });
        }

        $("#sideNav_databaseBtn").click(function(){
            $("#admin_technology").addClass("d-none");
            $("#admin_project").addClass("d-none");
            $("#admin_contact").addClass("d-none");
            $("#admin_team").addClass("d-none");
            $("#admin_gallery").addClass("d-none");
            $("#admin_role").addClass("d-none");
            $("#admin_other").addClass("d-none");
            $("#admin_post").addClass("d-none");
            $("#admin_site_home_page").removeClass("d-none");

            get_site_home_page_data();

            $("#home_page_img").change(function(){
                let profileImgFile = $(this).prop('files')[0];
                let current_image_url =  $("#home_page_image_preview").attr('src');
                // console.log("current image : "+current_image_url);
                if(profileImgFile.size <= 1024 * 1000)
                {
                    let fileReader = new FileReader();
                    fileReader.readAsDataURL(this.files[0]);
                    fileReader.onload = (event) =>{
                        let imgUrl = event.target.result;
                        $("#home_page_image_preview").attr('src',imgUrl);
                    }

                    $("#update_home_image_btn").click(function(){
                        let formData = new FormData();
                        let imgFile = profileImgFile;;
                        formData.append('update_image',imgFile);
                        formData.append('current_image_url',current_image_url);
                        axios.post('/admin/home-page-imageUpdate',formData)
                            .then((res)=>{
                                if(res.status==200)
                                {
                                    // getUserProfile();
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

            $("#home_page_create").click(function(){
                let my_name = $("#home_name").val();
                let my_work_position = $("#home_work").val();
                let my_short_desc = $("#home_desc").val();
                let my_footer_desc = $("#footer_short_desc").val();
                let my_location_url = $("#google_map_locaction_url").val();
                axios.post('/admin/home-page-create',{
                    name:my_name,
                    work_position:my_work_position,
                    short_desc:my_short_desc,
                    footer_desc:my_footer_desc,
                    location:my_location_url
                })
                .then(function(res){
                    if(res.status==200||res.status==201)
                    {
                        get_site_home_page_data();
                    }
                })
                .catch(function(error){
                    console.log(error.response);
                })
            })
            $("#home_page_update").click(function(){
                let my_name = $("#home_name").val();
                let my_work_position = $("#home_work").val();
                let my_short_desc = $("#home_desc").val();
                let my_footer_desc = $("#footer_short_desc").val();
                let my_location_url = $("#google_map_locaction_url").val();
                axios.post('/admin/home-page-update',{
                    name:my_name,
                    work_position:my_work_position,
                    short_desc:my_short_desc,
                    footer_desc:my_footer_desc,
                    location:my_location_url
                })
                .then(function(res){
                    if(res.status==200||res.status==201)
                    {
                        get_site_home_page_data();
                    }
                })
                .catch(function(error){
                    console.log(error.response);
                })
            })

        })


    </script>
@endsection