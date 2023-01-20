<?php
// enable error reporting
\error_reporting(\E_ALL);
\ini_set('display_errors', 'stdout');

function get_string_between($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

// Main Menu CSV File
$menu_file = file_get_contents('https://docs.google.com/spreadsheets/d/e/2PACX-1vSqR4nLCjtZ_CLhKeke-FP0QncX4rRLmXcPCTSab-x2kyFdInKwxlDocJDEKyYXjUjbCSYzZFV1-z0T/pub?gid=0&single=true&output=csv');
// Explode the CSV into an array by lines
$menu_explode = explode(PHP_EOL, $menu_file);

// Set the main index page
$text = file_get_contents('https://docs.google.com/document/d/e/2PACX-1vSlJa7qHDgcgrcKRjdmogKBM5MR2ToK2zYFzbi-0I0I_qbbXk3irdpAQTwdfHC1oOcViIGmqIeJBGDI/pub');
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Lakes of Fire</title>
  <meta name="description" content="Lakes of Fire">
  <meta property="og:title" content="Lakes of Fire">
  <meta property="og:type" content="website">
  <meta property="og:description" content="Lakes of Fire">
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
            // Loop through the menu array and display a <li> for each
            foreach ($menu_explode as $key => $value) {
              $menu_data = explode(',', $value);
              $name = $menu_data[0];
              $url = $menu_data[1];
              $link = $menu_data[2];
              echo '<li class="nav-item">
                      <a class="nav-link" aria-current="page" href="'.$url.'">'.$name.'</a>
                    </li>';
              if (isset($_GET['dept']) && strtolower($_GET['dept']) == strtolower($name) ) {
                $text = file_get_contents( trim($link) );
              }
            }
            // Trim out the text on the page
            $content = get_string_between($text, '##BEGIN##', '##END##');
            // Trim out all the extra classes getting dropped on stuff by google
            $content = preg_replace('/class=".*?"/', '', $content);
            // Trim out any styles google adds - important for images
            $content = preg_replace('/style=".*?"/', '', $content);
            // Convert any inline HTML entities into entities
            $content = html_entity_decode($content);
          ?>
        </ul>
      </div>
    </div>
  </nav>
