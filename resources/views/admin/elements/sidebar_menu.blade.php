<div class="clearfix"></div>
<div class="profile clearfix">
    <div class="profile_pic">
        <img src="{{ asset('admin/img/img.jpg') }}" alt="..." class="img-circle profile_img">
    </div>
    <div class="profile_info">
        <span>Welcome,</span>
        <h2>Minh Le</h2>
    </div>
</div>
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">
            <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Home</a></li>
            <li><a href="{{ route('slider') }}"><i class="fa fa-sliders"></i> Silders</a></li>
            <li><a href="{{ route('category') }}"><i class="fa fa fa-building-o"></i> Categories</a></li>
        </ul>
    </div>
</div>
