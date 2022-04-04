<?php
	$fileTypeAllowedList = array("jpg", "png", "jpeg", "gif", "pdf", "txt", "py", "cpp", "docx", "xlsx");
	$maxSize = 10000000;
	function exist($target){// Check if file already exists
		global $uploadOk;
		if (file_exists($target)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
		}
	}
	function size($target, $size){// Check file size
		global $uploadOk;
		if ($_FILES["fileToUpload"]["size"] > $size) {
			echo "Sorry, your file is too large.";
			$uploadOk = 0;
		}
	}
	function allowedType($target, $fileType){// Allow certain file formats
		global $uploadOk, $fileTypeAllowedList;
		if(!in_array($fileType, $fileTypeAllowedList)) {
			echo "Sorry, only JPG, JPEG, PNG, GIF, PDF, TXT, PY, CPP, DOCX & XLSX files are allowed.";
			$uploadOk = 0;
		}
	}
	function saveFile($target){//saving file
		global $uploadOk;
		// Check if $uploadOk is set to 0 by an error
		if ($uploadOk == 0) {
			echo "Sorry, your file was not uploaded.";
		// if everything is ok, try to upload file
		} else {
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target)) {
				echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
			} else {
				echo "Sorry, there was an error uploading your file.";
			}
		}
	}
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$fileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


	exist($target_file);
	size($target_file, $maxSize);
	allowedType($target_file, $fileType);
	
	saveFile($target_file);
	
	echo " <br/><br/> <a href='index.html'>Go back to upload page</a>";
	echo " <br/><br/><br/><br/><br/><br/><br/><br/> Powered by ostryJR: github.com/ostryJR/SimplyUploadFilePage";
?>
