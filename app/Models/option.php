<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class option extends Model
{
    use HasFactory;
    protected $fillable = ['question_id', 'value', 'iscorrect'];

    public function question()
    {
        return $this->belongsTo(question::class, 'question_id', 'id');
    }

}
