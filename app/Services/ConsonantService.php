<?php
namespace App\Services;

use App\Models\Dictionary;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;

class ConsonantService{
    
  public $alphabet = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
  

  
  public function getLetter($letter){


    return Dictionary::where('word', 'like', $letter . '%b')->orWhere('word', 'like', $letter . '%c')->orWhere('word', 'like', $letter . '%d')->orWhere('word', 'like', $letter . '%f')->orWhere('word', 'like', $letter . '%g')->
        where('word', 'like', $letter . '%h')->orWhere('word', 'like', $letter . '%j')->orWhere('word', 'like', $letter . '%k')->orWhere('word', 'like', $letter . '%l')->orWhere('word', 'like', $letter . '%m')->
        where('word', 'like', $letter . '%n')->orWhere('word', 'like', $letter . '%p')->orWhere('word', 'like', $letter . '%q')->orWhere('word', $letter . 'ike', $letter . '%r')->orWhere('word', 'like', $letter . '%s')->
        where('word', 'like', $letter . '%t')->orWhere('word', 'like', $letter . '%v')->orWhere('word', 'like', $letter . '%w')->orWhere('word', 'like', $letter . '%x')->orWhere('word', 'like', $letter . '%y')->orWhere('word', 'like', $letter . '%z')->inRandomOrder()->first();


  }

}

?>