<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Messages</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="flex justify-center items-center h-screen">
    <div class="w-full max-w-md p-8 bg-white rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-8">Boîte de réception</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    @foreach($messages as $message)
        <div class="bg-white p-6 rounded-lg shadow-md mb-4">
            <p class="text-gray-700 text-lg">{{ $message->content }}</p>
            <div class="mt-4 flex justify-between items-center">
                <span class="text-gray-500">{{ $message->created_at->diffForHumans() }}</span>
                <span class="text-blue-500">Envoyé par : {{ $message->sender }}</span>
            </div>
        </div>
    @endforeach
</div>
    
       
        <div class="mt-8">
            <h2 class="text-xl font-semibold mb-4">Ajouter un nouveau message</h2>
            <form action="{{ route('store') }}" method="POST">
                @csrf
                <input type="hidden" name="receiver_id" >
                <textarea name="content" id="content" class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500" placeholder="Votre message..." rows="4"></textarea>
                <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Envoyer</button>
            </form>
        </div>
   
    
    </div>
    
</body>
</html>
