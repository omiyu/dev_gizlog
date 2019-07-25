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
        return $this->where('user_id', $id)
            ->orderBy('reporting_time', 'desc')
            ->get();
    }

    public function getDailyReportsByDates($id, $date)
    {
        $carbonToGetDailyReports = new Carbon($date);
        return $this->where('user_id', $id)
            ->whereYear('reporting_time', $carbonToGetDailyReports->year)
            ->whereMonth('reporting_time', $carbonToGetDailyReports->month)
            ->orderBy('reporting_time', 'desc')
            ->get();
    }
}
