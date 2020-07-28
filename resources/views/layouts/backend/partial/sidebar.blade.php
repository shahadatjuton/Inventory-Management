@php
$prefix = Request::route()->getPrefix();
$route = Route::current()->getName();
@endphp

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">POS</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Admin</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview {{($prefix == 'admin/user')?'menu-open':''}}">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Manage User
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.user.index')}}" class="nav-link
                            {{($route == 'admin.user.index')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>User List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.user.create')}}" class="nav-link
                            {{($route == 'admin.user.create')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create User</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview {{($prefix == '/profile')?'menu-open':''}}">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Manage Profile
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('profile.index')}}" class="nav-link
                            {{($route == 'profile.index')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Profile</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('password.change')}}" class="nav-link
                            {{($route == 'password.change')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Change Password</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview {{($prefix == 'admin/supplier')?'menu-open':''}}">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Manage Supplier
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.supplier.index')}}" class="nav-link
                            {{($route == 'admin.supplier.index')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Supplier</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.supplier.create')}}" class="nav-link
                            {{($route == 'admin.supplier.create')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create Supplier</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview {{($prefix == 'admin/customer')?'menu-open':''}}">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Manage Customer
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.customer.index')}}" class="nav-link
                            {{($route == 'admin.customer.index')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Customer</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.customer.create')}}" class="nav-link
                            {{($route == 'admin.customer.create')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create Customer</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview {{($prefix == 'admin/unit')?'menu-open':''}}">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Manage Unit
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.unit.index')}}" class="nav-link
                            {{($route == 'admin.unit.index')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Unit</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.unit.create')}}" class="nav-link
                            {{($route == 'admin.unit.create')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create Unit</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview {{($prefix == 'admin/category')?'menu-open':''}}">
                <a href="#" class="nav-link active">
                    <i class="nav-icon fas fa-tachometer-alt"></i>
                    <p>
                        Manage Category
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.category.index')}}" class="nav-link
                            {{($route == 'admin.category.index')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Category</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.category.create')}}" class="nav-link
                            {{($route == 'admin.category.create')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create Category</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview ">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
