<?php

require('../define.php');

// Main Menu CSV File
$menu_json = file_get_contents("menu.json");
// Convert the JSON to an array
$menu_explode = json_decode($menu_json);

?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title><?php echo WEBSITE_TITLE; ?></title>
  <meta name="description" content="<?php echo WEBSITE_DESCRIPTION; ?>">
  <meta property="og:title" content="<?php echo WEBSITE_TITLE; ?>">
  <meta property="og:type" content="website">
  <meta property="og:description" content="<?php echo WEBSITE_DESCRIPTION; ?>">
  <meta property="og:image" content="image.png">
  <link rel="icon" href="/favicon.ico">

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="styles.css">  
  
</head>
  
<body>
  <nav class="navbar navbar-dark bg-dark no_print" aria-label="First navbar">
    <div class="container-fluid">
      <button class="navbar-toggler w-100 p-0 m-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbar01" aria-controls="navbar01" aria-expanded="true" aria-label="Toggle navigation">
      <span class="navbar-brand float-end p-0 m-0 pe-2"><img src="./img/small_logo.png" height="60px"></span>
        <span class="navbar-toggler-icon float-start me-2" style="width: 60px; height: 60px;"></span>
      </button>

      <div class="navbar-collapse collapse" id="navbar01" style="">
        <ul class="navbar-nav me-auto mb-2">
          <?php
            // Set the base TXT file to load for the Home Page
            $content = file_get_contents( "./txt/Home.txt");

            // Loop through the menu array and display a <li> for each
            foreach ($menu_explode as $key => $value) {
              $menu_data = explode(',', $value);
              $name = $menu_data[0];
              $url = $menu_data[1];
              $link = $menu_data[2];
              echo '<li class="nav-item">
                      <a class="nav-link" aria-current="page" href="'.$url.'">'.$name.'</a>
                    </li>';
                    
              // If the current item matches the user's request, set the $content
              if (isset($_GET['dept']) && strtolower($_GET['dept']) == strtolower($name) ) {
                $content = file_get_contents( "./txt/" . $name . ".txt");
              }
            }
          ?>
        </ul>
      </div>
    </div>
  </nav>
