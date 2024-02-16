@extends('includes.layout')

@section('content')


    <div class="container mx-auto flex flex-wrap py-6">

        <!-- Posts Section -->
        <section class="w-full md:w-2/3 flex flex-col items-center px-3">
          @foreach ($post as $item)
          <article class="flex flex-col shadow my-4">
            <!-- Article Image -->
            <a href="#" class="hover:opacity-75">
              <img src="/images/{{$item->image}}">
            </a>
            <div class="bg-white flex flex-col justify-start p-6">
              <a href="#" class="pb-6">{{$item->content}}</a>
              <div class="flex items-center justify-between">
                <button class="flex items-center gap-1 text-gray-800 hover:text-black">
                  <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                    <path d="M12 21.35l-1.45-1.32C6.11 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-4.11 6.86-8.55 11.54L12 21.35z" />
                  </svg>
                  <form action="{{ route('post.like', ['id' => $item->id]) }}" method="POST">
                    @csrf
                    <button type="submit">Like</button>
                </form>
                </button>
                <a href="#" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
              </div>
              <div class="mt-4">
                <h2 class="text-lg font-bold mb-2">Comments</h2>

                <form action="{{ route('post.commente', ['id' => $item->id]) }}" method="POST">
                  @csrf
                  <input type="text" name="content" placeholder="add commints">
                  <button type="submit">add Comment</button>
              </form>
                <div class="p-4 bg-gray-100 rounded">
                  <div class="flex items-start space-x-4">
                    <img src="https://placekitten.com/40/40" alt="User Avatar" class="w-8 h-8 rounded-full">
                    <div>
                        <p class="font-semibold">John Doe</p>
                        <p class="text-sm">This is a great article! Thanks for sharing.</p>
                    </div>
                </div>
                <div class="flex items-start mt-4 space-x-4">
                    <img src="{{ asset('images/2919906.png') }}" alt="User Avatar" class="w-8 h-8 rounded-full">
                    <div>
                        <p class="font-semibold">Jane Smith</p>
                        <p class="text-sm">I found this very informative. Keep up the good work!</p>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                <h2 class="text-lg font-bold mb-2">Add a Comment</h2>
                <div class="flex items-start space-x-4">
                    <img src="{{ asset('images/2919906.png') }}" alt="User Avatar" class="w-8 h-8 rounded-full">
                    <div class="flex flex-col w-full">
                      <input type="text" class="border rounded w-full focus:outline-none focus:ring-2 focus:ring-blue-500 p-2" placeholder="Write your comment">
                      <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 mt-2 rounded">Post Comment</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>
          @endforeach

          <div class="d-flex justify-content-center mt-3">
            {{ $post->links() }}
        </div>
    
            
            <!-- Pagination -->
            <div class="flex items-center py-8">
                <a href="#" class="h-10 w-10 bg-blue-800 hover:bg-blue-600 font-semibold text-white text-sm flex items-center justify-center">1</a>
                <a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:bg-blue-600 hover:text-white text-sm flex items-center justify-center">2</a>
                <a href="#" class="h-10 w-10 font-semibold text-gray-800 hover:text-gray-900 text-sm flex items-center justify-center ml-3">Next <i class="fas fa-arrow-right ml-2"></i></a>
            </div>

        </section>

        <!-- Sidebar Section -->
        <aside class="w-full md:w-1/3 flex flex-col items-center px-3">

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">About Us</p>
                <p class="pb-2">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis est eu odio sagittis tristique. Vestibulum ut finibus leo. In hac habitasse platea dictumst.</p>
                <a href="#" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-4">
                    Get to know us
                </a>
            </div>

            <div class="w-full bg-white shadow flex flex-col my-4 p-6">
                <p class="text-xl font-semibold pb-5">Clubs</p>
                <div class="grid grid-cols-3 gap-3">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=1">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=2">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=3">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=4">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=5">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=6">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=7">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=8">
                    <img class="hover:opacity-75" src="https://source.unsplash.com/collection/1346951/150x150?sig=9">
                </div>
                <a href="#" class="w-full bg-blue-800 text-white font-bold text-sm uppercase rounded hover:bg-blue-700 flex items-center justify-center px-2 py-3 mt-6">
                    <i class="fab fa-instagram mr-2"></i> Follow BDE-Office
                </a>
            </div>

        </aside>

    </div>
    @endsection

    