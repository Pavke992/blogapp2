<div class='mt-5'>
    <form action="{{ url('createpost') }}" method="POST">
        @csrf
        <h1>Post Your comment</h1>
        <div class="mb-3">

            <textarea class="form-control" type="text" name="content" placeholder="Enter your comment" required />
            <input type="hidden" value="post_id">
        </div>
        <button type="submit" class="btn btn-primary">Create Comment</button>
    </form>

    @include('components.errors')
    @include('components.status')
</div>
