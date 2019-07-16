@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報一覧</h2>
<div class="main-wrap">
  <div class="btn-wrapper daily-report">
    {!! Form::open(['action' => 'DailyReportController@search', 'method' => 'GET']) !!}
      <input class="form-control" name="search-month" type="month">
      <button type="submit" class="btn btn-icon"><i class="fa fa-search"></i></button>
    {!! Form::close() !!}
    <a class="btn btn-icon" href="{{ route('daily_report.create') }} "><i class="fa fa-plus"></i></a>
  </div>
  <div class="content-wrapper table-responsive">
    <table class="table table-striped">
      <thead>
        <tr class="row">
          <th class="col-xs-2">Date</th>
          <th class="col-xs-3">Title</th>
          <th class="col-xs-5">Content</th>
          <th class="col-xs-2"></th>
        </tr>
      </thead>
      <tbody>
        @foreach ($daily_reports as $daily_report)
          <tr class="row">
            <td class="col-xs-2">{{ date('m/d (D)', strtotime($daily_report->reporting_time)) }}</td>
            <td class="col-xs-3">{{ $daily_report->title }}</td>
            <td class="col-xs-5">{{ $daily_report->content }}</td>
            <td class="col-xs-2"><a class="btn" href="{{ route('daily_report.show', ['daily_report' => $daily_report->id]) }}"><i class="fa fa-book"></i></a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>

@endsection

