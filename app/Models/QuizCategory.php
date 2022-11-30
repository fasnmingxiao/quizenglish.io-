<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizCategory extends Model
{
    use HasFactory;
    protected $table = 'quizcategory';
    protected $fillable = ['cat_id', 'name', 'description', 'time'];
    public function catTopic()
    {
        return $this->belongsTo(catTopic::class, 'cat_id', 'id');
    }
    public function question()
    {
        return $this->hasMany(question::class, 'quizcategory_id', 'id');
    }
}
