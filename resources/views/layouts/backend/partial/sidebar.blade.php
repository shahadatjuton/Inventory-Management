@php
    $prefix = Request::route()->getPrefix();
    $route = Route::current()->getName();
@endphp

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route(Str::slug(Auth::user()->role->name).'.dashboard')}}" class="brand-link">
      <span class="brand-text font-weight-light">Point Of Sale</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('storage/profile/'.Auth::user()->image)}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="{{route(Str::slug(Auth::user()->role->name).'.dashboard')}}" class="d-block">{{Auth::user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item has-treeview {{($prefix == 'admin/user')?'menu-open':''}}">
                <a href="#" class="nav-link {{($prefix == 'admin/user')?'active':''}}">
                    <i class="fas fa-users"></i>
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

            <li class="nav-item has-treeview {{($prefix == 'admin/supplier')?'menu-open':''}}">
                <a href="#" class="nav-link {{($prefix == 'admin/supplier')?'active':''}}">
                    <i class="fas fa-truck"></i>
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
                <a href="#" class="nav-link {{($prefix == 'admin/customer')?'active':''}}">
                    <i class="fas fa-user-tag"></i>
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
                <a href="#" class="nav-link {{($prefix == 'admin/unit')?'active':''}}">
                    <i class="fas fa-balance-scale"></i>
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
                <a href="#" class="nav-link {{($prefix == 'admin/category')?'active':''}}">
                    <i class="fas fa-clipboard-list"></i>
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
            <li class="nav-item has-treeview {{($prefix == 'admin/product')?'menu-open':''}}">
                <a href="#" class="nav-link {{($prefix == 'admin/product')?'active':''}}">
                    <i class="nav-icon fas fa-shopping-basket"></i>
                    <p>
                        Manage Product
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.product.index')}}" class="nav-link
                            {{($route == 'admin.product.index')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Product</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.product.create')}}" class="nav-link
                            {{($route == 'admin.product.create')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create Product</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview {{($prefix == 'stock')?'menu-open':''}}">
                <a href="#" class="nav-link {{($prefix == 'stock')?'active':''}}">
                    <i class="fas fa-warehouse"></i>
                    <p>
                        Manage Stock
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('stock.index')}}" class="nav-link
                            {{($route == 'stock.index')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Present Stock</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.report.lowStock')}}" class="nav-link
                            {{($route == 'admin.report.lowStock')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Low Stock</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview {{($prefix == 'admin/purchase')?'menu-open':''}}">
                <a href="#" class="nav-link {{($prefix == 'admin/purchase')?'active':''}}">
                    <i class="fas fa-shopping-bag"></i>
                    <p>
                        Manage Purchase
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.purchase.index')}}" class="nav-link
                            {{($route == 'admin.purchase.index')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Purchase</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.purchase.create')}}" class="nav-link
                            {{($route == 'admin.purchase.create')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create Purchase</p>
                        </a>
                    </li>
                </ul>
            </li>


            <li class="nav-item has-treeview {{($prefix == 'admin/sale')?'menu-open':''}}">
                <a href="#" class="nav-link {{($prefix == 'admin/sale')?'active':''}}">
                    <i class="fas fa-cart-plus"></i>
                    <p>
                        Manage Sales
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.sale.index')}}" class="nav-link
                            {{($route == 'admin.sale.index')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Sales</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.sale.create')}}" class="nav-link
                            {{($route == 'admin.sale.create')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create Sale</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview {{($prefix == 'admin/report')?'menu-open':''}}">
                <a href="#" class="nav-link {{($prefix == 'admin/report')?'active':''}}">
                    <i class="fas fa-chart-bar"></i>
                    <p>
                        Report
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.report.sale.daily')}}" class="nav-link
                            {{($route == 'admin.report.sale.daily')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Date Wise Sales Report</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.report.purchase.daily')}}" class="nav-link
                            {{($route == 'admin.report.purchase.daily')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Date Wise Purchase Report</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview {{($prefix == 'admin/expenditure')?'menu-open':''}}">
                <a href="#" class="nav-link {{($prefix == 'admin/expenditure')?'active':''}}">
                    <i class="fas fa-hand-holding-usd"></i>
                    <p>
                        Manage Expenditure
                        <i class="right fas fa-donate-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.expenditure.index')}}" class="nav-link
                            {{($route == 'admin.expenditure.index')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>View Expenditure List</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.expenditure.create')}}" class="nav-link
                            {{($route == 'admin.expenditure.create')? 'active': ''}}">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Create Expenditure</p>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="nav-item has-treeview {{($prefix == '/profile')?'menu-open':''}}">
                <a href="#" class="nav-link {{($prefix == '/profile')?'active':''}}">
                    <i class="fas fa-user-circle"></i>
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

            <li class="nav-item has-treeview ">
                <a class="dropdown-item" href="{{ route('logout') }}"
                   onclick="event.preventDefault();
                   document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i>
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
