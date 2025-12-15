  <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ url('/') }}">
          <div class="sidebar-brand-icon rotate-n-15">
              <i class="fas fa-laugh-wink"></i>
          </div>
          <div class="sidebar-brand-text mx-3">Spartan Trade Business</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item active">
          <a class="nav-link" href="{{ route('dashboard.index') }}">
              <i class="fas fa-fw fa-tachometer-alt"></i>
              <span>Dashboard</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider">

      <!-- Heading -->
      <div class="sidebar-heading">
          Interface
      </div>

      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMenu"
              aria-expanded="true" aria-controls="collapseMenu">
              <i class="fas fa-fw fa-cog"></i>
              <span>Menu</span>
          </a>
          <div id="collapseMenu" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Menu Components:</h6>
                  <a class="collapse-item" href="{{ route('menu.index') }}">View List</a>
                  <a class="collapse-item" href="{{ route('menu.create') }}">Create New</a>
              </div>
          </div>
      </li>

      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
              aria-expanded="true" aria-controls="collapseTwo">
              <i class="fas fa-fw fa-cog"></i>
              <span>Slider</span>
          </a>
          <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Slider Components:</h6>
                  <a class="collapse-item" href="{{ route('slider.index') }}">View List</a>
                  <a class="collapse-item" href="{{ route('slider.create') }}">Create New</a>
              </div>
          </div>
      </li>

      <!-- Nav Item - Utilities Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
              aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-cog"></i>
              <span>Products</span>
          </a>
          <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
              data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <h6 class="collapse-header">Product Utilities:</h6>
                  <a class="collapse-item" href="{{ route('product.index') }}">View List</a>
                  <a class="collapse-item" href="{{ route('product.create') }}">Create New</a>
                  <h6 class="collapse-header">Category Utilities:</h6>
                  <a class="collapse-item" href="{{ route('category.index') }}">View & Create</a>
                  <h6 class="collapse-header">Background Images:</h6>
                  <a class="collapse-item" href="{{ route('background-image.index') }}">View & Create</a>
              </div>
          </div>
      </li>
      <!-- Nav Item - Charts -->
      <li class="nav-item">
          <a class="nav-link" href="{{ route('welcome-message.edit') }}">
               <i class="fas fa-fw fa-cog"></i>
              <span>Welcome Message</span></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('overview.index') }}">
             <i class="fas fa-fw fa-cog"></i>
              <span>Overview</span></a>
      </li>


      <!-- Nav Item - Pages Collapse Menu -->
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
              aria-expanded="true" aria-controls="collapsePages">
              <i class="fas fa-fw fa-cog"></i>
              <span>Customer Says</span>
          </a>
          <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item" href="{{ route('customer-says.index') }}">View List</a>
                  <a class="collapse-item" href="{{ route('customer-says.create') }}">Create New</a>
              </div>
          </div>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('promotion-video.edit') }}">
               <i class="fas fa-fw fa-cog"></i>
              <span>Promotion Video</span></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('partners.index') }}">
              <i class="fas fa-fw fa-cog"></i>
              <span>Our Partners</span></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('sisterCompany.edit') }}">
              <i class="fas fa-fw fa-cog"></i>
              <span>Sister Companies</span></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('story.edit') }}">
              <i class="fas fa-fw fa-cog"></i>
              <span>Our Story</span></a>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('gallery.index') }}">
              <i class="fas fa-fw fa-cog"></i>
              <span>Gallery</span></a>
      </li>
      <li class="nav-item">
          <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#vacancyPages"
              aria-expanded="true" aria-controls="vacancyPages">
              <i class="fas fa-fw fa-cog"></i>
              <span>Vacancy</span>
          </a>
          <div id="vacancyPages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
              <div class="bg-white py-2 collapse-inner rounded">
                  <a class="collapse-item" href="{{ route('vacancy.index') }}">View List</a>
                  <a class="collapse-item" href="{{ route('vacancy.create') }}">Create New</a>
              </div>
          </div>
      </li>
      <li class="nav-item">
          <a class="nav-link" href="{{ route('site-setting.edit') }}">
              <i class="fas fa-fw fa-wrench"></i>
              <span>Site Setting</span></a>
      </li>




      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
          <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>



  </ul>
