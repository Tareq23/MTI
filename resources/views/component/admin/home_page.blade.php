<div class="container pl-5">

    <div class="row">
        <div class="col-md-6">
            <div class="home-page-image">
                <div class="img-preview" style="width:320px;">
                    <img id="home_page_image_preview" style="width:100%;" src="" alt="home page image"/>
                </div>
                <div class="form-group">
                    <label for="home_page_img">Home Page Image</label>
                    <input type="file" id="home_page_img" class="form-control">
                </div>
                <button class="btn btn-primary" type="button" id="update_home_image_btn">Upage Image</button>
            </div>
        </div>
        <div class="col-md-6 ">
            <div class="home-name form-group">
                <label for="home_name">Name</label>
                <input  type="text" id="home_name" class="form-control" placeholder="my name"/>
            </div>
            <div class="work-position form-group">
                <label for="home_work">Work Position</label>
                <input type="text" class="form-control" id="home_work" placeholder="work position"/>
            </div>
        </div>
    </div>
    <div class="row mt-5">
        <div class="col-12">
            <div class="home_short_desc form-group">
                <label>Home short description</label>
                <textarea class="form-control" id="home_desc"></textarea>
            </div>
            <div class="footer_desc form-group">
                <label for="footer_short_desc">Footer Short Desc</label>
                <textarea class="form-control" type="text" id="footer_short_desc"></textarea>
            </div>
            <div class="map-location form-group">
                <label for="google_map_locaction_url">Google Map Embeded Link</label>
                <input class="form-control" type="text" id="google_map_locaction_url"/>
            </div>
        </div>
    </div>
    <button id="home_page_create" class="btn btn-primary btn-block">Home Page Data Create</button>
    <button id="home_page_update" class="btn btn-primary btn-block">Home Page Data Update</button>
</div>