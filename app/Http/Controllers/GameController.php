<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Services\UtilService;
use Illuminate\Http\Request;

class GameController extends Controller
{
    //

    public function lastLetter() {

        $words = Dictionary::inRandomOrder()->take(10)->get();
        
        return view('lastletter', compact('words'));
    }

    public function letter($letter, UtilService $utilService){
        
        $letter = strtoupper($letter);

        if (!in_array($letter, $utilService->letters())) {
            return ":)";
        }
        return view('letter', compact('letter'));
    }

    public function wordLength($length, UtilService $utilService){
        
        if (!is_numeric($length) || ($length < 4 || $length > 10)) {
            return 404;
        }

        $letters = $utilService->smallLetters();
        return view('wordLength', compact('length', 'letters'));
    }

    public function nthPosition(UtilService $utilService){
        
        // if (!is_numeric($position) || ($position < 2 || $length > 8)) {
        //     return 404;
        // }

        $letters = $utilService->letters();
        return view('nthPosition', compact( 'letters'));
    }

    public function vowelUnclustered(){
        

        return view('vowelUnclustered');
    }

    public function vowelClusters(){
        

        return view('vowelClusters');
    }

    public function consonantUnclustered(){
        

        return view('consonantUnclustered');
    }

    public function consonantClusters(){
        

        return view('consonantClusters');
    }

    public function beginingAndEnd(){

        return view('beginingAndEnd');
    }

    public function meBeforeYouVowel(){
        return view('meBeforeYouVowel');
    }

    public function meBeforeYouConsonant(){
        return view('meBeforeYouConsonant');
    }

    public function beginAndEndVowel(){
        return view('beginAndEndVowel');
    }

    public function beginAndEndConsonant(){
        return view('beginAndEndConsonant');
    }

    public function beginEndEqual(){

        return view('beginEndEqual');
    }

    public function randomPosition(UtilService $utilService){

        $alphabet = $utilService->smallLetters();
        return view('randomPosition', compact('alphabet'));
    }
}
