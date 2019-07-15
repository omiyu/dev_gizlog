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


    // public function validation($input)
    // {
    //     $validator = Validator::make($input, [
    //         'reporting_time' => 'required|date|max:255',
    //         'title' => 'required|string|max:255',
    //         'content'=> 'required|string|max:255',
    //     ])->validate();

    //     // if ($validator->fails()) {
    //     //     return redirect('/daily_report/create')
    //     //                 ->withErrors($validator);
    //     //                 // ->withInput();
    //     // }

    //     return $validator;
    // }
    
    public function index()
    {
        $daily_reports = $this->daily_report->getAll(Auth::id());
        // dd($daily_reports);
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
        $request->validate([
            'title' => 'bail|required|string|max:225',
            'content' => 'required|string|max:225',
        ]);
        $input = $request->all();
        // $validator = $this->validation($input);
        // $input["reporting_time"] = $validator["reporting_time"];
        // $input["title"] = $validator["title"];
        // $input["content"] = $validator["content"];
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
