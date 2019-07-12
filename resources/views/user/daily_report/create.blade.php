@extends ('common.user')
@section ('content')

<h2 class="brand-header">日報作成</h2>
<div class="main-wrap">
  {!! Form::open(['route' => 'daily_report.store',  'method' => 'POST', 'class' => 'container']) !!}
    {!! Form::input('hidden', 'user_id', null, ['class' => 'form-control']) !!}
      <div class="form-group form-size-small">
    {!! Form::input('date', 'reporting_time', date('Y-m-j'), ['class' => 'form-control']) !!}
    <span class="help-block"></span>
    </div>
    <div class="form-group">
    {!! Form::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
      @if ($errors->any())
        <span class="help-block">
          @foreach ($errors->all() as $error)
            {{ $error }}
          @endforeach
        </span>
      @endif
    </div>
    <div class="form-group">
      {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Content', 'cols' => '50', 'rows' => '10'])!!}
      @if ($errors->any())
        <span class="help-block">
          @foreach ($errors->all() as $error)
            {{ $error }}
          @endforeach
        </span>
      @endif
    </div>
    {!! Form::submit('Add', ['class' => 'btn btn-success pull-right']) !!}
  {!! Form::close() !!}
</div>

@endsection

