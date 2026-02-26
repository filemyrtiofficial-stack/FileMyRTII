
<section class="blog_listing_section">
    <div class="container">
        <div class="row blog_list_header">
            <div class="col-12 col-sm-6">
                <div class="section_heading">
                    <h2>Our Blogs</h2>
                </div>
            </div>
            <div class="col-12 col-sm-6">
                <form action="" class="blog-search">
                    <div class="search_area">
                        <div class="search_block">
                            <input class="form-field search-blog" type="search" name="search" id="" placeholder="Search" value="{{$_GET['search'] ?? ''}}">
                        </div>
                    </div>
               </form>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="blog_items_row blog-listing">
            
        </div>

        <ul class="blog_pagination">
            <!-- <li class="active"><a href="javascript:void(0);">01.</a></li>
            <li><a href="javascript:void(0);">02.</a></li>
            <li><a href="javascript:void(0);">03.</a></li>
            <li><a href="javascript:void(0);">more...</a></li> -->
        </ul>
    </div>
</section>