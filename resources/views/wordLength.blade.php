@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"> Word Length Mine Field <end-game></end-game> </div>

                <div class="card-body">
                
                <word-length letters="{{ json_encode($letters) }}"></word-length>
                
                </div>
            </div>
        </div>
    </div>
</div>          
@endsection
