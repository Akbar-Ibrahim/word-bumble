@extends('layouts.app')

@section('styles')
<style>
.games {
    font-size: 21px;
    }
</style>
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ $letter }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                </div>
                
                <div class="container">
                    <div class="games w3-padding" > Words that begin with {{ $letter }} </div>
                    <div class="games w3-padding" > Words that end with {{ $letter }} </div>
                    <div class="games w3-padding" > Words that begin and end with {{ $letter }} </div>
                    <div class="games w3-padding" > Words that do not begin or end with, but contain {{ $letter }} </div>
                    <div class="games w3-padding" > Words that begin with and contain {{ $letter }} </div>
                    <div class="games w3-padding" > Words that end with and contain {{ $letter }} </div>
                    <div class="games w3-padding" > Words that begin with, end with and contain {{ $letter }} </div>
                    <div class="games w3-padding" > {{ $letter }} at nth position</div>
                    <div class="games w3-padding" > Nth letter words that begin with {{ $letter }} </div>
                    <div class="games w3-padding" > Nth letter words that end with {{ $letter }} </div>
                    <div class="games w3-padding" > Nth letter words that contains {{ $letter }} </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
