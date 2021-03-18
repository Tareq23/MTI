@extends('layout.app')


@section('content')

    @include('component.admin.topNav')
    <div class="admin-wrapper">
        <div id="sideNav" class="d-none">
            @include('component.admin.sideNav')
        </div>
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
            @include('component.admin.contact')
        </div>
        <div id="admin_team" class="d-none">
            <h2>Admin Team members</h2>
        </div>
        <div id="admin_gallery" class="d-none">
            @include('component.admin.gallery')
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
            $("#admin_gallery").addClass("d-none")
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
        $("#sideNav_technologyBtn").click(function(){
            $("#admin_project").addClass("d-none");
            $("#admin_contact").addClass("d-none");
            $("#admin_team").addClass("d-none");
            $("#admin_role").addClass("d-none");
            $("#admin_gallery").addClass("d-none")
            $("#admin_technology").removeClass("d-none");
        })
        /* ADMIN PROJECT PROTION */
        $("#sideNav_projectBtn").click(function(){
            $("#admin_technology").addClass("d-none");
            $("#admin_contact").addClass("d-none");
            $("#admin_team").addClass("d-none");
            $("#admin_role").addClass("d-none");
            $("#admin_gallery").addClass("d-none")
            $("#admin_project").removeClass("d-none");
        })
        /* ADMIN TEAM MEMBERS */
        $("#sideNav_teamBtn").click(function(){
            $("#admin_technology").addClass("d-none");
            $("#admin_project").addClass("d-none");
            $("#admin_contact").addClass("d-none");
            $("#admin_role").addClass("d-none");
            $("#admin_gallery").addClass("d-none")
            $("#admin_team").removeClass("d-none");
        })
        // <li><a id="sideNav_contactBtn">contact message</a></li>
        /* GALLERY IMAGE */
        $("#sideNav_galleryBtn").click(function(){
            $("#admin_technology").addClass("d-none");
            $("#admin_project").addClass("d-none");
            $("#admin_team").addClass("d-none");
            $("#admin_role").addClass("d-none");
            $("#admin_contact").addClass("d-none");
            $("#admin_gallery").removeClass("d-none")
            showGalleryImage();
        })

        function showGalleryImage()
        {
            axios.get('/admin/getTopEightImageUlr')
                .then((res)=>{
                    let imageUrl = res.data;

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
    </script>
@endsection