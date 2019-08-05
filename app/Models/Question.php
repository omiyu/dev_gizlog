<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\TagCategory;
use App\Models\User;
use App\Models\Comment;

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

    public function comment()
    {
        return $this->hasMany(Comment::class, 'question_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function getQuestions($id)
    {
        if (empty($id)) {
            return $this->get();
        }

        if($id) {
            return $this->where('id', $id)->get();
        }
    }

    public function getQuestionsByUserId($user_id)
    {
        return $this->where('user_id', $user_id)->get();
    } 
}

