<div id="user_post_show" class="d-none ml-5">
    <div class="container">
        <button class="btn btn-primary d-block" id="addNewPostBtn">Add New Post</button>
        <div class="row">
            <div class="col-sm-12 w-100">
              <div id="create_post"  class="w-100 d-none">
                <div class="editor-icon-list">
                  <select onchange="executeCommandWithArg('formatBlock',this.value)">
                    <!-- <option value="h1">H1</option> -->
                    <option value="h2">H2</option>
                    <option value="h3">H3</option>
                    <option value="h4">H4</option>
                    <option value="h5">H5</option>
                    <option value="h6">H6</option>
                  </select>
                  <button type="button" onclick="executeCommand('bold');" ><i class="fas fa-bold"></i></button>
                  <button type="button" onclick="executeCommand('insertParagraph');" ><i class="fas fa-paragraph"></i></button>
                  <button type="button" onclick="executeCommand('justifyLeft');" ><i class="fas fa-align-left"></i></button>
                  <button type="button" onclick="executeCommand('justifyRight');" ><i class="fas fa-align-right"></i></button>
                  <button type="button" onclick="executeCommand('justifyCenter');" ><i class="fas fa-align-center"></i></button>
                  <button type="button" onclick="executeCommand('justifyFull');" ><i class="fas fa-align-justify"></i></button>
                  <button type="button" onclick="executeCommand('indent');" ><i class="fas fa-indent"></i></button>
                  <button type="button" onclick="executeCommand('outdent');" ><i class="fas fa-outdent"></i></button>
                  <button type="button" onclick="executeCommand('redo');" ><i class="fas fa-redo"></i></button>
                  <button type="button" onclick="executeCommand('undo');" ><i class="fas fa-undo"></i></button>
                  <button type="button" onclick="executeCommand('underline');" ><i class="fas fa-underline"></i></button>
                  <button type="button" onclick="executeCommandWithArg('createLink',prompt('Enter Link Url: ','https:'));" ><i class="fas fa-link"></i></button>
                  <button type="button" onclick="executeCommand('unlink');" ><i class="fas fa-unlink"></i></button>
                  <!-- <button type="button" onclick="executeCommandWithArg('insertImage',prompt('Enter Image Url: ','https:'));" ><i class="far fa-file-image"></i></button> -->
                  <button type="button" onclick="toggleCode();" ><i class="fas fa-code"></i></button>
                </div>

                <div class="form-group">
                  <label for="postMainTitle">Post Main Title</label>
                  <input id="postMainTitle" type="text" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="postMainImage">Select Image url from third party website</label>
                    <input id="postMainImage" type="url" class="form-control"/>
                </div>
                <select class="form-control m-0 p-0 mb-2" id="categories">
                  <option value="0" selected>Select Category</option>
                  <!-- <option value="1">1</option>
                  <option value="1" selected>2</option>
                  <option value="1">3</option>
                  <option value="1">4</option> -->
                </select> 
                <iframe id="outputPost" name="postTextField"></iframe>
                <button type="button" class="btn btn-primary" id="postConfirmSubmitBtn">Submit</button>
              </div>
            </div>
            <div class="col-sm-12">
              <div id="post-show-div">
                <div class="single-post mt-3">

                  <!-- <div class="post-title">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quia, voluptatem.</p>
                  </div>
                  <div class="post-content">
                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Veritatis, doloribus magni ducimus commodi est beatae maiores ad suscipit provident quam cumque deserunt omnis voluptas dolores fugiat qui tempore officiis magnam.</p>
                  </div> -->

                </div>
              </div>
            </div>
        </div>
    </div>
</div>


<!-- Add New Post Modal -->


<div class="modal fade " id="addNewPostModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <textarea class="form-control" id="post-editor" name="post-editor"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" id="postSubmitConfirmBtn" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>

<script>
  
postTextField.document.designMode = 'on';

function executeCommand(command){
  postTextField.document.execCommand(command,false,null);
}
function executeCommandWithArg(command,value)
{
  postTextField.document.execCommand(command,false,value);
  if(command === "createLink"){
    let links = postTextField.document.querySelectorAll('a');
    links.forEach(link => {
      link.target = "_black";
    });
  }
  else if(command === "insertImage")
  {
    let imgs = postTextField.document.querySelectorAll('img');
    imgs.forEach(img => {
      img.style.maxWidth = "350px";
    });
  }
}
let showCode = false
function toggleCode()
{
  if(showCode)
  {
    showCode = false;
    postTextField.document.getElementsByTagName('body')[0].innerHTML = postTextField.document.getElementsByTagName('body')[0].textContent
  }
  else{
    showCode = true;
    postTextField.document.getElementsByTagName('body')[0].textContent = postTextField.document.getElementsByTagName('body')[0].innerHTML;
  }
}
</script>