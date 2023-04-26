<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <title>@yield('title')</title>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
<body class="max-w-2xl py-5 mx-auto">
    <main>
        @if(session()->has('fileName'))
            <div class="flex flex-col items-center mb-5">
                <div>
                    {{ session()->get('fileName')}}
                </div>
            @foreach(session()->get('message') as $message)
                <div>
                    {{ $message }}
                </div>
            @endforeach
            </div>
        @endif
        <form action="{{ route('upload') }}" method="POST" enctype="multipart/form-data" class="relative border">
            @csrf
            <div class="flex flex-col">
                <label for="avatar">Avatar</label>
                <input type="file" name="avatar" id="avatar" class="p-2 border border-gray-400 rounded" />
            </div>
                <button type="submit" class="absolute right-0 px-3 py-2 text-white bg-blue-500 rounded hover:bg-blue-700 hover:border-gray-700 top-6">Upload</button>
        </form>
    </main>
</body>
</html>