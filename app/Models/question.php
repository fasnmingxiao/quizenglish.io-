<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class question extends Model
{
    use HasFactory;
    protected $fillable = ['question', 'quizcategory_id'];
    public function options()
    {
        return $this->hasMany(option::class, 'question_id', 'id');
    }
    public function quizcategories()
    {
        return $this->belongsTo(QuizCategory::class, 'quizcategory_id', 'id');
    }
}
