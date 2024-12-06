<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SB Admin <sup>2</sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item {{ Route::currentRouteName() == 'dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    @role('Owner|Chef')
    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>
    <li class="nav-item {{ Route::currentRouteName() == 'kategori*' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('kategori.index') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Kategori</span></a>
    </li>

    <li class="nav-item {{ Route::currentRouteName() == 'satuan*' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('satuan.index') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Satuan</span></a>
    </li>

    <li class="nav-item {{ Route::currentRouteName() == 'item*' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('item.index') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Items</span></a>
    </li>

    @endrole

    @role('Owner|Purchase')

    <li class="nav-item {{ Route::currentRouteName() == 'vendors*' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('vendors.index') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Vendor</span></a>
    </li>

    <li class="nav-item {{ Route::currentRouteName() == 'vendor-items*' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('vendor-items') }}">
            <i class="fas fa-fw fa-folder"></i>
            <span>Vendor Items</span></a>
    </li>

    @endrole




    @role('Chef')
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Request
    </div>
     <!-- Nav Item - Charts -->
     <li class="nav-item {{ Route::currentRouteName() == 'request*' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('request.create') }}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Request Items</span></a>
    </li>

   @endrole

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

    {{-- <!-- Sidebar Message -->
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="img/undraw_rocket.svg" alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!
        </p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div> --}}

</ul>
<!-- End of Sidebar -->
