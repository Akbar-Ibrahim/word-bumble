@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">  The begining is the end, the end is the begining </div>

                <div class="card-body">

                <last-letter words="{{ json_encode($words) }}"></last-letter>
                </div>
            </div>
        </div>
    </div>
</div>          
@endsection

