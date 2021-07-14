@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Random Position </div>

                <div class="card-body">

                <random-position alphabet="{{ json_encode($alphabet) }}"></random-position>
                </div>
            </div>
        </div>
    </div>
</div>          
@endsection
