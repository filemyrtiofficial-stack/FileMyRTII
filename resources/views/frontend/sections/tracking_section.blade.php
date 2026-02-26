

<section class="track_section">
            <div class="container">
                <form action="{{route('verify-tracking-rti')}}" class="authentication" method="post">
                    <div class="row">
                        <div class="col-12 col-sm-10">
                            <div class="section_heading">
                                <h2>Track Your RTI Application</h2>
                            </div>
                            <form action="" id="search-form">
                                <div class="tracking_wrapper">
                                        <div class="form_item">
                                            <label for="app_no">Application No</label>
                                            <input class="form_field" type="text" name="application_no" id="application_no" placeholder="" >
                                        </div>
                                        <div class="form_item">
                                            <label for="email">Email Id</label>
                                            <input class="form_field" type="text" name="email" id="email" placeholder="" >
                                        </div>
                                    </div>
                                    <div class="tracking_action">
                                        <button class="theme-btn" ><span>Submit</span></button>
                                    </div>
                            </form>
                    
                        </div>
                    </div>
                </form>
            </div>
        </section>
        