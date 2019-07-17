<?php

namespace App\Http\Controllers\User;

use App\Models\DailyReport;
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

    private $dailyReport;

    public function __construct(DailyReport $instanceClass)
    {
        $this->middleware('auth');
        $this->dailyReport = $instanceClass;
    }


    
    public function index(Request $request)
    {
        $input = $request->all();
        if(empty($input)){
            $dailyReports = $this->dailyReport->getAll(Auth::id());
        } else {
            $dailyReports = $this->dailyReport->getByMonth(Auth::id(), $input['search-month']);
        }
        return view('user.daily_report.index', compact('dailyReports'));
    }

    /**
     * Show the form for creating a new resource.
     *s
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('user.daily_report.create');
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
            'title' => 'required|string|max:50',
            'content' => 'required|string|max:1500',
        ]);
        $input = $request->all();
        $input['user_id'] = Auth::id();
        $this->dailyReport->fill($input)->save();
        return redirect()->route('daily_report.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\DailyReport  $dailyReport
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dailyReport = $this->dailyReport->find($id);
        return view('user.daily_report.show', compact('dailyReport'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\DailyReport  $dailyReport
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dailyReport = $this->dailyReport->find($id);
        return view('user.daily_report.edit', compact('dailyReport'));
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
            'title' => 'required|string|max:50',
            'content' => 'required|string|max:1500',
        ]);
        $input = $request->all();
        // $input['user_id'] = Auth::id();
        $this->dailyReport->find($id)->fill($input)->save();
        return redirect()->route('daily_report.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\DailyReport  $dailyReport
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->dailyReport->find($id)->delete();
        return redirect()->route('daily_report.index');
    }


}
