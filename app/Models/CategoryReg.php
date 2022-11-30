<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryReg extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'category_register';
    protected $fillable = ['user_id', 'cat_id'];
}
