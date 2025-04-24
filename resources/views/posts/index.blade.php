@extends('layouts.main')

@section('title', 'Post List')


@section('content')
<table class="table">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Body</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <th scope="row">{{ $post['id'] }}</th>
            <td>
                <a href="{{route('posts.show', ['id' => $post['id']]) }}">
                    {{ substr($post['title'], 0, 30) . "...." }}
                </a>
            </td>
            <td>{{ substr($post['body'], 0, 50) . "...." }}</td>
            <td>
                @if (auth()->check() && $post->user_id === auth()->id())
                    <a class="btn btn-info" href="{{ route('posts.edit', ['id' => $post['id']]) }}">Edit</a>
                    <form class="form-inline d-inline" action="{{ route('posts.destroy', ['id' => $post['id']]) }}" method="POST">
                        @csrf
                        @method("DELETE")
                        <button type="submit" class="btn btn-danger mb-2">Delete</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection


@section('footer')
<p>Footer all rights reserved</p>
@endsection
