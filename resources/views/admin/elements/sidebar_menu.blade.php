@php
    $accountName = '';
    $accountImage = '';
    if (!empty(session('userInfo'))) {
        $accountName = session('userInfo')['username'];
        $accountImage = asset('images/user/' . session('userInfo')['avatar']);
    }
@endphp
<div class="clearfix"></div>
<div class="profile clearfix">
    <div class="profile_pic">
        <img src="{!! $accountImage !!}" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2>{!! $accountName !!}</h2>
    </div>
</div>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
            <li><a href="{{ route('slider') }}"><i class="fa fa-sliders"></i> Silders</a></li>
            <li><a href="{{ route('user') }}"><i class="fa fa-user"></i> Users</a></li>
            <li><a href="{{ route('category') }}"><i class="fa fa fa-building-o"></i> Categories</a></li>
            <li><a href="{{ route('article') }}"><i class="fa fa-newspaper-o"></i> Articles</a></li>
            <li><a href="{{ route('rss') }}"><i class="fa fa-rss"></i> Rss</a></li>
            <li><a href="{{ route('menu') }}"><i class="fa fa-bars"></i> Menu</a></li>
            <li><a href="{{ route('admin/gallery') }}"><i class="fa fa-file-image-o"></i> Gallery</a></li>
            <li>
                <a><i class="fa fa-cog"></i> Cấu hình</a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('setting', ['type' => 'general']) }}">Cấu hình chung</a></li>
                    <li><a href="{{ route('setting', ['type' => 'email']) }}">Email</a></li>
                    <li><a href="{{ route('setting', ['type' => 'social']) }}">Social</a></li>
                </ul>
            </li>
            <li><a href="{{ route('admin/contact') }}"><i class="fa fa-phone-square"></i> Contact</a></li>
        </ul>
    </div>
</div>
