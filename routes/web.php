<?php

use App\Models\CommonWord;
use App\Models\Dictionary;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'WelcomeController@welcome');


// Route::get('/crossword', 'GameController@crossWord');
Route::get('/begin-end/fill', 'GameController@beginEndFill');
Route::get('/every-letter', 'GameController@everyLetter');
Route::get('/ends', 'GameController@ends');
Route::get('/ends-with/{letter}', 'GameController@endsWith');

Route::get('/words', 'DictionaryController@words');
Route::get('/last/letter', 'GameController@lastLetter');
Route::get('/word-length', 'GameController@wordLength');
// Route::get('/letters/{letter}/', 'GameController@letter')->name('letters.letter');
Route::get('/nth-position/', 'GameController@nthPosition')->name('nth.position');

// clusters
Route::get('/vowel/unclustered/', 'GameController@vowelUnclustered');
Route::get('/consonant/unclustered/', 'GameController@consonantUnclustered');
Route::get('/vowel/clusters/', 'GameController@vowelClusters');
Route::get('/consonant/clusters/', 'GameController@consonantClusters');

Route::get('/form-words', 'GameController@formWords');


Route::get('/begining-and-end/', 'GameController@beginingAndEnd');

Route::get('/begining-and-end/equal', 'GameController@beginEndEqual');


// Word definition
Route::get('/word-definition', 'GameController@wordDefinition');


Route::get('/random-position', 'GameController@randomPosition');


Route::get('me-before-you/vowel', 'GameController@meBeforeYouVowel');
Route::get('me-before-you/consonant', 'GameController@meBeforeYouConsonant');


Route::get('begin-and-end/vowel', 'GameController@beginAndEndVowel');
Route::get('begin-and-end/consonant', 'GameController@beginAndEndConsonant');



Route::get('/insert', function(){
    $myfile = fopen("word.txt", "r") or die("Unable to open file!");

while(!feof($myfile)) {
    $word = fgets($myfile);
    $r = str_replace("\r", '', $word);
    $n = str_replace("\n", '', $r);

  CommonWord::create(["word" => $n]);
}
fclose($myfile);

$result = CommonWord::all();
return $result->count();

});

Route::get("/show", function(){
    return ZWord::where("id", 1387)->first();
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
