<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dictionary extends Model
{
    use HasFactory;

    protected $fillable = ['word'];

    protected $appends = ['length'];

    public function getLengthAttribute() {
        return strlen($this->word);
    }
}
