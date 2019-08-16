@extends ('common.user')
@section ('content')

<h2 class="brand-header">質問投稿</h2>
<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => 'question.confirm', 'method' => 'POST']) !!}
      <div class="form-group">
        {!! Form::select('tag_category_id', $arrayCategoriesName, null, ['placeholder' => 'Select category', 'class' => 'form-control selectpicker form-size-small', 'id' => 'pref_id']) !!}
        <span class="help-block">{{ $errors->first('tag_category_id') }}</span>
      </div>
      <div class="form-group">
        {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group">
        {!! Form::textarea('content', null, ['class' => 'form-control', 'placeholder' => 'Please write down your question here...', 'cols' => '50', 'rows' => '10']) !!}
        <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      <input name="confirm" class="btn btn-success pull-right" type="submit" value="create">
    {!! Form::close() !!}
  </div>
</div>

@endsection