@extends ('common.user')
@section ('content')

<h1 class="brand-header">日報編集</h1>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['daily_report.update', $dailyReport->id], 'method' => 'PUT']) !!}
      <div class="form-group form-size-small">
        {!! Form::input('date', 'reporting_time', date('Y-m-d', strtotime($dailyReport->reporting_time)), ['class' => 'form-control']) !!}
      <span class="help-block"></span>
      </div>
      <div class="form-group">
        {!! Form::input('text', 'title', $dailyReport->title, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        @if ($errors->has('title'))
          <span class="help-block">
            @foreach ($errors->all() as $error)
              {{ $error }}
            @endforeach
          </span>
        @endif
      </div>
      <div class="form-group">
        {!! Form::textarea('content', $dailyReport->content, ['class' => 'form-control', 'placeholder' => $dailyReport->content, 'cols' => '50', 'rows' => '10']) !!}
        @if ($errors->has('content'))
          <span class="help-block">
            @foreach ($errors->all() as $error)
              {{ $error }}
            @endforeach
          </span>
        @endif
      </div>
      {!! Form::submit('Update', ['class' => 'btn btn-success pull-right']) !!}
    {!! Form::close() !!}
  </div>
</div>

@endsection

<!-- フォームタグの中身
<input class="form-control" name="user_id" type="hidden" value="4">
      <div class="form-group form-size-small">
        <input class="form-control" name="reporting_time" type="date">
      <span class="help-block"></span>
      </div>
      <div class="form-group">
        <input class="form-control" placeholder="Title" name="title" type="text">
      <span class="help-block"></span>
      </div>
      <div class="form-group">
        <textarea class="form-control" placeholder="本文" name="contents" cols="50" rows="10">本文</textarea>
      <span class="help-block"></span>
      </div>
      <button type="submit" class="btn btn-success pull-right">Update</button> -->