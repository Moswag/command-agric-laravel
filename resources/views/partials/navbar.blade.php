<div id="page-header">
    <div id="header-nav-left">
        <div class="user-account-btn dropdown"><a href="#" title="My Account"
                                                  class="user-profile clearfix"
                                                  data-toggle="dropdown"><img width="28"
                                                                              src="{{URL::to('assets/images/user.png')}}"
                                                                              alt="Profile image">
                <span>{{auth()->user()->name}} {{auth()->user()->surname}}</span> <i class="glyph-icon icon-angle-down"></i></a>
            <div class="dropdown-menu float-right">
                <div class="box-sm">
                    <div class="login-box clearfix">
                        <div class="user-img"><a href="#" title="" class="change-img">Change photo</a>
                            <img src="{{URL::to('assets/images/user.png')}}" alt=""></div>
                        <div class="user-info"><span>{{auth()->user()->name}} {{auth()->user()->surname}} <i>{{auth()->user()->email}}</i></span>
                            <span>Access:Admin</span>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="button-pane button-pane-alt pad5L pad5R text-center">
                        <a href="{{url('logout')}}" class="btn btn-flat display-block font-normal btn-danger">
                            <i class="glyph-icon icon-power-off"></i> Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

