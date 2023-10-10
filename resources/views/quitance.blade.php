<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <h3>Quitance d'achat de tickets</h3>
    @php
        $n = 0;
    @endphp
    @foreach ($all_tickets_infos as $infos_ticket)
        @php
            $n++;
        @endphp
        <div>
            <h4>ticket n° {{ $n }}</h4>
            <p><b>Nom de l'événement : </b> {{ $infos_ticket['nom_evenement'] }}</p>
            <p><b>Type du ticket : </b> {{ $infos_ticket['type_tiket'] }}</p>
            <p><b>Prix du type : </b> {{ $infos_ticket['prix_ticket'] }}</p>

            <h5>Code QR du ticket</h5>

            <div>
                {{ $infos_ticket['codeQR'] }}
            </div>
        </div>
    @endforeach

</body>

</html>
