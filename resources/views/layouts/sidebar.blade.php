@php
$pref = Request()->route()->getPrefix();
$type = Request()->type;
@endphp
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Main</li>
                <li @if ($pref == '') class="mm-active" @endif>
                    <a href="{{url('/')}}" class="waves-effect">
                        <i class="ti-home"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                @canany(['users.view','permissions.view'])
                <li class="menu-title">Users</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-users"></i>
                        <span>Users</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @can('users.view')
                        <li><a href="{{url('users')}}">Users</a></li>
                        @endcan
                        @can('permissions.view')
                        <li><a href="{{url('roles')}}">Role & Permissions</a></li>
                        @endcan
                    </ul>
                </li>
                @endcan
                <!--   School Management -->
                @can('school')
                <li class="menu-title">School Management</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='fas fa-school'></i>
                        <span>School Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('school')}}">School Management</a></li>
                    </ul>
                </li>
                @endcan
                <!-- Filer -->
                @can('filters')
                <li class="menu-title">Filters</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='fas fa-filter' ></i>
                        <span>Filters</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('filters')}}">Filters</a></li>
                    </ul>
                </li>
                @endcan
                <!-- Plants -->
                 @can('plants')
                <li class="menu-title">Plants</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='fas fa-seedling' ></i>
                        <span>Plants</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('plants')}}">Plants</a></li>
                    </ul>
                </li>
                @endcan
                <!-- Venders -->
                 @can('venders')
                <li class="menu-title">Vendor Management</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class='fa fa-industry' ></i>
                        <span>Vendor Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('venders')}}">Vendor Management</a></li>
                    </ul>
                </li>
                @endcan
                <!-- Stock Management -->
                @can('stock')
                <li class="menu-title"> Stock Management</li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="  fas fa-hand-holding-usd"></i>
                        <span>Stock Management</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{url('stock')}}">Stock Management</a></li>
                    </ul>
                </li>
                @endcan
                @can('settings')
                <li class="menu-title">Penal Settings</li>
                <li>
                    <a href="{{url('settings')}}" class="waves-effect">
                        <i class="fas fa-cogs"></i>
                        <span>Penal Settings</span>
                    </a>
                </li>
                @endcan
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>