<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Blog extends Model
{
    use HasFactory;
    use softDeletes;
    protected $fillable = [
        'category_id', 'title',
        'sub_title','description',
        'thumbnail','valid'
    ];
    protected $dates = ['deleted_at'];
}
