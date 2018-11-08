@extends('layouts.main')
@section('content')
<section class="wrapper">
    <div class="row">
        <div class="col-lg-12">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                 <h4>{{ session('status') }}</h4>
            </div>
            @endif
            <h4>Welcome !</h4>
        </div>
    </div>
</section>
@endsection
