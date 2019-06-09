@extends('layouts.admin')

@section('title', "Main Admin")

@section('content')
    <div id="content">
        <div id="info_panel">
            <img class="photo" src="{{asset('img/me.jpg')}}">
            <h1>
                <span class="lg">Страница администратора</span>
                <span class="lg">{{Auth::user()->login}}</span>
                <img class="ph" src="{{asset('img/html_css_js.png')}}">
            </h1>
        </div>
    </div>
@endsection