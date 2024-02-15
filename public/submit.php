<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["resume"]["name"]);
move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file);

$filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($filetype != "pdf" && $filetype != "doc" && $filetype != "docx") {
    echo "Only PDF, Word documents are allowed";
    exit;
}

