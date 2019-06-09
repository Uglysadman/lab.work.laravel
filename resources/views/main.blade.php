@extends('layouts.layout')

@section('title', "Main")

@section('content')
<div id="content">
    <div id="info_panel">
        <img class="photo" src="{{asset('img/me.jpg')}}">
        <h1>
            @guest
                <span class="lg">Группа ИС/б-33о</span>
                <span class="lg">Кашкин Максим Иванович</span>
                <img class="ph" src="{{asset('img/html_css_js.png')}}">
            @else
                <span class="lg">Страница пользователя</span>
                <span class="lg">{{Auth::user()->login}}</span>
                <img class="ph" src="{{asset('img/html_css_js.png')}}">
            @endguest
        </h1>
    </div>
</div>
@endsection