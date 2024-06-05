<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    protected $table = "category_post";
    // Because the table name is singular, indicate the table name
    public $timestamps = false; // Do not save timestamps
    protected $fillable = ['category_id', 'post_id'];
    // List of columns to save, when using create() function

    // Category_post belongs to category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
