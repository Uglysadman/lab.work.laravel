@extends('layouts.admin')

@section('title', "Editor Blog Admin")

@section('content')
    <div class="container">
        <link rel="stylesheet" type="text/css" href="{{asset('css/forms.css')}}"/>
        @include('partial.success')
        @include('partial.error')
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form enctype="multipart/form-data" name="form_blog" method="post"
                      action="{{route('admin.editorBlog.store')}}">
                    @csrf
                    <div class="form-group">
                        <label class="custom-file-label" for="validatedCustomFile">Выберите файл изображения...</label>
                        <input type="file" class="custom-file-input form-control" name="img" id="validatedCustomFile">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="text" name="topic" id="topic" placeholder="Тема сообщения">
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" id="message" name="message" class="form-control" rows=5 placeholder="Текст сообщения" wrap="hard"></textarea>
                    </div>
                    <input class="btn btn-primary" type="submit">
                    <input class="btn btn-secondary" type="reset">
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if(count($posts))
                    @foreach($posts as $post)
                        <article class="content-blog" id="{{$post->id}}">
                            <div class="mb-3 d-inline-flex">
                                <button class="btn btn-primary change-post">Изменить</button>
                                <form method="post" action="{{route('admin.editorBlog.destroy',
                                ['id' => $post->id])}}">
                                    @csrf
                                    <input type="submit" value="Удалить" class="btn btn-danger ml-3">
                                </form>
                            </div>
                            <form enctype="multipart/form-data" method="POST" style="display:none"
                                  action="{{route('admin.editorBlog.update', ['id' => $post->id])}}">
                                @csrf
                                <div class="form-group">
                                    <input class="form-control" type="text" name="topic" id="topic" value="{{$post->topic}}" placeholder="Тема сообщения">
                                </div>
                                <div class="form-group">
                                    <textarea class="form-control" name="message" placeholder="Текст сообщения" required>{{$post->message}}</textarea>
                                </div>
                                <input type="submit" value="Сохранить" class="btn btn-primary">
                                <input type="reset" value="Очистить" class="btn btn-secondary">
                            </form>
                            <article class="content-note">
                                <img src="{{asset('img/'.$post->img)}}">
                                <div class="note-message">
                                    <p>{{$post->created_at}}</p>
                                    <p>{{$post->user->login}}</p>
                                    <p>{{$post->topic}}</p>
                                    <p style="margin-top: 30px;word-break: break-word;line-height: 25px;">{{$post->message}}</p>
                                </div>
                            </article>
                            @if(count($comments))
                                @foreach($comments as $comment)
                                    @if($comment->post_id == $post->id)
                                        <article class="comment-note">
                                            <div class="comment-message">
                                                <p>{{$comment->created_at}}</p>
                                                <p>{{$comment->author}}</p>
                                                <p style="margin-top: 30px;word-break: break-word;line-height: 25px;">{{$comment->text_comment}}</p>
                                            </div>
                                        </article>
                                    @endif
                                @endforeach
                            @endif
                        </article>
                    @endforeach
                @endif
                <div class="pagination">
                    {{$posts->links()}}
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{asset('js/Blog.js')}}"></script>
@endsection