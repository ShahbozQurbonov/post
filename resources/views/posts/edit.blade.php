<x-layouts.main>
<x-slot:title>
    Postni o'zgertirish #{{$post->id}}
</x-slot:title>
<x-layouts.page-header>
    Postni o'zgertirish #{{$post->id}}
</x-layouts.page-header>


<div class="container py-5">
    <div class="w-50 py-4">
        <div class="contact-form">
            <div id="success"></div>
            <form action="{{ route('posts.update',['post'=>$post->id]) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
        </div>
        <div class="control-group">
            <input type="text" class="form-control mb-4" name="title" value="{{ $post->title}}"
                placeholder="Sarlavha" />
            @error('title')
                <p class="help-block text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="control-group">
            <input type="file" name="photo" class="form-control mb-4" id="subject" placeholder="Rasm" />
            @error('photo')
                <p class="help-block text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="control-group">
            <textarea class="form-control mb-4" rows="3" name="short_content" placeholder="Qisqacha mazmuni">{{$post->short_content}}</textarea>
            @error('short_content')
                <p class="help-block text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="control-group">
            <textarea class="form-control mb-4" rows="6" name="content" placeholder="Maqola">{{ $post->content}}</textarea>
            @error('content')
                <p class="help-block text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="flex">
            <button class="btn btn-success py-3 px-5" type="submit">Saqlash</button>
            <a href="{{route('posts.show',['post'=>$post->id])}}" class="btn btn-danger py-3 px-5">Bekor qilish</a>
        </div>
        </form>
    </div>
</div>

</x-layouts.main>