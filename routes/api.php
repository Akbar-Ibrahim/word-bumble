<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/words', 'DictionaryController@words');


// Route::get('/words/{length}/{size}', 'DictionaryController@wordsWithSpecificLength');

Route::get('/words-begin-with-{letter}/{length}', 'BeginsWithController@beginsWith');
Route::get('/words-end-with-{letter}', 'EndsWithController@endsWith');

Route::get("/words/start/with/consonant", "BeginsWithController@startAndEndWithConsonant");
Route::get("/words/start/with/vowel", "BeginsWithController@startAndEndWithVowel");


// Contains
Route::get('/words/contain', 'ContainsController@contains');

Route::get("words/begins-and-ends", "BeginsWithController@beginsAndEndWithSameLetter");

// Begining and end
Route::post("words/bande", "BeginingAndEndController@beginingAndEnd");
Route::post("ends-with", "BeginingAndEndController@endsWith");
Route::post("words/bande/specific", "BeginingAndEndController@beginingAndEndWithSpecificLength");

// Alternating
Route::get('try', 'AlternatingController@consonantAlt');



Route::post('/words/specific/position', 'NthLetterController@specificPosition');
Route::get('/words/specific/position/withFirst', 'NthLetterController@specificPositionWithFirstLetter');
Route::get('/words/specific/position/withLast', 'NthLetterController@specificPositionWithLastLetter');

// Specific number of letters
Route::post('/words/specific', 'SpecificLengthController@specificNumberOfLettersWithOptions');
Route::post('/words/length', 'SpecificLengthController@specificNumberOfLetters');


//Cluster
Route::post('/words/vowel/uncluster', 'ClusterController@vowelUncluster');
Route::get('/words/vowel/cluster', 'ClusterController@vowelCluster');



//  Begins and ends with
Route::post('/bb', 'BeginingAndEndController@beginsAndEndsWith');
// Vowels
Route::post('/bb/vowels', 'BeginingAndEndController@beginsAndEndsWithVowels');
// consonants
Route::post('/bb/consonants', 'BeginingAndEndController@beginsAndEndsWithConsonants');

// Random position
Route::post('/random/position', 'RandomPositionController@randomPosition');


//Word definition
Route::get('/word-definition', 'WordDefinitionController@getWords');
Route::get('/get-word/{length}', 'WordDefinitionController@getWord');
Route::post('/every-letter', 'WordDefinitionController@everyLetter');
Route::get('/get-words/{first}/{last}', 'WordDefinitionController@getTheWords');

Route::get('test', 'TestController@test');