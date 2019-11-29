@extends('layouts.app')

@section('content')
    <h1>Список статей</h1>
    @foreach($articles as $article)
        <a href="{{route('articles.show', ['id' => $article->id])}}">{{$article->name}}</a>
        <a href="{{ route('articles.edit', ['id' => $article->id]) }}">Edit</a>
        <a href="{{ route('articles.destroy', ['id' => $article->id]) }}" data-method="delete" rel="nofollow">Delete</a>
        {{-- Str::limit – функция-хелпер, которая обрезает текст до указанной длины --}}
        {{-- Используется для очень длинных текстов, которые нужно сократить --}}
        <div>{{Str::limit($article->body, 200)}}</div>
    @endforeach
    <a href="{{ route('articles.create') }}">Create</a>
@endsection
