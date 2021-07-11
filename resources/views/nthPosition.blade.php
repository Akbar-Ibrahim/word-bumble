@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">  Nth Position </div>

                <div class="card-body">

                <nth-position letters="{{ json_encode($letters) }}"></nth-position>
                </div>
            </div>
        </div>
    </div>
</div>          
@endsection
