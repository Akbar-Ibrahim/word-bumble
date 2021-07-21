<?php

namespace App\Http\Controllers;

use App\Models\Dictionary;
use App\Services\UtilService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

    public function wordLength(UtilService $utilService){
        
        

        $letters = $utilService->smallLetters();
        return view('wordLength', compact('letters'));
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

    public function wordDefinition() {
        return view('wordDefinition');
    }

    public function formWords() {
        
        $word = DB::table('dictionaries')->whereRaw('LENGTH(word) > ' . 10)->inRandomOrder()->limit(1)->get();
        return view('formWords', compact('word'));
    }

    public function ends(UtilService $utilService){

        $letters = $utilService->letters();
        return view('ends', compact('letters'));
    }

    public function endsWith ($letter, UtilService $utilService) {
        $letter = strtolower($letter);

        if (!in_array($letter, $utilService->letters())){
            return 404;
        }

        

        return view('endsWith', compact('letter'));
    }

    public function everyLetter() {

        return view('everyLetter');
    }

    public function beginEndFill(){
        return view('beginEndFill');
    }
}
