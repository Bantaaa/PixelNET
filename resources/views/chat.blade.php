<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>YouConnect</title>
    <meta name="description" content="Platform that connects users">
    <meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,store template, shop layout, minimal, monochrome, minimalistic, theme, nordic">

    <link rel="stylesheet" href="https://unpkg.com/tailwindcss@2.2.19/dist/tailwind.min.css" />

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:200,400&display=swap" rel="stylesheet">

</head>

<body>
    <!-- Main layout -->
    <div class="flex h-screen antialiased text-gray-800">
        <!-- Sidebar -->
        <div class="flex flex-row h-full w-full overflow-x-hidden">
            <div class="flex flex-col py-8 pl-6 pr-2 w-64 bg-white flex-shrink-0">
                <!-- Sidebar content -->
                <!-- User details -->
                <div class="flex flex-row items-center justify-center h-12 w-full">
                    <!-- User avatar -->
                    <a href="{{ route('home') }}" class="flex items-center justify-center rounded-2xl text-indigo-700 bg-indigo-100 h-10 w-10">
                        <!-- Avatar icon -->
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                        </svg>
                    </a>
                    <!-- User name -->
                    <a href="{{ route('home') }}" class="ml-2 font-bold text-2xl">YouConnect</a>
                </div>
                <!-- User profile -->
                <div class="flex flex-col items-center bg-indigo-100 border border-gray-200 mt-4 w-full py-6 px-4 rounded-lg">
                    <div class="h-20 w-20 rounded-full border overflow-hidden">
                        <!-- User avatar -->
                        <img src="{{ asset('images/2919906.png') }}" alt="Avatar" class="h-full w-full" />
                    </div>
                    <!-- User details -->
                    <div class="text-sm font-semibold mt-2">{{$follower->user->Fname}}</div>
                    <div class="text-xs text-gray-500">
                        Lead UI/UX Designer
                    </div>
                    <div class="flex flex-row items-center mt-3">
                        <div class="flex flex-col justify-center h-4 w-8 bg-indigo-500 rounded-full">
                            <div class="h-3 w-3 bg-white rounded-full self-end mr-1"></div>
                        </div>
                        <div class="leading-none ml-1 text-xs">Active</div>
                    </div>
                </div>
                <!-- Active conversations -->
                <div class="flex flex-col mt-8">
                    <!-- Active conversations title -->
                    <div class="flex flex-row items-center justify-between text-xs">
                        <span class="font-bold">Active Conversations</span>
                        <span class="flex items-center justify-center bg-gray-300 h-4 w-4 rounded-full">{{ $followers->count()}}</span>
                    </div>
                    <!-- List of active conversations -->
                    <div class="flex flex-col space-y-1 mt-4 -mx-2 h-48 overflow-y-auto">
                        @foreach($followers as $follower)
                        <!-- Active conversation items -->
                        <!-- Example conversation item -->
                        <form action="{{ route('chat', ['id' => $follower->user->id]) }}" method="GET">
                            <button type="submit" class="flex flex-row items-center hover:bg-gray-100 rounded-xl p-2">
                                <div class="flex items-center justify-center h-8 w-8 bg-indigo-200 rounded-full">
                                    <img src="{{ asset('images/2919906.png') }}" alt="">
                                </div>
                                <div class="ml-2 text-sm font-semibold">
                                    {{ $follower->user->Fname }}
                                </div>
                            </button>
                        </form>
                        <!-- More conversation items -->
                        @endforeach
                    </div>
                    <!-- Archived conversations -->
                    <!-- Similar structure as active conversations -->
                </div>
            </div>
            <!-- Main content -->
            <div class="flex flex-col flex-auto h-full p-6">
                <!-- Chat interface -->
                <!-- Messages -->
                <div class="flex flex-col flex-auto flex-shrink-0 rounded-2xl bg-gray-100 h-full p-4">
                    <!-- Message container -->
                    <div class="flex flex-col h-full overflow-x-auto mb-4">
                        <!-- Messages -->
                        <div class="flex flex-col h-full">
                            <!-- Individual messages -->
                            <div class="grid grid-cols-12 gap-y-2">
                                <!-- Sender's messages -->
                                <!-- <div class="col-start-7 col-span-6 p-3 rounded-lg bg-indigo-500 text-white">
                    <p>mamak</p>
                </div>
                <div class="col-start-1 col-span-6 p-3 rounded-lg bg-white border border-gray-200">
                    <p>mok</p>
                </div> -->
                                @foreach ($sent_messages as $smessage)
                                <div class="col-start-7 col-span-6 p-3 rounded-lg bg-indigo-500 text-white">
                                    <p>{{ $smessage->content }}</p>
                                </div>
                                @endforeach

                                <!-- Receiver's messages -->
                                @foreach ($received_messages as $rmessage)
                                <div class="col-start-1 col-span-6 p-3 rounded-lg bg-white border border-gray-200">
                                    <p>{{ $rmessage->content }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!-- Message input area -->
                    <form action="{{ route('msg') }}" method="POST">
                        @csrf
                    <div class="flex flex-row items-center h-16 rounded-xl bg-white w-full px-4">
                        <!-- Attachment button -->
                        <button class="flex items-center justify-center h-10 w-10 rounded-full bg-gray-200 hover:bg-gray-300">
                            <svg class="w-6 h-6 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                        </button>
                        <!-- Input field -->
                        <input type="hidden" name="receiver_id" class="flex-grow h-full px-4 ml-4 border rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Type your message..." />

                        <input type="text" name="content" class="flex-grow h-full px-4 ml-4 border rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500" placeholder="Type your message..." />
                        <!-- Send button -->
                        <button type="submit" class="flex items-center justify-center h-10 w-10 rounded-full bg-indigo-500 hover:bg-indigo-600 text-white">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>