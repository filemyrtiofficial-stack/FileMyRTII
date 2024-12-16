<header class="breadcrumb_banner">
            <img class="img-fluid bg_img" src="{{asset($data['top_banner_desktop_image'] ?? '')}}" alt="{{asset($data['top_banner_desktop_image_alt'] ?? '')}}">
                <div class="container">
                    <div class="row banner_row">
                        <div class="col-12 col-sm-12">
                            <div class="breadcrumb">
                               <ol>
                                <li class="fs-24"><a href="/">Home</a></li>
                                <li class="fs-24 active">{{$data['title'] ?? ''}}</li>
                               </ol>
                            </div>
                            <div class="breadcrumb_heading">
                                <h1 class="title fs-72">{{$data['title'] ?? ''}}</h1>
                            </div>
                        </div>
                    </div>
                </div>
        </header>

@if($key == 0 && $slug == 'blogs')
@include('frontend.sections.blog_listing')

@endif