<div class="col-12 col-sm-4">
                    <div class="blog_item_wrapper">
                        <div class="blog_item">
                            <div class="blog_img">
                                <img class="img-fluid" src="{{asset($value['thumbnail'] ?? '')}}"
                                    alt="Blog Image">
                            </div>
                            <div class="blog_area">
                                <div class="blog_date fs-20">{{isset($value['publish_date']) ? Carbon\Carbon::parse($value['publish_date'])->format('M d, Y') :  ''}}</div>
                                <div class="blog_text fs-28 fw-600">
                                    <p>{{$value['title'] ?? ''}}
                                    </p>
                                </div>
                                <a href="{{route('blog-details',[$value->slugMaster->slug ?? ''])}}" class="theme-btn-link fs-28">Read more</a>
                            </div>
                        </div>
                    </div>
                </div>