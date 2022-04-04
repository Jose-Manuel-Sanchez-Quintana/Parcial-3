<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../imagenes/registericon.png">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Open Sans', sans-serif;
            background: #222;
            background-image: url('https://source.unsplash.com/1600x900/?landscape');
            font-size: 105%;
        }

        .container {
            background: #000000d0;
            color: white;
            padding: 2em;
            border-radius: 30px;
            width: 100%;
            max-width: 420px;
            margin: 1em;
        }

        .search {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .output {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        button {
            border-radius: 50%;
            height: 44px;
            width: 100px;
            outline: none;
            background: #7c7c7c2b;
            color: white; 
            cursor: pointer;
            transition: 0.2s ease-in-out;
        } 

        input.search-bar {
            border: none;
            outline: none;
            padding: 0.4em 1em;
            border-radius: 24px;
            background: #7c7c7c2b;
            color: white;
            font-family: inherit;
            font-size: 110%;
            width: calc(100% - 100px);
        }

        button:hover {
            background: #7c7c7c6b;
        }

        h1.temp {
            margin: 0;
            margin-bottom: 0.4em;
        }

        .label {
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 150%;
        }

        .flex {
            display: flex;
            align-items: center;
        }

        .description {
            text-transform: capitalize;
            margin-left: 8px;
        }

        .weather.loading {
            visibility: hidden;
            max-height: 20px;
            position: relative;
        }

        .weather.loading:after {
            visibility: visible;
            content: "Loading...";
            color: white;
            position: absolute;
            top: 0;
            left: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Register</h2>
        <form action="/action_page.php">
        <div class="mb-3 mt-3">
                <label for="nombre">Full name:</label>
                <input type="text" class="form-control" id="nombre" placeholder="Enter full name" name="nombre" required>
            </div>
            <div class="mb-3 mt-3">
                <label for="correo">Email:</label>
                <input type="email" class="form-control" id="correo" placeholder="Enter email" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="contrasena">Password:</label>
                <input type="password" class="form-control" id="contrasena" placeholder="Enter password" name="contrasena" required>
            </div>
            <div class="mb-3">
            <button type="button" id="button" class="btn btn-warning"><b>Register</b></button>
            </div>
                
                <a href="login.php">Log in</a>
        </form>
    </div>

<script>
        
        
    $("#button").click(function(){

        var nombre = document.getElementById('nombre').value;
        var correo = document.getElementById('correo').value;
        var contrasena = document.getElementById('contrasena').value;

        $.post("../controller/register.php",{
            
            nombre: nombre,
            correo: correo,
            contrasena: contrasena

        },
        function(data, status){
            console.log(status);
            console.log(data);
        });

    });
</script>
</body>

</html>