<?php

$compartments = array(7, 2, "scrm", 9); // or whichever compartments 
                                        // you wish to run through

foreach ($compartments as $compartment){
	//$compartment = "2";
	$files = glob("uploads/$compartment*".".*"); // Will find 2.txt, 2.php, 2.gif

	// Process through each file in the list
	// and output its extension
	if (count($files) > 0){
		foreach ($files as $file){
			$info = pathinfo($file);
			echo "<br>File Found : ".$info["basename"]."<br>";
			echo "dirname : ".$info["dirname"]."<br>";
			echo "basename : ".$info["basename"]."<br>";
			echo "extension : ".$info["extension"]."<br>";
			echo "filename : ".$info["filename"]."<br>";
		}
	}

	else{
		echo "<br>No file name exists called $compartment. Regardless of extension.<br>";
	}
}

/*
$files = glob('path/to/temp/*'); // get all file names
foreach($files as $file){ // iterate files
  if(is_file($file))
    unlink($file); // delete file
}
*/

if (is_file('uploads/scrm_Yami-Gautam-Sweet.jpg')) {
	unlink('uploads/scrm_Yami-Gautam-Sweet.jpg');
}

?>