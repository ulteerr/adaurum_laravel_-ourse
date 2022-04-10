<h3><a href="{{rout('posts.show', ['post'=>$post->id])}}"></a></h3>
<div style="background-color: silver">{{$key}}.{{$post->title}}</div>
<div class="mb-3">
    <a href="{{rout('posts.edit', ['post'=>$post->id])}}" class="btn btn-primary">Edit</a>
    <form class="d-inline" action="{{route('posts.destroy', ['post'=>$post->id])}}" method="POST">
        @csrf
        @method("DELETE")
        <input type="submit" value="Delete!" class="btn btn-primary">
    </form>
</div>
