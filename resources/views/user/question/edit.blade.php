@extends ('common.user')
@section ('content')

<h1 class="brand-header">質問編集</h1>

<div class="main-wrap">
  <div class="container">
    {!! Form::open(['route' => ['question.update', $question[0]->id], 'method' => 'PUT']) !!}
      <div class="form-group">
        <select name='tag_category_id' class = "form-control selectpicker form-size-small" id ="pref_id">
          <option value="{{ $question[0]->tagCategory->id }}">{{ $question[0]->tagCategory->name }}</option>
            @foreach ($categories as $categoryId => $categoryName)
              @if ($categoryId !== $question[0]->tagCategory->id) {
                <option value= "{{ $categoryId }}">{{ $categoryName }}</option>
              }
              @endif
            @endforeach
        </select>
        <span class="help-block">{{ $errors->first('tag_category_id') }}</span>
      </div>
      <div class="form-group">
        {!! Form::input('text', 'title', $question[0]->title, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        <span class="help-block">{{ $errors->first('title') }}</span>
      </div>
      <div class="form-group">
        <textarea class="form-control" placeholder="Please write down your question here..." name="content" cols="50" rows="10">{{ $question[0]->content }}</textarea>
        <span class="help-block">{{ $errors->first('content') }}</span>
      </div>
      <input name="confirm" class="btn btn-success pull-right" type="submit" value="update">
    {!! Form::close() !!}
  </div>
</div>

@endsection

