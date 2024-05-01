<header class="main-nav">
    <div class="sidebar-user text-center"><a class="setting-primary" href="javascript:void(0)"><i data-feather="settings"></i></a><img class="img-90 rounded-circle" src="{{asset('admin/assets/images/dashboard/1.png')}}" alt="">
    <div class="badge-bottom"><span class="badge badge-primary">New</span></div><a href="user-profile.html">
        <h6 class="mt-3 f-14 f-w-600">{{ Auth::user()->name }}</h6></a>
    <p class="mb-0 font-roboto">Administrator</p>
    </div>
    <nav>
    <div class="main-navbar">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="mainnav">           
        <ul class="nav-menu custom-scrollbar">
            <li class="back-btn">
            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
            </li>
            <li class="menu"><a class="nav-link menu-title link-nav" href="{{ url('/admin/home/') }}"><i data-feather="home"></i><span>Dashboard</span></a>
            <!-- <ul class="nav-submenu menu-content">
                <li><a href="index.html">Default</a></li>
                <li><a href="dashboard-02.html">Ecommerce</a></li>
            </ul> -->
            </li>
            <li class="dropdown"><a class="nav-link menu-title link-nav" href="{{ route('admin.admin-user') }}"><i data-feather="users"></i><span>Admin Users</span></a>
            <li class="dropdown"><a class="nav-link menu-title link-nav" href="{{ route('admin.user') }}"><i data-feather="user"></i><span>Customers</span></a>
            <!-- <ul class="nav-submenu menu-content">
                <li><a href="general-widget.html">General</a></li>
                <li><a href="chart-widget.html">Chart</a></li>
            </ul> -->
            </li>
            <li class="dropdown"><a class="nav-link menu-title" href="javascript:void(0)"><i data-feather="truck"></i><span>Vehicle</span></a>
            <ul class="nav-submenu menu-content">
                <li><a href="{{ url('/admin/vehicle-type') }}">Vehicle Type</a></li>
                <li><a href="{{ url('/admin/vehicle-attribute') }}">Vehicle Attributes</a></li>
                <li><a href="{{ url('/admin/vehicle') }}">Vehicle</a></li>
            </ul>
            </li>
            {{-- <li class="menu"><a class="nav-link menu-title link-nav" href="{{ route('admin.service-master') }}"><i data-feather="server"></i><span>Services Master</span></a></li> --}}
            <li class="menu"><a class="nav-link menu-title link-nav" href="{{ route('admin.event-master') }}"><i data-feather="flag"></i><span>Event/Service Master</span></a></li>
            <li class="menu"><a class="nav-link menu-title link-nav" href="{{ url('/admin/slider-master/') }}"><i data-feather="sliders"></i><span>Slider Master</span></a></li>
            <li class="menu"><a class="nav-link menu-title link-nav" href="{{ route('admin.contacts') }}"><i data-feather="phone"></i><span>Contacts</span></a></li>
            <li class="menu"><a class="nav-link menu-title link-nav" href="{{ route('admin.bookings') }}"><i data-feather="book"></i><span>Bookings</span></a></li>
            <li class="menu"><a class="nav-link menu-title link-nav" href="{{ route('admin.invoices') }}"><i data-feather="check-square"></i><span>Invoices</span></a></li>
            <li class="menu"><a class="nav-link menu-title link-nav" href="{{ route('admin.quotes') }}"><i data-feather="file-text"></i><span>Events Quote</span></a></li>
            <li class="menu"><a class="nav-link menu-title link-nav" href="{{ route('admin.faq') }}"><i data-feather="help-circle"></i><span>FAQs</span></a></li>
        </ul>
        </div>
        <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
    </div>
    </nav>
</header>