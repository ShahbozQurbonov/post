<x-layouts.main>

    <x-slot:title>
        Post Yaratish
    </x-slot:title>

    <x-layouts.page-header>
        Yangi Post Yaratish
    </x-layouts.page-header>

    <div class="container py-5">
        <div class="w-50 py-4">
            <div class="contact-form">
                <div id="success"></div>
                <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
            </div>
            <div class="control-group mb-4">
                <input type="text" class="form-control mb-4" name="title" value="{{ old('title') }}"
                    placeholder="Sarlavha" />
                @error('title')
                    <p class="help-block text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="control-group mb-4">
                <label for="">kategoriya</label>
            <select name="category_id">
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
            </div>

            <div class="control-group mb-4">
                <label>taglar</label>
                <select name="tags[]" multiple>
                    @foreach ($tags as $tag)
                        <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                    @endforeach
                </select>
                </div>

            <div class="control-group mb-4">
                <input type="file" name="photo" class="form-control mb-4" id="subject" placeholder="Rasm" />
                @error('photo')
                    <p class="help-block text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="control-group mb-4">
                <textarea class="form-control mb-4" rows="3" name="short_content" placeholder="Qisqacha mazmuni">{{ old('short_content') }}</textarea>
                @error('short_content')
                    <p class="help-block text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="control-group mb-4">
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
