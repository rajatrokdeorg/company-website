<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["resume"]["name"]);
move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file);
echo "Resume submitted successfully!";
?>