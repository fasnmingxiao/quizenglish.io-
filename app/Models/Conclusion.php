<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conclusion extends Model
{
    use HasFactory;
    protected $table = 'conclusion';
    protected $fillable = ['user_id', 'quizcategory_id', 'point', 'cat_id'];
}
