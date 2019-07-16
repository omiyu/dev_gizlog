<?php

namespace App\Http\Controllers;

use App\DailyReport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use App\Http\Controllers\Controller;
use Validator;
use Carbon\Carbon;

class DailyReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $daily_report;


    public function __construct(DailyReport $instanceClass)
    {
        $this->middleware('auth');
        $this->daily_report = $instanceClass;
    }


    
    public function index(Request $request)
    {
        $input = $request->all();
        if( empty($input) ){
            $daily_reports = $this->daily_report->getAll(Auth::id());
        } else {
            $daily_reports = $this->daily_report->getByMonth(Auth::id(), $input["search-month"]);
        }
        return view("user.daily_report.index", compact("daily_reports"));
    }

    /**
     * Show the form for creating a new resource.
     *s
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view("user.daily_report.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $aa = $request->validate([
            'title' => 'bail|required|string|max:225',
            'content' => 'required|string|max:225',
        ]);
        $input = $request->all();
        $input["user_id"] = Auth::id();
        $this->daily_report->fill($input)->save();
        return redirect()->route("daily_report.index"); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DailyReport  $dailyReport
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $daily_report = $this->daily_report->find($id);
        return view("user.daily_report.show", compact('daily_report'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DailyReport  $dailyReport
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $daily_report = $this->daily_report->find($id);
        return view("user.daily_report.edit", compact('daily_report'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\DailyReport  $dailyReport
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'bail|required|string|max:225',
            'content' => 'required|string|max:225',
        ]);
        $input = $request->all();
        // $input["user_id"] = Auth::id();
        $this->daily_report->find($id)->fill($input)->save();
        return redirect()->route("daily_report.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DailyReport  $dailyReport
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->daily_report->find($id)->delete();
        return redirect()->route("daily_report.index");
    }


}
