@extends('app')

@section('content')
    <div class="flex justify-center">
        <div class="w-8/12">        
            <div class="p-6 ">
                <h1 class="text-2xl font-medium mb-1">
                    {{ $user->name }}
                </h1>
            </div>
        </div>
    </div>

    <div class="flex justify-center">
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