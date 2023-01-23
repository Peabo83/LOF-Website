<?php
// // enable error reporting
//         \error_reporting(\E_ALL);
//         \ini_set('display_errors', 'stdout');

require('./header.php');

if (!isset($_POST['input-value'])) {
	echo '	<div class="container-fluid">
				<form method="POST">
					<div class="row">
						<div class="col-12 mt-2">
							<div class="input-group">
								<input type="text" name="input-value" class="form-control">
								<button class="btn btn-success">Go</button>
							</div>
						</div>
					</div>
				</form>
			</div>';
	exit();
}
if ($_POST['input-value'] == CACHE_PASSWORD) {

	// Main Menu CSV File Source
	$menu_file = file_get_contents(MAIN_MENU_CSV);
	// Explode the CSV into an array by lines
	$menu_explode = explode(PHP_EOL, $menu_file);
	// Convert the CSV menu to JSON
	$menu_for_json = json_encode($menu_explode);
	// Open the menu json
	$file = fopen( "./menu.json", "w") or die();
	// Write the contents to the file
	fwrite($file, $menu_for_json);
	// Close the file
	fclose($file);

	// Loop through the menu array and display a <li> for each
	foreach ($menu_explode as $key => $value) {
		$menu_data = explode(',', $value);
		$name = $menu_data[0];
		$url = $menu_data[1];
		$link = $menu_data[2];

		$text = file_get_contents(trim($link));

	  // Trim out the text on the page
		$content = get_string_between($text, '##BEGIN##', '##END##');
		// Trim out all the extra classes getting dropped on stuff by google
		$content = preg_replace('/class=".*?"/', '', $content);
		// Trim out any styles google adds - important for images
		$content = preg_replace('/style=".*?"/', '', $content);
		// Convert any inline HTML entities into entities
		$content = html_entity_decode($content);

		// Get the full HTML of the page
		$html = file_get_contents(trim($link));
		// Create a DOMDoc
		$doc = new DOMDocument();
		// Load $html to DOMDoc
		@$doc->loadHTML($html);
		// Get all the IMG tags inside the HTML
		$tags = $doc->getElementsByTagName('img');
		// Loop through all IMG tags in the HTML
		foreach ($tags as $tag) {
			// Build the filename
			$filename = substr($tag->getAttribute('src'), strpos($tag->getAttribute('src'), ".com/") + 5);
			// Save the file to the /img/ folder
		  file_put_contents('./img/' . $filename, file_get_contents($tag->getAttribute('src')));
		  // Swap out the first bit of the SRC in images
			$content = preg_replace("/(src=\")(.*)(\")/", 'src="./img/'.$filename.'"', $content);
		}

		// Open the text file
		$file = fopen( "./txt/" . $name . ".txt", "w") or die();
		// Write the contents to the file
		fwrite($file, $content);
		// Close the file
		fclose($file);
	}
  echo '<div class="container-fluid" id="alert">  
          <div class="row">
            <div class="col-12 p-0">
              <div class="alert-bg">
                <div class="alert alert-success mt-2 mb-2">Local pages and images have been re-cached.</div>
              </div>
            </div>
          </div>
        </div>';
} else {
	  echo '<div class="container-fluid" id="alert">  
          <div class="row">
            <div class="col-12 p-0">
              <div class="alert-bg">
                <div class="alert alert-danger mt-2 mb-2">Something seems to have gone wrong.</div>
              </div>
            </div>
          </div>
        </div>';
}
?>
