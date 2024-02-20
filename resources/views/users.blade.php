<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Liste des Utilisateurs</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100">

    <div class="container mx-auto py-8">
        <h1 class="text-3xl font-bold mb-8">Liste des Utilisateurs</h1>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach ($users as $user)
                <div class="bg-white p-6 rounded-lg shadow-md" id="user_{{ $user->id }}">
                    <p class="text-gray-700 text-lg">Nom d'utilisateur: {{ $user->username }}</p>
                    <p class="text-gray-700 text-lg">Email: {{ $user->email }}</p>
                    <div class="mt-8">
                        <a href="{{ route('index1', ['id' => $user->id]) }}"
                            class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Voir
                            les Messages</a>
                        
                        @php
                            $is_followed = false;
                            foreach ($follws as $folo) {
                                if ($folo->user_id == $user->id) {
                                    $is_followed = true;
                                    break;
                                }
                            }
                        @endphp
                        
                        @if ($is_followed)
                            <form action="{{ route('unfollow', ['id' => $user->id]) }}" method="POST"
                                class="inline-block ml-2">
                                @csrf
                                <button type="submit"
                                    class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600 focus:outline-none focus:bg-red-600">Ne
                                    plus suivre</button>
                            </form>
                        @else
                            <form action="{{ route('follow') }}" method="POST" class="inline-block ml-2">
                                @csrf
                                <input type="hidden" value="{{ $user->id }}" name="follower_id">
                                <button type="submit"
                                    class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600 focus:outline-none focus:bg-green-600">Suivre</button>
                            </form>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

</body>

</html>
