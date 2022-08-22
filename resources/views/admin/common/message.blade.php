@if(isset($errors) && $errors->any())
    <div class="rows">
        <div class="alert alert-danger col-md-12">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

@if(Session::has('success'))
    <div class="rows">
        <div class="alert alert-success col-md-12">
            {!! Session::get('success')  !!}
        </div>
    </div>
@endif