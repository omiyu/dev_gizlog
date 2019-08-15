<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Question;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $table = 'tag_categories';
    protected $dates = ['deleted_at'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function getAllCategories()
    {
        $categories = $this->all();
        foreach ($categories as $category){
            $arrayCategories[$category->id] = $category->name;
        };
        return $arrayCategories;
    }
}

