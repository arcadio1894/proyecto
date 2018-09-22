<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link rel="stylesheet" href="">
</head>
<body>
    <div class="row">
    <div class="col-md-10 col-md-offset-1">
        <h1>Hola {{ $user->name }} </h1>
        <h2>Te comunicamos que se ha creado una nueva categoria y invitamos a explorarla</h2>
        <h3>Nombre de la categoría: {{ $category->name }}</h3>
        <h3>Descripción de la categoría: {{ $category->description }}</h3>
    </div>
</div>
</body>
</html>

