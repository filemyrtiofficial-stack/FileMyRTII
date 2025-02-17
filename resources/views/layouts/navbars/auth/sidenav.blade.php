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

          @if(auth()->user()->can('Manage Role'))
          <li class="nav-item pl-3">
            <a class="nav-link" href="{{route('roles.index')}}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Roles</span>
            </a>
          </li>
          @endif

          @if(auth()->user()->can('Manage User'))
          <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('users.index') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Users</span>
            </a>
          </li>
          @endif
         
          @if(auth()->user()->can('Manage Customer'))
          <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('customers.index') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Customers</span>
            </a>
          </li>
          @endif
          
          @if(auth()->user()->can('Manage Team Member'))
          
          <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('team-members.index') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Team manager</span>
            </a>
          </li>
          @endif

          @if(auth()->user()->can('Manage Lawyer'))
          <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('lawyers.index') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Lawyer Management</span>
            </a>
          </li>
          @endif
          @if(auth()->user()->can('Manage PIO'))
          <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('pio.index') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">PIO Management</span>
            </a>
          </li>
          @endif

          <li class="nav-item mt-3">
            <a class="nav-link" href="">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Content Managment</span>
            </a>
          </li>


        
          @if(auth()->user()->can('Manage Blog Category') || auth()->user()->can('Manage Blog'))
          <li class="nav-item pl-3">
            <a class="nav-link" data-toggle="collapse" href="#blog-menu" aria-expanded="false" aria-controls="blog-menu">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Blog</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="blog-menu">
              <ul class="nav flex-column sub-menu">
                @if(auth()->user()->can('Manage Blog Category'))
                <li class="nav-item"> <a class="nav-link" href="{{ route('categories.index') }}">Category</a></li>
                @endif
                @if(auth()->user()->can('Manage Blog'))
                <li class="nav-item"> <a class="nav-link" href="{{ route('blogs.index') }}">List</a></li>
                @endif
                <li class="nav-item"><a class="nav-link"  href="{{ route('blog.comment.list') }}">Comment</a></li>
              </ul>
            </div>
          </li>
          @endif
          @if(auth()->user()->can('Manage Service category') || auth()->user()->can('Manage Service'))
          <li class="nav-item pl-3">
            <a class="nav-link" data-toggle="collapse" href="#service-menu" aria-expanded="false" aria-controls="service-menu">
              <i class="icon-layout menu-icon"></i>
              <span class="menu-title">Service</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="service-menu">
              <ul class="nav flex-column sub-menu">
              @if(auth()->user()->can('Manage Service category'))
                <li class="nav-item"> <a class="nav-link" href="{{ route('service-category.index') }}">Category</a></li>
                @endif
                @if(auth()->user()->can('Manage Service'))
                <li class="nav-item"> <a class="nav-link" href="{{ route('services.index') }}">List</a></li>
                @endif
              </ul>
            </div>
          </li>
          @endif
          @if(auth()->user()->can('Manage Testimonial'))
          <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('testimonials.index') }}">
              <i class="icon-head menu-icon"></i>
              <span class="menu-title">Testimonials</span>
            </a>
          </li>
          @endif
          
          <li class="nav-item mt-3">
            <a class="nav-link" href="">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Template Managment</span>
            </a>
          </li>
          @if(auth()->user()->can('Manage Menu'))
          <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('menu-setting.index') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Menu</span>
            </a>
          </li>
          @endif
          @if(auth()->user()->can('Manage Pages'))
         
          <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('pages.index') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Pages</span>
            </a>
          </li>
          @endif
          @if(auth()->user()->can('Manage Section Data'))
          <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('template-section.index') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Sections</span>
            </a>
          </li>
          @endif
          @if(auth()->user()->can('Header Footer') || auth()->user()->can('Payment'))
          <li class="nav-item mt-3">
            <a class="nav-link" href="">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Settings</span>
            </a>
          </li>
          @if(auth()->user()->can('Header Footer'))
           <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('settings.index',['header-footer-setting']) }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Header Footer</span>
            </a>
          </li>
          @endif
          @if( auth()->user()->can('Payment'))
          <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('settings.index',['payment']) }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Payment</span>
            </a>
          </li>
          <li class="nav-item pl-3">
            <a class="nav-link" href="{{ route('settings.index',['invoice-setting']) }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Invoice</span>
            </a>
          </li>
          @endif
          @endif
          @if(auth()->user()->can('Manage Newsletter Data'))

          <li class="nav-item mt-3">
            <a class="nav-link" href="">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Newsletter Managment</span>
            </a>
          </li>
          <li class="nav-item pl-3">
            <a class="nav-link"  href="{{ route('newsletter.index') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Subscribers</span>
            </a>
          </li>
          @endif
          @if(auth()->user()->can('Manage Enquiry') || auth()->user()->can('Manage RTI Application'))
          <li class="nav-item mt-3">
            <a class="nav-link" href="">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Enquiry</span>
            </a>
          </li>
          @if(auth()->user()->can('Manage Enquiry'))
          <li class="nav-item pl-3">
            <a class="nav-link"  href="{{ route('enquiries.index') }}">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Enquiry List</span>
            </a>
          </li>
          @endif
          @if(auth()->user()->can('Manage RTI Application'))
          <li class="nav-item pl-3">
            <a class="nav-link"  href="{{ route('rti.applications.list') }}">
              <i class="icon-query menu-icon"></i>
              <span class="menu-title">RTI Applications</span>
            </a>
          </li>

          <li class="nav-item pl-3">
            <a class="nav-link"  href="{{ route('rticloserequest.list') }}">
              <i class="icon-query menu-icon"></i>
              <span class="menu-title">RTI close Request</span>
            </a>
          </li>
          @endif
          @endif

          
        </ul>
      </nav>