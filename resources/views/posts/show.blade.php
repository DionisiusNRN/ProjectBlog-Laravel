<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Blog | Judul: {{ $posts->title }}</title>
    <link href="{{ asset('/bootstrap-5/css/bootstrap.min.css') }}" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="{{ asset('css/blog.css') }}" rel="stylesheet" crossorigin="anonymous">
    <script src="{{ asset('/bootstrap-5/js/bootstrap.bundle.min.js') }}" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container">
        <article class="blog-post">
            <h2 class="display-5 link-body-emphasis mb-1">{{ $posts->title }}</h2>
            <p class="blog-post-meta">{{ date('d M Y H:i', strtotime($posts->created_at)) }}</p>

            <p>{{ $posts->content }}</p>

            <small class="text-muted">{{ count($comments) }} Komentar</small>

            @foreach ($comments as $comment)
                <div class="card mb-3">
                    <div class="card-body">
                        <p style="font-size: 8pt">{{ $comment->comment }}</p>
                    </div>
                </div>
            @endforeach
          </article>
          <a href="{{ url("posts") }}">< Kembali</a>
    </div>
</body>
</html>
