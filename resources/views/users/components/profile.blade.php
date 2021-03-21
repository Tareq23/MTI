<div id="user_profile_show" class="d-none ml-5">
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div class="profile row">
                    <div class="col-md-6 profile-img">
                        <img class="card-img" src="{{asset('images/project.jpg')}}"/>
                    </div>
                    <div class="col-md-6 short-info">
                        <p>Name : Dummy Name</p>
                        <p>Education : json data 3 property <i id="addEducation" style="cursor:pointer;" class="fas fa-plus-square"></i></p>
                        <div id="educationAppend">
                        
                        <button id="educationAddBtn" class="btn btn-primary">Education Btn</button>
                        </div>
                        <p>Email : mail@example.com</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 social-media mt-3">
                        <div class="d-flex my-2">
                            <label for="facebook">facebook</label>
                            <input type="text" id="facebook" class="form-control" placeholder="social link url"/>
                        </div>
                        <div class="d-flex my-2">
                            <label for="linkedin">linkedin</label>
                            <input type="text" id="linkedin" class="form-control" placeholder="social link url"/>
                        </div>
                        <div class="d-flex my-2">
                            <label for="github">github</label>
                            <input type="text" id="github" class="form-control" placeholder="social link url"/>
                        </div>    
                    </div>
                    <div class="col-md-6 short-description">
                        <p class="subTitle">short description</p>
                        <textarea id="shortDescUpdate" style="width:100%;min-height:250px;"></textarea>
                    </div>
                    <button class="btn btn-primary btn-block" id="profileUpdateConfirmBtn">Update</button>
                </div>
            </div>
        </div>
    </div>
</div>