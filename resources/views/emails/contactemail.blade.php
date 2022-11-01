<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <table>
        <tr>
        <td><b>Emetteur du message:</b></td>
        </tr>
        <tr>
        <td>Message envoyé par</td>
        </tr>  
        <tr>
        <td> - NOM: {{ $name }}</td>
        </tr>  
        <tr>
        <td> - Email: <i>{{ $email }}</i></td>
        </tr>
        <tr>
        <td><b>Contenu du message:</b></td>
        </tr>
        <tr>
        <td>{{ $bodyMessage }}</td>
        </tr>
        </table>
</body>

</html>