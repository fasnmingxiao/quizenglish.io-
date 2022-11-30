<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class catTopic extends Model
{
    use HasFactory;
    protected $table = 'cat_topic';
    protected $fillable = ['name', 'parent_id', 'thumb', 'description'];
    public function quizCategory()
    {
        return $this->hasMany(QuizCategory::class, 'cat_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'category_register', 'cat_id', 'user_id');
    }
}
