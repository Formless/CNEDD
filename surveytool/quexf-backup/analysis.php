<?php

	ini_set('display_errors', 'On');
	/*This path is incomplete*/
	include "functions/functions.import.php";
	include "functions/functions.output.php";

	xhtml_head();

	$errors = array();

	if (empty($_POST['file']) || !(is_dir($_POST['file']))) {
		$errors = ['Must choose a directory.'];
	}
	if (isempty($errors)) {
		import_directory($_POST['file']);
		/*TODO Check that files were uploaded correctly and output any errors*/
		$r = outputdatacsv(intval(3), "", true, true);
		echo $r;
	}
?>

<div>
	<form>
		<label for="file">Filename:</label>
		<input type="file" name="file" id="file">
		<br>
		<input type="submit" name="submit" value="Submit">
	</form>
</div>

<?php xhtml_foot(); ?>
