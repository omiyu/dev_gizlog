<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class DailyReport extends Model
{
    use SoftDeletes;

    /**
     * 日付へキャストする属性
     * @var array
     */
    protected $dates = ['reporting_time'];

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'reporting_time',
    ];

    public function getDailyReportsByUserID($id)
    {
        return $this->where('user_id', $id)->get();
    }

    public function getDailyReportsByDates($id, $keyword)
    {
        $carbonToGetDailyReports = new Carbon($keyword);
        $year = (string) $carbonToGetDailyReports->year;
        $month = (string) $carbonToGetDailyReports->month;
        return $this->where('user_id', $id)->whereYear('reporting_time', $year)->whereMonth('reporting_time', $month)->get();
        // return $this->where('user_id', $id)->where('reporting_time', 'LIKE', $keyword.'%')->get();
    }
}
