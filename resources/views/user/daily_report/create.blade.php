@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
<div class="main-wrap">
  {!! Form::open(['route' => 'daily_report.store',  'method' => 'POST', 'class' => 'container']) !!}
    <div class="form-group form-size-small  ">
      {!! Form::input('date', 'reporting_time', date('Y-m-d'), ['class' => 'form-control']) !!}
      <span class="help-block"></span>
    </div>
    <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
      {!! Form::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
      <span class="help-block">
        {{ $errors->first('title') }}
      </span>
    </div>
    <div class="form-group {{ $errors->has('content') ? 'has-error' : '' }}">
      {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Content', 'cols' => '50', 'rows' => '10'])!!}  
      <span class="help-block">
        {{ $errors->first('content') }}
      </span>
    </div>
    {!! Form::submit('Add', ['class' => 'btn btn-success pull-right']) !!}
  {!! Form::close() !!}
</div>

@endsection

