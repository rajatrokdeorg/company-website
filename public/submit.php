<?php
$target_dir = "uploads/";
$target_file = $target_dir . basename($_FILES["resume"]["name"]);
move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file);

$filetype = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
if($filetype != "pdf" && $filetype != "doc" && $filetype != "docx") {
    echo "Only PDF, Word documents are allowed";
    exit;
}

$to = "youremail@gmail.com";
$subject = "New Resume Submission";
$message = "A new resume has been submitted for the Web Developer position.";
$headers = "From: yourwebsite.com";
$file = $target_file;
$filename = basename($file);
$filetype = pathinfo($file,PATHINFO_EXTENSION);
$random_hash = md5(date('r', time()));
$file_upload_path = $target_dir . $random_hash . '.' . $filetype;

if(move_uploaded_file($file, $file_upload_path)) {
    $file = $file_upload_path;
    $content = chunk_split(base64_encode(file_get_contents($file)));
    $uid = md5(uniqid(time()));
    $header = "From: yourwebsite.com \r\n";
    $header .= "Bcc: yourwebsite.com \r\n";
    $header .= "Content-Type: multipart/mixed; boundary=\"".$uid."\" \r\n\r\n";
    $header .= "This is a multi-part message in MIME format.\r\n";
    $header .= "--".$uid."\r\n";
    $header .= "Content-type:text/plain; charset=iso-8859-1\r\n";
    $header .= "Content