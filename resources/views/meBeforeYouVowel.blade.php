@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Me Before You | Vowels </div>

                <div class="card-body">
                @if(1>2)
                <me-before-you-vowel></me-before-you-vowel>
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
