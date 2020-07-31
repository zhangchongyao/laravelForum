@extends('layouts.app')

@section('content')

<div class="container">
  <div class="col-md-10 offset-md-1">
    <div class="card ">

      <div class="card-header">
        <h2 class="">
          @if($topic->id)
            编辑话题
          @else
            新建话题
          @endif
        </h2>
      </div>

      <div class="card-body">
        @if($topic->id)
          <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
          <input type="hidden" name="_method" value="PUT">
        @else
          <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
        @endif

          @include('shared._error')

          <input type="hidden" name="_token" value="{{ csrf_token() }}">


                <div class="form-group">
                	<label for="title-field">新建标题</label>
                	<input class="form-control" type="text" name="title" id="title-field" value="{{ old('title', $topic->title ) }}" placeholder="请输入标题"/>
                </div>

                <div class="form-group">
                    <select name="category_id" required>
                        <option value="" hidden disable selected>请选择分类</option>
                        @foreach($categories as $value)
                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                	<textarea name="body" id="editor" rows="6" placeholder="请输入内容" class="form-control" required>{{ old('body', $topic->body ) }}</textarea>
                </div>

          <div class="well well-sm">
            <button type="submit" class="btn btn-primary">保存</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection


@section('styles')
    <link rel="stylesheet" type="text/css" href="">
@stop


@section('scripts')
    <script type="text/javascript" src=""></script>

    <script>
    </script>
@stop
