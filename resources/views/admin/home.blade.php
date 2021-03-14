@extends('layout.app')


@section('content')

    @include('component.admin.topNav')
    <div class="admin-wrapper">
        @include('component.admin.sideNav')
        <div  id="admin_role" class="d-none">
            @include('component.admin.userRole')
        </div>
        <div id="admin_project" class="d-none">
            <h2>Admin project</h2>
        </div>
        <div id="admin_technology" class="d-none">
            <h2>Admin Technology</h2>
        </div>
        <div id="admin_contact" class="d-none">
            <h2>Admin contact message</h2>
        </div>
        <div id="admin_team" class="d-none">
            <h2>Admin Team members</h2>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
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
        /* ADMIN ROLE SET FOR TEAM MEMBERS OR BLOGGERS */
        $("#sideNav_roleBtn").click(function(){
            $("#admin_technology").addClass("d-none");
            $("#admin_project").addClass("d-none");
            $("#admin_contact").addClass("d-none");
            $("#admin_team").addClass("d-none");
            $("#admin_role").removeClass("d-none");

            $(document).ready(function() {
                axios.get('/admin/getAllVerifiedUser').then(function(response){
                    if(response.status==200){
                        let userData = response.data;
                        let roles='';
                        $('#userRoleTableBody').empty();
                        $.each(userData,function(idx,item){
                            
                            axios.post('/admin/getRole',{id:userData[idx].id}).then(function(response){
                                let roleData = response.data;

                                $.each(roleData,function(idx2,item2){
                                     roles +=  roleData[idx2].name + ','
                                });
                                
                                roles = roles.substring(0,roles.length-1);
                                
                                $(".user-role").html(roles);
                                roles = '';

                            }).catch(function(error){
                                console.log(error.response);
                            });
                            // console.log("scope outside : "+ $("#role-html-id").val())
                            
                            $('<tr>').html(
                                '<td>'+userData[idx].email+'</td>'+
                                '<td class="user-role"> </td>' + 
                                '<td><a class="roleEditBtn" data-id='+ userData[idx].id +'><i class="fas fa-edit"></i></a></td>'
                            ).appendTo("#userRoleTableBody");
                            $(".roleEditBtn").click(function(){
                                let userId = $(this).data('id');
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
            axios.post('/admin/getRole',{id:userId}).then(function(response){
                if(response.status==200){
                    let userRole;
                    userRole = response.data;
                    let roleCheckValue = '';
                    axios.get('/admin/allRoles')
                        .then(function(response){
                            if(response.status==200)
                            {
                                let roles = response.data;
                                $("#updateRoleModalShowRole").empty();
                                $.each(roles,function(idx,item){
                                    $('<div class="roleCheckBox">').html(
                                        '<label ><input type="checkbox" class="roleCheckItem" value='+ roles[idx].id +'/>'+roles[idx].name+'</label>'
                                    ).appendTo('#updateRoleModalShowRole');

                                });
                                // $(document).ready(function(){
                                //     $(".roleCheckItem").click(function(){
                                //         roleCheckValue='';
                                //        $(".roleCheckItem:checked").each(function(){
                                //            roleCheckValue += $(this).val() + ',';
                                //        })
                                //     })
                                // })
                                $("#updateRoleConfirmBtn").click(function(){
                                    $(".roleCheckItem:checked").each(function(){
                                           roleCheckValue += $(this).val() + ',';
                                       })
                                    console.log(roleCheckValue);
                                    // $(".roleCheckItem").prop('checked',this.checked);
                                    // console.log($('input[type="checkbox"]').prop('checked'));
                                    // console.log($('.role').val())
                                    
                                })
                            }
                        }).catch(function(error){
                            console.log(error.response);
                        })
                }
            }).catch(function(error){
                console.log(error.response);
            })
            $("#updateUserRoleModal").modal('show');
        }
        /* ADMIN TECHNOLOGY PORTION */
        $("#sideNav_technologyBtn").click(function(){
            $("#admin_project").addClass("d-none");
            $("#admin_contact").addClass("d-none");
            $("#admin_team").addClass("d-none");
            $("#admin_role").addClass("d-none");
            $("#admin_technology").removeClass("d-none");
        })
        /* ADMIN PROJECT PROTION */
        $("#sideNav_projectBtn").click(function(){
            $("#admin_technology").addClass("d-none");
            $("#admin_contact").addClass("d-none");
            $("#admin_team").addClass("d-none");
            $("#admin_role").addClass("d-none");
            $("#admin_project").removeClass("d-none");
        })
        /* ADMIN TEAM MEMBERS */
        $("#sideNav_teamBtn").click(function(){
            $("#admin_technology").addClass("d-none");
            $("#admin_project").addClass("d-none");
            $("#admin_contact").addClass("d-none");
            $("#admin_role").addClass("d-none");
            $("#admin_team").removeClass("d-none");
        })
        /* ADMIN CONTACT PORTION */
        $("#sideNav_contactBtn").click(function(){
            $("#admin_technology").addClass("d-none");
            $("#admin_project").addClass("d-none");
            $("#admin_team").addClass("d-none");
            $("#admin_role").addClass("d-none");
            $("#admin_contact").removeClass("d-none");
        })
    </script>
@endsection