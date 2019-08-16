@extends ('common.user')
@section ('content')

<h2 class="brand-header">投稿内容確認</h2>
<div class="main-wrap">
  <div class="panel panel-success">
    <div class="panel-heading">
      {{ $inputs['tag_category_name'] }}の質問
    </div>
    <div class="table-responsive">
      <table class="table table-striped table-bordered">
        <tbody>
          <tr>
            <th class="table-column">Title</th>
            <td class="td-text">{{ $inputs['title'] }}</td>
          </tr>
          <tr>
            <th class="table-column">Question</th>
            <td class='td-text'>{!! nl2br(e($inputs['content'])) !!}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
  <div class="btn-bottom-wrapper">
    {!! Form::open(['route' => $route, 'method' => $method]) !!}
      {!! Form::input('hidden', 'tag_category_id', $inputs['tag_category_id']) !!}
      {!! Form::input('hidden', 'title', $inputs['title']) !!}
      {!! Form::input('hidden', 'content', $inputs['content']) !!}
      <button type="submit" class="btn btn-success"><i class="fa fa-check" aria-hidden="true"></i></button>
    {!! Form::close() !!}
  </div>
</div>

@endsection

