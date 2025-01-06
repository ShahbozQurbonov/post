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
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
        </div>
        <div class="control-group">
            <input type="text" class="form-control mb-4" name="title" value="{{ old('title') }}"
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
            <textarea class="form-control mb-4" rows="3" name="short_content" placeholder="Qisqacha mazmuni">{{ old('short_content') }}</textarea>
            @error('short_content')
                <p class="help-block text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div class="control-group">
            <textarea class="form-control mb-4" rows="6" name="content" placeholder="Maqola">{{ old('content') }}</textarea>
            @error('content')
                <p class="help-block text-danger">{{ $message }}</p>
            @enderror
        </div>
        <div>
            <button class="btn btn-primary btn-block py-3 px-5" type="submit">Saqlash</button>
        </div>
        </form>
    </div>
</div>

</x-layouts.main>