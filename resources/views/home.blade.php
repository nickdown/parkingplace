@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (! auth()->user()->isInGarage())
                        You are not in the Garage.

                        @if (auth()->user()->canEnterGarage())
                            <form action="/visits" method="POST">
                                @csrf
                                <button class="btn btn-lg btn-primary">Enter Garage</button>
                            </form>
                        @endif
                    @else
                        You are in the Garage!
                        
                    @endif


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
