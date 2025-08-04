@php
    use App\Models\WebsiteSetting;
    $website_setting = WebsiteSetting::first();
@endphp
<!-- Top Bar -->
<nav class="navbar">
    <div class="col-12">
        <div class="navbar-header">
            <a href="javascript:void(0);" class="bars"></a>
            <a class="navbar-brand" href="{{ url('/') }}" target="_blank">{{ $website_setting->website_title }}</a>
        </div>
        <ul class="nav navbar-nav navbar-left">
            <li><a href="javascript:void(0);" class="ls-toggle-btn" data-close="true"><i class="zmdi zmdi-swap"></i></a></li>
            <li><a href="mail-inbox.html" class="inbox-btn hidden-sm-down" data-close="true"><i class="zmdi zmdi-email"></i></a></li>
            <li class="dropdown menu-app hidden-sm-down"><a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"> <i class="zmdi zmdi-apps"></i> </a>
                <ul class="dropdown-menu slideDown">
                    <li class="body">
                        <ul class="menu">
                            <li><a href="blog-dashboard.html"><i class="zmdi zmdi-blogger"></i><span>Blog</span></a></li>
                            <li><a href="contact.html"><i class="zmdi zmdi-accounts-list"></i><span>Contacts</span></a></li>
                            <li><a href="chat.html"><i class="zmdi zmdi-comment-text"></i><span>Chat</span></a></li>
                            <li><a href="javascript:void(0)"><i class="zmdi zmdi-arrows"></i><span>Notes</span></a></li>
                            <li><a href="javascript:void(0)"><i class="zmdi zmdi-view-column"></i><span>Taskboard</span></a></li>
                            <li><a href="events.html"><i class="zmdi zmdi-calendar-note"></i><span>Calendar</span></a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li style="font-weight: 700"><a href="{{ route('home') }}" class="inbox-btn hidden-sm-down text-uppercase" data-close="true" target="_blank">Visit Website</a></li>
            
        </ul>
        <ul class="nav navbar-nav navbar-right">
            <li><a href="javascript:void(0);" class="js-search" data-close="true"><i class="zmdi zmdi-search"></i></a></li>
            <li class="dropdown">
                <a href="javascript:void(0);" class="dropdown-toggle xs-hide" data-toggle="dropdown" role="button"><i class="zmdi zmdi-account"></i>
                    <div class="notify"><span class="heartbit"></span><span class="point"></span></div>
                </a>
                <ul class="dropdown-menu slideDown">
                    <li class="body">
                        <ul class="menu list-unstyled custom-profile-signout">
                            <li><a href="{{ route('user.profile') }}">
                                <div class="icon-circle g-bg-cyan"> <i class="material-icons">account_circle</i> </div>
                                <div class="menu-info">
                                    <h4><b>Profile</b> </h4>
                                </div>
                                </a>
                            </li>
                            <li class="divider"></li>
                            <li>
                                <form method="POST" action="{{ route('logout') }}" style="padding:10px 15px">
                                    @csrf
                                    <button type="submit" style="all:unset; cursor:pointer; display:flex; align-items:center;">
                                        <div class="icon-circle g-bg-cyan">
                                            <i class="material-icons">exit_to_app</i>
                                        </div>
                                        <div class="menu-info-custom" style="margin-left: 8px; top:0">
                                            <h4><b>Sign Out</b></h4>
                                        </div>
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </li>


            <li><a href="javascript:void(0);" class="js-right-sidebar" data-close="true"><i class="zmdi zmdi-settings zmdi-hc-spin"></i></a></li>
        </ul>
    </div>
</nav>
