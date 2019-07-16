<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyReport extends Model
{
    use SoftDeletes;
    /**
     * 日付へキャストする属性
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'reporting_time',
    ];

    public function getAll($id)
    {
        return $this->where('user_id', $id)->where('deleted_at', null)->get();
    }

    public function getByMonth($id, $keyword)
    {
        return $this->where('user_id', $id)->where('deleted_at', null)->where('reporting_time', 'LIKE', "%$keyword%")->get();
    }
}
