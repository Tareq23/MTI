<div class="container ml-5">
    <button id="addNewImageBtn" class="btn btn-primary">Add New Image</button>
    <div class="row">
        <div class="col-sm-12">
            <div id="galleryImage" class="row">

            </div>
        </div>
        <button class="btn btn-primary btn-block m-2" id="imageLoadMoreBtn">Load More</button>
    </div>
</div>



<!-- ADD NEW IMAGE MODAL -->


<div class="modal fade" id="addNewImageModal" class="" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalCenterTitle">Add New Image</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <input class="form-control"  type="file" accept="image/*" id="inputImageFile"/>
            <div id="imgPreview" class="d-none p-3">
                <img id="previewImgTagId" class="img-fluid" src="" alt="preview Img" />
            </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button id="addNewImageConfirmBtn" type="button" class="btn btn-primary">Add</button>
      </div>
    </div>
  </div>
</div>