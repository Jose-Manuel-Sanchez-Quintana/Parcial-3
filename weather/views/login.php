<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
    <link rel="icon" type="image/x-icon" href="../imagenes/loginicon.png">
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

        button {
            border-radius: 50%;
            height: 55px;
            width: 100px;
            outline: none;
            background: #7c7c7c2b;
            color: white;
            cursor: pointer;
            transition: 0.2s ease-in-out;
        }


        button:hover {
            background: #7c7c7c6b;
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
    <script>
        function statusChangeCallback(response) { // Called with the results from FB.getLoginStatus().
            console.log('statusChangeCallback');
            console.log(response); // The current login status of the person.
            if (response.status === 'connected') { // Logged into your webpage and Facebook.
                testAPI();
            } else { // Not logged into your webpage or we are unable to tell.
                document.getElementById('status');
            }
        }


        function checkLoginState() { // Called when a person is finished with the Login Button.
            FB.getLoginStatus(function(response) {
            });
        }


        window.fbAsyncInit = function() {
            FB.init({
                appId: '1019559361990415',
                cookie: true, // Enable cookies to allow the server to access the session.
                xfbml: true, // Parse social plugins on this webpage.
                version: 'v13.0' // Use this Graph API version for this call.
            });


            FB.getLoginStatus(function(response) { // Called after the JS SDK has been initialized.
                statusChangeCallback(response);
                console.log(response) // Returns the login status.
            });
        };

        function testAPI() { // Testing Graph API after login.  See statusChangeCallback() for when this call is made.
            console.log('Welcome!  Fetching your information.... ');
            FB.api('/me?fields=name,email', function(response) {
                LoginF(response.email);
                //console.log('Successful login for: ' + response.email);
                /*                 document.getElementById('status').innerHTML = window.location.replace('weather.php') */
            });
        }
    </script>

    <!-- Load the JS SDK asynchronously -->
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js"></script>

    <div class="container sm-3"><br>
        <h2>Login</h2>
        <form>
            <div class="mb-3 mt-3">
                <div id="error"></div>
                <label for="correo">Email:</label>
                <input type="email" class="form-control" id="correo" placeholder="Enter email" name="correo" required>
            </div>
            <div class="mb-3">
                <label for="contrasena">Password:</label>
                <input type="password" class="form-control" id="contrasena" placeholder="Enter password" name="contrasena" required>
            </div>
            <button type="button" id="submit" class="btn btn-warning"><b>Log in</b></button>
            <div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-layout="default" data-auto-logout-link="false" data-use-continue-as="false" onlogin="testAPI()"></div>
            <div id="status">
            </div>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $("#submit").click(function() {
                var correo = $("#correo").val();
                var contrasena = $("#contrasena").val()
                if (correo == "" || contrasena == "") {
                    $("#error").text("Campos vacios");
                    $("#error").css("color", "red");
                } else {
                    $.post("../controller/login.php", {
                            correo: correo,
                            contrasena: contrasena
                        },
                        function(data, status) {
                            console.log(data);

                            var obj = JSON.parse(data);

                            if (obj.estado == true) {
                                window.location.replace("weather.php");
                            } else if (obj.estado == false) {
                                $("#error").text("Error al iniciar sesion");
                                $("#error").css("color", "red");
                            }
                        });
                }
            });
        });

        function LoginF(_email) {
            $.post("../controller/loginF.php", {
                    email: _email
                },
                function(data, status) {
                    console.log(data);
                    var obj = JSON.parse(data);
                    if (obj.estado == true) {
                        window.location.replace("weather.php");
                    } else if (obj.estado == false) {
                        $("#error").text("Error al iniciar sesion");
                        $("#error").css("color", "red");
                    }
                });
        }
    </script>


</body>

</html>