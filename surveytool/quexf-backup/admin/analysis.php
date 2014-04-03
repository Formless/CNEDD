<?php

	ini_set('display_errors', 'On');
	/*This path is incomplete*/
	include "../functions/functions.import.php";
	include "../functions/functions.output.php";
	include "../functions/functions.xhtml.php";

	xhtml_head();
	//$errors = array();
	//|| !(is_dir($_POST['file']))
	if (empty($_POST['file']) ) {
		echo "Must choose a directory.";
	}
	if (!empty($_POST['file'])) {
		if (is_dir($_POST['file'])) {
			echo "This is a valid directory.";
		} else {
			echo "Not a valid directory.";
		}
		import_directory($_POST['file']);
		$csv = csv();
		echo "$csv";
	}
	
?>

<div>
	<form type="text/plain" action="?" method="post">
		<label for="file">Filename:</label>
		<input type="text/plain" name="file" id="file">
		<input type="submit" name="submit" value="Submit">
	</form>
</div>

<?php xhtml_foot(); ?>
