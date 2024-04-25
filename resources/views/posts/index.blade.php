<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Posts</title>
</head>
<body>
    <h1>Post Something</h1>
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <input type="text" name="title" placeholder="Title" required><br>
        <textarea name="content" placeholder="Content" required></textarea><br>
        <button type="submit">Submit</button>
    </form>
    <hr>
    @foreach ($posts as $post)
        <h2>{{ $post->title }}</h2>
        <p>{{ $post->content }}</p>
    @endforeach
</body>
</html>
