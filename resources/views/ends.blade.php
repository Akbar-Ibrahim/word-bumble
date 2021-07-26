@extends('layouts.app')


@section('content')
<div class="w3-container" style="width: 90%; margin: auto;">

<div class="w3-container w3-margin w3-padding">
        <h1 style="font-size: 50px;"> <b> Ends With </b> </h1>
    </div>

    <div class="w3-container w3-margin w3-padding">
        <h4> Select a letter from the alphabet </h4>
    </div>

    <div class="w3-container w3-center w3-hide-small">
        @foreach($letters as $letter)
        <div letter="{{ strtoupper($letter) }}" class="letter w3-padding w3-black w3-hover-amber w3-text-white w3-circle w3-left"
            style="font-size: 60px; width: 120px; color: white; cursor: pointer;"> <b>{{ strtoupper($letter) }}</b> </div>
        @endforeach
    </div>

    <div class="w3-container w3-center w3-hide-large">
        @foreach($letters as $letter)
        <div letter="{{ strtoupper($letter) }}" class="letter w3-padding w3-black w3-hover-amber w3-text-white w3-circle w3-left"
            style="font-size: 30px; width: 60px; color: white;"> <b>{{ strtoupper($letter) }}</b> </div>
        @endforeach
    </div>

</div>
@endsection

@section('scripts')
<script>
$(document).ready(function(){
  $(".letter").click(function(){
    location.href = "/ends-with/" + $(this).attr("letter")
    // alert("/ends-with/" + $(this).attr("letter"))
  });

});

</script>

@endsection