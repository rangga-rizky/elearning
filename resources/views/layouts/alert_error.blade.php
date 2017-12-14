@if($errors->any())
    <div class="alert alert-danger alert-dismissable" style="position: fixed; top: 100px; z-index:  1000; right: 10px;" >
        @foreach($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif