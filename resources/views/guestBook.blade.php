@extends('layouts.layout')

@section('title', 'Guest book')

@section('content')
    <div class="container">
        <link rel="stylesheet" type="text/css" href="{{asset('css/forms.css')}}"/>
        @include('partial.success')
        @include('partial.error')
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form name="form_guest_book" method="post" action="{{route('guestBook.store')}}">
                    @csrf
                    <div class="form-group">
                        <textarea id="message" name="message" class="form-control" rows=10 cols=50 placeholder="Текст сообщения" wrap="hard"></textarea>
                    </div>
                    <input type="submit" class="btn btn-primary">
                    <input type="reset" class="btn btn-secondary">
                </form>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-6">
                @foreach($messages as $message)
                    <article style="max-width: 600px;
                      max-height: max-content;
                      margin:10px auto;
                      padding: 10px;
                      text-align: left;
                      border: 1px solid white;
                      border-radius: 10px">
                        <p>{{$message->created_at}}</p>
                        <p>{{$message->user->login}}</p>
                        <p style="margin-top: 20px;word-break: break-word;line-height: 25px;">{{$message->message}}</p>
                    </article>
                @endforeach
                <div class="pagination">
                    {{$messages->links()}}
                </div>
            </div>
        </div>
    </div>
@endsection