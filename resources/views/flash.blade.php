@if (count($errors) > 0)
    <div class="alert alert-danger">
        <strong>Attention</strong> Certain champs n'ont pas été rempli correctement.
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if(session()->has('success'))
    <div class="alert alert-success">
        <i class="fa fa-check"></i>&nbsp;&nbsp;{{ session('success') }}
    </div>
@endif

@if(session()->has('error'))
    <div class="alert alert-danger">
        <i class="fa fa-close"></i>&nbsp;&nbsp;{{ session('error') }}
    </div>
@endif