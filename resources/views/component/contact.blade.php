<section id="contact">


    <div class="container-fluid text-center">
        <h2 class="sectionTitle">Contact us</h2>
        <p class="subTitle">If your are interested to our services then you can contact with us</p>
        <div class="row px-5">
            <div class="col-md-6">
                <!-- <form> -->
                    <div class="form-group">
                        <label for="contactName">Your Name</label>
                        <input type="text" required  class="form-control" id="contactName" placeholder="your name">
                    </div>
                    <div class="form-group">
                        <label for="contactEmail">Email address</label>
                        <input type="email" required  class="form-control" id="contactEmail" placeholder="your email">
                    </div>
                    <div class="form-group">
                        <label for="contactSubject">Subject</label>
                        <input type="text" required  class="form-control" id="contactSubject" placeholder="subject">
                    </div>
                    <div class="form-group">
                        <label for="contactMessage">Message</label>
                        <textarea required id="contactMessage" class="form-control"></textarea>
                    </div>
                    <button  id="contactMessageConfirmBtn" class="btn btn-primary">Submit</button>
                <!-- </form> -->
            </div>
            <div class="col-md-6">
                <div class="googleMap">
                    {!!$data[0]->map_link!!}
                </div>
            </div>
        </div>
    </div>
</section>