<?php

if (!isset($_COOKIE['sesion'])) {
  header("location: login.php");
}
/* if ($_COOKIE['sesion'] != 'nombre_completo') {
} */
$weather = "";
$error = "";
if (array_key_exists('submit', $_GET)) {
  //revisamos si el input es vacio
  if (!$_GET['city']) {
    $error = "Perdon, no haz introducido nada.";
  }
  if ($_GET['city']) {
    $apiData = file_get_contents("http://api.weatherapi.com/v1/forecast.json?key=6fc3aea6fe4c42a391924958220503&q=" . $_GET['city'] . "&days=7&aqi=no&alerts=no");

    $weatherArray = json_decode($apiData, true);
    //print_r($weatherArray);
    $location = $weatherArray['location']['name'];
    $time = $weatherArray['location']['localtime'];
    $condition = $weatherArray['current']['condition']['text'];
    $weather = $weatherArray['current']['temp_c'];
    $icon = "<img src=" . $weatherArray['current']['condition']['icon'] . ">";


    $day1 = $weatherArray['forecast']['forecastday']['1']['date'];
    $day1W = $weatherArray['forecast']['forecastday']['1']['day']['maxtemp_c'];
    $day1C = $weatherArray['forecast']['forecastday']['1']['day']['condition']['text'];
    $day1I = "<img src=" . $weatherArray['forecast']['forecastday']['1']['day']['condition']['icon'] . ">";
    $astroSR = $weatherArray['forecast']['forecastday']['1']['astro']['sunrise'];
    $astroSS = $weatherArray['forecast']['forecastday']['1']['astro']['sunset'];

    $day2 = $weatherArray['forecast']['forecastday']['2']['date'];
    $day2W = $weatherArray['forecast']['forecastday']['2']['day']['maxtemp_c'];
    $day2C = $weatherArray['forecast']['forecastday']['2']['day']['condition']['text'];
    $day2I = "<img src=" . $weatherArray['forecast']['forecastday']['2']['day']['condition']['icon'] . ">";
    $astro2SR = $weatherArray['forecast']['forecastday']['2']['astro']['sunrise'];
    $astro2SS = $weatherArray['forecast']['forecastday']['2']['astro']['sunset'];
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weather App</title>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans&display=swap" rel="stylesheet">
  <link rel="icon" type="image/x-icon" href="../imagenes/weathericon.png">
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
      max-width: 400px;
      margin: 0;
    }

    .container-fluid {
      background: #000000d0;
      color: white;
      padding: 2em;
      border-radius: 30px;
      width: 100%;
      max-width: 400px;
      margin: 0;
      margin-left: 30px;
      margin-bottom: 14px;
      margin-top: 11px;
    }


    .search {
      display: flex;
      align-items: center;
      justify-content: center;
    }

    button {
      margin: 0.5em;
      border-radius: 50%;
      border: none;
      height: 44px;
      width: 44px;
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

    .weatherC {
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 350%;
    }

    .flex {
      display: flex;
      align-items: center;
    }
  </style>

</head>

<body>

  <div class="container">
    <div class="search">
      <form action="" method="GET">
        <?php echo "Welcome, ". $_COOKIE['sesion'];?>
        <label for="city" class="label"> Enter your city name</label>
        <input type="text" class="search-bar" name="city" id="city" placeholder="City name">
        <button type="submit" name="submit"><svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="1.5em" width="1.5em" xmlns="http://www.w3.org/2000/svg">
            <path d="M909.6 854.5L649.9 594.8C690.2 542.7 712 479 712 412c0-80.2-31.3-155.4-87.9-212.1-56.6-56.7-132-87.9-212.1-87.9s-155.5 31.3-212.1 87.9C143.2 256.5 112 331.8 112 412c0 80.1 31.3 155.5 87.9 212.1C256.5 680.8 331.8 712 412 712c67 0 130.6-21.8 182.7-62l259.7 259.6a8.2 8.2 0 0 0 11.6 0l43.6-43.5a8.2 8.2 0 0 0 0-11.6zM570.4 570.4C528 612.7 471.8 636 412 636s-116-23.3-158.4-65.6C211.3 528 188 471.8 188 412s23.3-116.1 65.6-158.4C296 211.3 352.2 188 412 188s116.1 23.2 158.4 65.6S636 352.2 636 412s-23.3 116.1-65.6 158.4z">
            </path>
          </svg></button>
        <?php
        if ($error) {
          echo '<div class="label">' . $error . '</div>';
        }
        if ($weather) {
          echo '<h2 class="label">Clima en ' . $location . '</h2>';
          echo '<div class="label">' . $time . '</div>';
          echo '<div class="weatherC">' . $weather . '&deg;C</div>';
          echo '<div class="label">' . $icon . '</div>';
          echo '<div class="label"><b>' . $condition . '</b></div>';
        }
        ?>
    </div>
    </form>
  </div>
  <div class="row">
    <div class="container-fluid">
      <?php
      if ($weather) {
        echo '<h2 class="label">' . $day1 . '</h2>';
        echo '<div class="weatherC">' . $day1W . '&deg;C</div>';
        echo '<div class="label">' . $day1I . '</div>';
        echo '<div class="label"><b>' . $day1C . '</b></div>';
        echo '<div class="label"><b>Sunset:  </b>' . $astroSS . '</div>';
        echo '<div class="label"><b>Sunrise:  </b>' . $astroSR . '</div>';
      }
      ?>
    </div>
    <div class="container-fluid">
      <?php
      if ($weather) {
        echo '<h2 class="label">' . $day2 . '</h2>';
        echo '<div class="weatherC">' . $day2W . '&deg;C</div>';
        echo '<div class="label">' . $day2I . '</div>';
        echo '<div class="label"><b>' . $day2C . '</b></div>';
        echo '<div class="label"><b>Sunset:  </b>' . $astro2SS . '</div>';
        echo '<div class="label"><b>Sunrise:  </b>' . $astro2SR . '</div>';
      }
      ?>
    </div>
  </div>
  </div>



</body>

</html>