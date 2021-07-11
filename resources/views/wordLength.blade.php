@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> {{ $length }} letter words </div>

                <div class="card-body">

                <word-length word-length="{{ $length }}" letters="{{ json_encode($letters) }}"></word-length>
                </div>
            </div>
        </div>
    </div>
</div>          
@endsection
