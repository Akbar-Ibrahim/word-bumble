@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> {{ $length }} letter words </div>

                <div class="card-body">
                @if(1>2)
                <word-length word-length="{{ $length }}" letters="{{ json_encode($letters) }}"></word-length>
                @else
                    <h1 class="w3-center"> :) </h1>
                    <p class="w3-center"> Come back later </p>
                @endif
                </div>
            </div>
        </div>
    </div>
</div>          
@endsection
