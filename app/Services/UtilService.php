<?php
namespace App\Services;

use App\Models\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;

class UtilService{
    
  public $alphabet = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
  

  public function vowels() {
    $vowels = ["a", "e", "i", "o", "u"];
  return $vowels;
  }
  
  public function consonants () {
    $consonants = ["b", "c", "d", "f", "g", "h", "j", "k", "l", "m", "n", "p", "q", "r", "s", "t", "v", "w", "x", "y", "z"];
    return $consonants;
  }


  public function is_letter($letter) {
    return in_array($letter, $this->alphabet);
  }

  public function lettersForBeginingAndEnd(){
    return ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
  }

  public function letters () {
    // return ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    return ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
  }

  public function smallLetters () {
    return ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
    
    
  }

  public function lettersForLevels () {
    // return ['A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
    // return ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W'];
    return ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w'];
  }


  public function beginsAndEndsWithConsonants(){

    $consonants = [];

    $b = Dictionary::where('word', 'like', 'b%b')->orWhere('word', 'like', 'b%c')->orWhere('word', 'like', 'b%d')->orWhere('word', 'like', 'b%f')->orWhere('word', 'like', 'b%g')->
        where('word', 'like', 'b%h')->orWhere('word', 'like', 'b%j')->orWhere('word', 'like', 'b%k')->orWhere('word', 'like', 'b%l')->orWhere('word', 'like', 'b%m')->
        where('word', 'like', 'b%n')->orWhere('word', 'like', 'b%p')->orWhere('word', 'like', 'b%q')->orWhere('word', 'like', 'b%r')->orWhere('word', 'like', 'b%s')->
        where('word', 'like', 'b%t')->orWhere('word', 'like', 'b%v')->orWhere('word', 'like', 'b%w')->orWhere('word', 'like', 'b%x')->orWhere('word', 'like', 'b%y')->orWhere('word', 'like', 'b%z')->inRandomOrder()->first();

        array_push($consonants, $b);
  }

}

?>