@if (Session::has('zvn_notify'))
    <div class="alert alert-info">{{ Session::get('zvn_notify') }}</div>
@endif
