<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 "
    id="sidenav-main">
    <div class="sidenav-header text-center">
        <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
            aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0 text-center" href="{{ route('home') }}" target="_blank">
            <img src="{{asset('assets/images/logo.webp')}}" class="navbar-brand-img h-100" alt="main_logo">
        </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'home' ? 'active' : '' }}"
                    href="{{ route('home') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-dashboard text-primary text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Dashboard</span>
                </a>
            </li>

           

            <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                    <i class="fa fa-users" style="color: #f4645f;"></i>
                </div>
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">User management</h6>
            </li> 


            <!-- <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                    <i class="fab fa-laravel" style="color: #f4645f;"></i>
                </div>
                <h6 class="ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Laravel Examples</h6>
            </li> -->
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'users' ? 'active' : '' }}"
                    href="{{ route('users.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Users</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'team-members' ? 'active' : '' }}"
                    href="{{ route('team-members.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-users text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Team Members</span>
                </a>
            </li>
           

            <li class="nav-item mt-3 d-flex align-items-center">
            <div class="ps-4">
                    <i class="fa fa-book" style="color: #f4645f;"></i>
                </div>
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Content management</h6>
            </li> 
           
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'categories' ? 'active' : '' }}"
                    href="{{ route('categories.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-question text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Blog Category</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'blogs' ? 'active' : '' }}"
                    href="{{ route('blogs.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-question text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Blog</span>
                </a>
            </li>

             
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'service-category' ? 'active' : '' }}"
                    href="{{ route('service-category.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-question text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">RTI Category</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'services' ? 'active' : '' }}"
                    href="{{ route('services.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-question text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">RTI Service</span>
                </a>
            </li>

            <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                    <i class="fa fa-scale-balanced" style="color: #f4645f;"></i>
                </div>
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Lawyer management</h6>
            </li> 
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'users' ? 'active' : '' }}"
                    href="{{ route('users.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-user text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Lawyer List</span>
                </a>
            </li>
            <li class="nav-item mt-3 d-flex align-items-center">
                <div class="ps-4">
                    <i class="fa fa-gear" style="color: #f4645f;"></i>
                </div>
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6 mb-0">Template Settings</h6>
            </li> 
            
            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'menu' ? 'active' : '' }}"
                    href="{{ route('menu.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bars text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Menu</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link {{ Route::currentRouteName() == 'template-section' ? 'active' : '' }}"
                    href="{{ route('template-section.index') }}">
                    <div
                        class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="fa fa-bars text-dark text-sm opacity-10"></i>
                    </div>
                    <span class="nav-link-text ms-1">Sections</span>
                </a>
            </li>
        </ul>
    </div>
   
</aside>