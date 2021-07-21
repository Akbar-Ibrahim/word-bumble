@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Ends With </div>

                <div class="card-body">

                @if($letter === 'j' || $letter === 'q')
                <ends-with-j my-letter="{{ $letter }}"></ends-with-j>
                @else
                <ends-with my-letter="{{ $letter }}"></ends-with>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>          
@endsection
