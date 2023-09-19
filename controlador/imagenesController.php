<?php
if ($_FILES['file']['size']) {
	if (!$_FILES['file']['error']) {
		$name = md5(rand(100, 200));
		$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
		$filename = $name.'.'.$ext;
		$destination = '../imagenes/summernote/'.$filename;
		$location = $_FILES["file"]["tmp_name"];
		move_uploaded_file($location, $destination);
		echo '../imagenes/summernote/'.$filename;
	} else {
		echo $message = 'Ooops!  Your upload triggered the following error:  '.$_FILES['file']['error'];
	}
}

?>