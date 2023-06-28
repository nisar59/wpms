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



                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="fas fa-cogs"></i>
                        <span>Configurations</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <!-- Users -->
                        @can('users.view')
                        <li><a href="{{url('users')}}">Users</a></li>
                        @endcan
                        <!-- Permissions -->
                        @can('permissions.view')
                        <li><a href="{{url('roles')}}">Role & Permissions</a></li>
                        @endcan
                        <!-- Filer -->
                        @can('filters')
                        <li><a href="{{url('filters')}}">Filters</a></li>
                        @endcan
                        <!-- Plants -->
                         @can('plants')
                        <li><a href="{{url('plants')}}">Plants</a></li>
                        @endcan
                        <!-- Venders -->
                        @can('vendors')
                        <li><a href="{{url('vendors')}}">Vendor Management</a></li>
                        @endcan

                        <!-- country -->
                        @can('country')
                        <li><a href="{{url('country')}}">Country</a></li>
                        @endcan
                        

                         <!-- state -->
                        @can('state')
                        <li><a href="{{url('state')}}">States / Provinces</a></li>
                        @endcan

                        <!-- district -->
                        @can('district')
                        <li><a href="{{url('districts')}}">Districts</a></li>
                        @endcan

                        <!-- tehsil -->
                        @can('tehsil')
                        <li><a href="{{url('tehsil')}}">Tehsils</a></li>
                        @endcan


                        <!-- Settings -->
                        @can('settings')
                        <li><a href="{{url('settings')}}" class="waves-effect">Penal Settings</a></li>
                        @endcan

                    </ul>
                </li>
                <!-- School Management -->
                @can('school')
                <li class="menu-title">School Management</li>
                <li>
                    <a href="{{url('school')}}" class="waves-effect">
                        <i class="fas fa-building"></i>
                        <span>School Management</span>
                    </a>
                </li>
                @endcan
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>