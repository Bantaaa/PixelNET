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

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4" id="data">
           
        </div>
    </div>

    <script>
        let user = [];
        let afficher = document.getElementById('data');
        console.log(data)
        fetch('http://127.0.0.1:8000/pstman')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                usre = data.user;

                usre.forEach(element => {
                    console.log(element.id);
                    afficher.innerHTML += `
                    <div class="bg-white p-6 rounded-lg shadow-md" >
                    <p class="text-gray-700 text-lg">Nom d'utilisateur: ${element.name}</p>
                    <p class="text-gray-700 text-lg">Email: ${element.email}</p>
                    <div class="mt-8">
                        <a href="/message/${element.id}"
                            class="inline-block bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">Voir
                            les Messages</a>
                    </div>
                </div>
        </div>
    </div>
                    `

                });
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    </script>

</body>

</html>
