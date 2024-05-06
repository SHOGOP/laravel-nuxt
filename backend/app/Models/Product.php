<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'category',
        'subcategory',
        'subsubcategory',
        'option1',
        'option2',
        'option3',
        'option4',
        'option5',
        'combo',
        'price',
    ];
}
