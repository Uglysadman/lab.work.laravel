@extends('layouts.layout')

@section('title', "Blog")

@section('content')
    <link rel="stylesheet" type="text/css" href="{{asset('css/forms.css')}}"/>
    <div id="form_panel">
        @foreach($posts as $post)
            <article class="content-blog" id="{{$post->id}}">
                <article class="content-note">
                    <img src="{{asset('img/'.$post->img)}}">
                    <div class="note-message">
                        <p>{{$post->created_at}}</p>
                        <p>{{$post->topic}}</p>
                        <p style="margin-top: 30px;word-break: break-word;line-height: 25px;">{{$post->message}}</p>
                    </div>
                </article>
                @if(count($comments))
                    @guest

                    @else
                        <div>
                            <button class="btn commenting">Добавить комментарий</button></div>
                        <form method="POST" style="display:none">
                            <textarea name="text_comment" placeholder="Текст комментария" required></textarea>
                            <input type="text" name="note_id" value="'. $note['id'] .'" style="display:none">
                            <input type="button" name="send-comment" value="Отправить" class="btn send-comment">
                            <input type="reset" value="Очистить" class="btn">
                        </form>
                    @endguest
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
        <div class="pagination-lg">
            {{$posts->links()}}
        </div>
    </div>
@endsection