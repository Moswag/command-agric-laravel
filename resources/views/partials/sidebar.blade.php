<div id="page-sidebar">
    <div id="header-logo" class="logo-bg">
        <img src="{{URL::to('assets/images/logo.png')}}" style="height: 60px" title="DelightUI">Command
            <i>Agric</i>
        </img>
        <a href="index.html"  class="logo-content-small"  title="DelightUI">Command
            <i>Agric</i>
        </a>
        <a id="close-sidebar" href="#" title="Close sidebar">
            <i class="glyph-icon icon-outdent"></i>
        </a>
    </div>

    <div class="scroll-sidebar">
        <ul id="sidebar-menu">

            <li class="header"><span>Users</span></li>
            <li><a href="javascript:void(0);" title="Elements"><i class="glyph-icon icon-linecons-tv"></i>
                    <span>Admin</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{route('admin.create')}}" title="Buttons"><span>Add Admin</span></a></li>
                        <li><a href="{{url('admin')}}"
                               title="Labels &amp; Badges"><span>View Admins</span></a></li>
                    </ul>
                </div>
            </li>
            <li><a href="javascript:void(0);" title="Elements"><i class="glyph-icon icon-linecons-tv"></i>
                    <span>Farmer</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{route('farmer.create')}}" title="Buttons"><span>Add Farmer</span></a></li>
                        <li><a href="{{route('farmer.index')}}"
                               title="Labels &amp; Badges"><span>View Farmers</span></a></li>
                    </ul>
                </div>
            </li>
            <li><a href="javascript:void(0);" title="Elements"><i class="glyph-icon icon-linecons-tv"></i>
                    <span>Expert</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{route('expert.create')}}" title="Buttons"><span>Add Expert</span></a></li>
                        <li><a href="{{url('expert')}}"
                               title="Labels &amp; Badges"><span>View Experts</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="header"><span>Components</span></li>
            <li><a href="javascript:void(0);" title="Elements"><i class="glyph-icon icon-linecons-diamond"></i>
                    <span>Crops</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{route('crop.create')}}" title="Buttons"><span>Add Crop</span></a></li>
                        <li><a href="{{route('crop.index')}}"
                               title="Labels &amp; Badges"><span>View Crops</span></a></li>
                    </ul>
                </div>
            </li>
            <li><a href="javascript:void(0);" title="Dashboard boxes"><i
                        class="glyph-icon icon-linecons-lightbulb"></i> <span>Soil</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{route('soil_type.create')}}" title="Chart boxes"><span>Add Soil Type</span></a></li>
                        <li><a href="{{route('soil_type.index')}}" title="Tile boxes"><span>View Soil Types</span></a></li>
                    </ul>
                </div>
            </li>
            <li><a href="javascript:void(0);" title="Widgets"><i class="glyph-icon icon-linecons-wallet"></i>
                    <span>District</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{route('district.create')}}" title="Responsive tabs"><span>Add District</span></a></li>
                        <li><a href="{{route('district.index')}}" title="Collapsables"><span>View Districts</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li><a href="javascript:void(0);" title="Forms UI"><i class="glyph-icon icon-linecons-eye"></i>
                    <span>Farm</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{route('farm.create')}}" title="Form elements"><span>Add  farm</span></a>
                        </li>
                        <li><a href="{{route('farm.index')}}" title="Form validation"><span>View farms</span></a>
                        </li>
                    </ul>
                </div>
            </li>
            <li><a href="javascript:void(0);" title="Advanced tables"><i
                        class="glyph-icon icon-linecons-megaphone"></i> <span>GMB Prices</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{route('gmb.create')}}" title="Basic tables"><span>Add Prices</span></a></li>
                        <li><a href="{{route('gmb.index')}}"
                               title="Responsive tables"><span>View Prices</span></a></li>
                    </ul>
                </div>
            </li>
            <li><a href="javascript:void(0);" title="Charts"><i
                        class="glyph-icon icon-linecons-paper-plane"></i> <span>Distribution</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{route('distribution.create')}}" title="Flot charts"><span>Add Distribution</span></a></li>
                        <li><a href="{{route('distribution.index')}}" title="Sparklines"><span>View Distributions</span></a></li>
                    </ul>
                </div>
            </li>
            <li><a href="javascript:void(0);" title="Maps"><i class="glyph-icon icon-linecons-sound"></i> <span>Yields</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{route('yield.index')}}" title="gMaps"><span>View Yields</span></a></li>
                    </ul>
                </div>
            </li>
            <li class="header"><span>Extra</span></li>
            <li><a href="javascript:void(0);" title="Pages"><i class="glyph-icon icon-linecons-fire"></i> <span>Weather Notifications</span>
                    </a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{route('weather.create')}}"
                               title="Alternate dashboard"><span>Add Weather Notification</span></a></li>
                        <li><a href="{{route('weather.index')}}" title="View profile"><span>View Notifications</span></a></li>
                    </ul>
                </div>
            </li>
            <li><a href="javascript:void(0);" title="Other Pages"><i class="glyph-icon icon-linecons-cup"></i>
                    <span>Performing Farmers</span></a>
                <div class="sidebar-submenu">
                    <ul>
                        <li><a href="{{route('pf.index')}}" target="_blank"
                               title="Login page 1"><span>View</span></a></li>

                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
