<!doctype html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Nouveau message</title>
</head>
<body>

    <h1>Nouveau message de {{ $details['name'] }}</h1>
    <h2>Email du contact :  {{ $details['email'] }}</h2>

    <h3>
        Sujet du message: {{ $details['subject'] }}
    </h3>

    <p>
       Contenu du message :
    </p>

    <p>
        {{ $details['message'] }}
    </p>

</body>
</html>
