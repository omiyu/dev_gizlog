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
        //　joinの記述
        // $sql = $this->join('tag_categories', function ($join) {
        //                 $join->on('questions.tag_category_id', '=', 'tag_categories.id')
        //                      ->where('questions.id', $id);
        //             })
        //             ->get();
        // dd($sql);

        if (empty($id)) {
            // $aa = $this->get();
            // dd($aa[1]->tagCategory);
            return $this->get();
            // return $this->get();
        }

        if($id) {
            // dd($sql->where('id', $id));
            return $this->where('id', $id)->get();
        }
        
    }

    public function getQuestionsByUserId($user_id)
    {
        // dd( $this->tagCategory );
        return $this->where('user_id', $user_id)->get();
    }


    
    
}

