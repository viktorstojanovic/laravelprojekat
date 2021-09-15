@extends('app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12 bg-white p-6 rounded-lg">
            <form action="{{ route('posts') }}" method="post">
                @csrf
                <div class="mb-4">
                    <label for="body" class="sr-only">Body</label>
                    <textarea name="body" id="body" cols="30" rows="4" 
                    class="bg-gra-100 border-2 w-full p-4 rounded-lg
                    @error('body') border-red-500 @enderror" placeholder="Post something!"></textarea>
                
                    @error('body')
                        <div class="text-red-500 mt-2 text-sm">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Post
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="flex justify-center p-2">
        <div class="w-8/12 bg-white p-6 rounded-lg">         
            @if ($posts->count())
                @foreach ($posts as $post)
                    <div class="mb-4 p-2">
                        <a href="{{ route('users.posts', $post->user) }}" class="font-bold">{{ $post->user->name }}</a> <span class="text-gray-600 text-sm">{{ $post->created_at->diffForHumans() }}</span>
                        
                        <p class="mb-2">{{ $post->body }}</p>
                        
                        @auth
                        @if ($post->ownedBy(auth()->user()))
                            <div>
                                <form action="{{ route('posts.destroy', $post) }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-400 hover:bg-red-600 p-1 text-white rounded-full">
                                        Delete   
                                    </button>
                                </form>
                            </div>
                        @endif
                        @endauth

                    </div>
                @endforeach

                {{ $posts->links() }}
            @else
                <p>There are no posts</p>
            @endif
        </div>
    </div>

@endsection