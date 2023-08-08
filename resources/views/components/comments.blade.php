<div>
    @foreach ($post->comments as $comment)
        <div>
            <small> {{ comment->user->name }}</small>
            <p>{{ $comments->content }}</p>
        </div>
    @endforeach
    {{ $post->comments }}
</div>
