@extends('layouts.layout')

@section('title', "Blog")

@section('content')
    <div class="container">
        <link rel="stylesheet" type="text/css" href="{{asset('css/forms.css')}}"/>
        @include('partial.success')
        @include('partial.error')
        <div class="row justify-content-center">
            <div class="col-md-6">
                @if(count($posts))
                    @foreach($posts as $post)
                        <article class="content-blog" id="{{$post->id}}">
                            <article class="content-note">
                                <img src="{{asset('img/'.$post->img)}}">
                                <div class="note-message">
                                    <p>{{$post->created_at}}</p>
                                    <p>{{$post->user->login}}</p>
                                    <p>{{$post->topic}}</p>
                                    <p style="margin-top: 30px;word-break: break-word;line-height: 25px;">{{$post->message}}</p>
                                </div>
                            </article>
                            @guest

                            @else
                                <div class="mb-3">
                                    <p class="text-uppercase">Комментарии</p>
                                    <button class="btn btn-primary add-comment">Добавить комментарий</button>
                                </div>
                                <form method="post" style="display: none"
                                      action="{{route('blog.add_comment', ['post_id' => $post->id])}}">
                                    @csrf
                                    <textarea id="text_comment" name="text_comment" class="form-control mb-3" rows=5 placeholder="Комментарий" wrap="hard"></textarea>
                                    <input type="submit" value="Отправить" class="btn btn-primary">
                                </form>
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
                            @endguest
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