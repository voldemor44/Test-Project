<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Message Nouveau Utilisateur</title>
</head>

<body>
    <h1>Compte utilisateur créé</h1>
    <h5> {{ $data['username'] }}, votre s'est effectué avec succès </h5>
    <span><a href="{{ $data['link'] }}">Cliquez ici accéder au site </a></span>
    <p>Token : {{ $data['token'] }}</p>
</body>

</html>
