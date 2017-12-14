@if(Session::has('flash_message'))
    <div class="alert alert-success alert-dismissable" style="position: fixed; top: 100px; z-index:  1000; right: 10px;">
        {{ Session::get('flash_message') }}
    </div>
@endif