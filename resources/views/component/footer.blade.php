<section id="footer" class="p-1">
    <footer class="container-fluid mt-5">
        <div class="row p-3">
            <div class="col-md-4 px-5">
                    <h3 class="sectionTitle">MTI</h3>
                    @if(count($data))
                        <p class="mt-2">{{$data[0]->footer}}</p>
                    @endif
            </div>
            <div class="col-md-4">
                    <h3 class="sectionTitle">Recent Post</h3>
                    <ul id="footer_post_link" class="list-group mt-2">
                        
                    </ul>
            </div>
            <div class="col-md-4">
                    <h3 class="sectionTitle">newsletter</h3>
                    <div class="form-group mt-2">
                        <input type="email" class="form-control" required placeholder="Email">
                        <button class="btn mt-2 text-uppercase btn-info">subscribe</button>
                    </div>
            </div>
        </div>
    </footer>
    
    <hr/>
    
    <div class="container-fluid">
        <div class="row text-center">
            <div class="col-12">
                <p>Copyright &copy; <script>document.write(new Date().getFullYear())</script> MTI All Rights Reserved</p>
            </div>
        </div>
    </div>


</section>