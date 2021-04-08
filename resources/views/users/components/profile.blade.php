<div id="user_profile_show" class="d-none ml-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="profile row">
                    <div class="col-md-6 profile-img">
                        <img class="card-img" src="{{asset('images/default/user.png')}}" id="user_profile_image" />
                        <p id="profile_image_error" class="d-none" style="color:red;">Image size less than 1MB<p>
                        <input type="file" id="update_profile_image" name="profile_image" accept=".png,.jpg,.gif" /></br>
                        <button class="btn btn-primary mt-1" type="button" id="update_profile_image_btn">Change</button>
                    </div>
                    <div class="col-md-6 short-info">
                        <p><input type="text" id="user_name"/></p>
                        <p>Educations : <i id="addEducation" style="cursor:pointer;" class="fas fa-plus-square"></i></p>
                        <div id="educationAppend">
                        
                        </div>
                        <button class="btn btn-primary" id="update_education_info_btn" type="button">Update Education</button>
                        <p>Email : <span id="user_email"></span></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 social-media mt-3">
                        <div class="d-flex my-2">
                            <label for="facebook">facebook</label>
                            <input type="text" id="user_facebook" class="form-control" placeholder="social link url"/>
                        </div>
                        <div class="d-flex my-2">
                            <label for="linkedin">linkedin</label>
                            <input type="text" id="user_linkedin" class="form-control" placeholder="social link url"/>
                        </div>
                        <div class="d-flex my-2">
                            <label for="github">github</label>
                            <input type="text" id="user_github" class="form-control" placeholder="social link url"/>
                        </div>
                        <button class="btn btn-primary" id="update_social_link_btn" type="button">Update Links</button>    
                    </div>
                    <div class="col-md-6 short-description">
                        <p class="subTitle">short description</p>
                        <textarea id="user_short_desc" style="width:100%;min-height:250px;"></textarea>
                        <button class="btn btn-primary" type="button" id="update_short_desc_btn">Update Desc</button>
                    </div>
                    <!-- <button  class="btn btn-primary btn-block" id="profileUpdateConfirmBtn">Update</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

