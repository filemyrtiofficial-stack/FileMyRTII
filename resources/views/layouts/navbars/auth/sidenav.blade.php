<nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="{{ route('home') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" href="">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">User Managment</span>
            </a>
          </li>

          
          <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('users.index') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Users</span>
            </a>
          </li>

          
          
          <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('team-members.index') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Team manager</span>
            </a>
          </li>

          <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('users.index') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Lawyer manager</span>
            </a>
          </li>

          <li class="nav-item mt-3">
            <a class="nav-link" href="">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Content Managment</span>
            </a>
          </li>


        
          <li class="nav-item pl-3">
            <a class="nav-link" data-toggle="collapse" href="#blog-menu" aria-expanded="false" aria-controls="blog-menu">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Blog</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="blog-menu">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('categories.index') }}">Category</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('blogs.index') }}">List</a></li>
              </ul>
            </div>
          </li>
          <li class="nav-item pl-3">
            <a class="nav-link" data-toggle="collapse" href="#service-menu" aria-expanded="false" aria-controls="service-menu">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Service</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="service-menu">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="{{ route('service-category.index') }}">Category</a></li>
                <li class="nav-item"> <a class="nav-link" href="{{ route('services.index') }}">List</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('testimonials.index') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Testimonials</span>
            </a>
          </li>
          
          <li class="nav-item mt-3">
            <a class="nav-link" href="">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Template Managment</span>
            </a>
          </li>
          <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('menu-setting.index') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Menu</span>
            </a>
          </li>
         
          <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('pages.index') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Pages</span>
            </a>
          </li>
          <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('template-section.index') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Sections</span>
            </a>
          </li>
           <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('settings.index') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Setting</span>
            </a>
          </li>
        </ul>
      </nav>