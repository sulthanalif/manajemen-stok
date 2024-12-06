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

    @role('Owner|Chef|Kepala Toko')

    <!-- Heading -->
    <div class="sidebar-heading">
        Master Data
    </div>
    <li class="nav-item {{ Route::currentRouteName() == 'item.index' || Route::currentRouteName() == 'kategori.index' || Route::currentRouteName() == 'satuan.index' ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1"
            aria-expanded="true" aria-controls="collapsePages1">
            <i class="fas fa-fw fa-folder"></i>
            <span>Resources</span>
        </a>
        <div id="collapsePages1" class="collapse {{ Route::currentRouteName() == 'item.index' || Route::currentRouteName() == 'kategori.index' || Route::currentRouteName() == 'satuan.index' ? 'show' : '' }}" aria-labelledby="headingPages1" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('item.index') }}">Items</a>
                <a class="collapse-item" href="{{ route('kategori.index') }}">Kategori</a>
                <a class="collapse-item" href="{{ route('satuan.index') }}">Satuan Item</a>
            </div>
        </div>
    </li>
    @endrole

    @role('Owner|Purchase')

    <li class="nav-item {{ Route::currentRouteName() == 'vendors.index' || Request::is('vendor-items*') ? 'active' : '' }}">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Vendor</span>
        </a>
        <div id="collapsePages" class="collapse {{ Route::currentRouteName() == 'vendors.index' || Request::is('vendor-items*') ? 'show' : '' }}" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('vendors.index') }}">Vendor List</a>
                <a class="collapse-item" href="{{ route('vendor-items') }}">Vendor Items</a>
                {{-- <a class="collapse-item" href="{{ route('satuan.index') }}">Satuan Item</a> --}}
            </div>
        </div>
    </li>
    @endrole

    @role('Owner')
    <li class="nav-item {{ Route::currentRouteName() == 'users.index' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-fw fa-users"></i>
            <span>Users</span></a>
    </li>
    @endrole


    @role('Chef|Owner')
    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Request
    </div>
     <!-- Nav Item - Charts -->
     <li class="nav-item {{ Route::currentRouteName() == 'request.create' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('request.create') }}">
            <i class="fas fa-fw fa-shopping-cart"></i>
            <span>Request Items</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Laporan
    </div>
     <!-- Nav Item - Charts -->
     <li class="nav-item {{ Route::currentRouteName() == 'laporan.request' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('laporan.request') }}">
            <i class="fas fa-fw fa-download"></i>
            <span>Laporan Request</span></a>
    </li>

   @endrole

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>



</ul>
<!-- End of Sidebar -->
