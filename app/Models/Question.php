<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TagCategory;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\DB;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'tag_category_id',
        'title',
        'content',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function tagCategory()
    {
        return $this->belongsTo(TagCategory::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getQuestionByQuestionId($id)
    {
        return $this->find($id);
    }

    public function getQuestionsByUserId($user_id)
    {
        return $this->where('user_id', $user_id)
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

    public function getSearchingQuestions($categoryId, $word)
    {
        return $this->searchQuestionsByCategoryId($categoryId)
                    ->searchQuestionsByKeyword($word)
                    ->orderBy('created_at', 'desc')
                    ->get();
    }

    public function scopeSearchQuestionsByCategoryId($query, $categoryId)
    {
        if (isset($categoryId) && $categoryId != 0) {
            return $query->where('tag_category_id', $categoryId);
        }
    }

    public function scopeSearchQuestionsByKeyword($query, $word)
    {
        if (isset($word)) {
            return $query->where('title', 'like', '%' . $word . '%');
        }
    }
}

