@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Begin and end | Consonants </div>

                <div class="card-body">

                <form-words word="{{ $word }}"></form-words>
                </div>
            </div>
        </div>
    </div>
</div>          
@endsection
