@php
    $accountName = '';
    $accountImage = '';
    if (!empty(session('userInfo'))) {
        $accountName = session('userInfo')['username'];
        $accountImage = asset('images/user/' . session('userInfo')['avatar']);
    }
    $xhtmlLogOut = sprintf('<li><a href="%s">%s</a></li>', route('auth/logout'), 'Logout');
@endphp
<div class="nav_menu">
    <nav>
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="{!! $accountImage !!}" alt="">{!! $accountName !!}
                    <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                    {!! $xhtmlLogOut !!}
                </ul>
            </li>

        </ul>
    </nav>
</div>
