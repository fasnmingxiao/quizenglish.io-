<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;
    protected $table = 'reports';
    protected $fillable = ['user_id', 'type_error', 'content'];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
