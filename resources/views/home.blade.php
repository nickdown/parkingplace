@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 mb-3">
            <park-place-app></park-place-app>
        </div>

        @include('layouts.sidebar')
    </div>
</div>
@endsection
