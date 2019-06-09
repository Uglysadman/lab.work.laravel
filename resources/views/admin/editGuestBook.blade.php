@extends('layouts.admin')

@section('title', "Edit Guest Admin")

@section('content')
    <div class="container">
    @include('partial.success')
    @include('partial.error')
        <link rel="stylesheet" type="text/css" href="{{asset('css/forms.css')}}"/>
        <div class="row justify-content-center">
            <div class="col-md-6">
                @foreach($messages as $message)
                    <div class="mb-4">
                        <div class="mb-3 d-inline-flex">
                            <button class="btn btn-primary change-message">Изменить</button>
                            <form method="post" action="{{route('admin.editGuestBook.destroy',
                                ['id' => $message->id])}}">
                                @csrf
                                <input type="submit" value="Удалить" class="btn btn-danger ml-2">
                            </form>
                        </div>
                        <form method="POST" style="display:none" action="{{route('admin.editGuestBook.update',
                                ['id' => $message->id])}}">
                            @csrf
                            <div class="form-group">
                                <textarea name="message" placeholder="Текст сообщения" required>{{$message->message}}</textarea>
                            </div>
                            <input type="submit" value="Сохранить" class="btn btn-primary">
                            <input type="reset" value="Очистить" class="btn btn-secondary">
                        </form>
                        <article style="width: 500px;
                                    max-height: max-content;
                                    margin-top: 10px;
                                    padding: 10px;
                                    display: block;
                                    text-align: left;
                                    border: 1px solid white;
                                    border-radius: 10px;">
                            <p>{{$message->created_at}}</p>
                            <p>{{$message->user->login}}</p>
                            <p style="margin-top: 20px;word-break: break-word;line-height: 25px;">{{$message->message}}</p>
                        </article>
                    </div>
                @endforeach
                <div class="pagination">
                    {{$messages->links()}}
                </div>
            </div>
        </div>
    </div>
<script type="text/javascript" src="/public/js/blog.js"></script>
@endsection
