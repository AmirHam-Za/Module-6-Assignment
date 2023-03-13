<?php
session_start();

// Check if all fields are filled
if(empty($_POST['name']) || empty($_POST['email']) || empty($_POST['password']) || empty($_FILES['profile-picture'])) {
  header("Location: index.php");
  exit();
}

// Check if email is valid
if(!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
  header("Location: index.php");
  exit();
}

// Create a unique filename for the profile picture
$target_dir = "uploads/";
$target_file = $target_dir . date("YmdHis") . "_" . basename($_FILES["profile-picture"]["name"]);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// Check if file already exists
if (file_exists($target_file)) {
  header("Location: index.php");
  exit();
}

// Check file size
if ($_FILES["profile-picture"]["size"] > 5000000) {
  header("Location: index.php");
  exit();
}

// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  header("Location: index.php");
  exit();
}

// Upload the profile picture to the server
if (move_uploaded_file($_FILES["profile-picture"]["tmp_name"], $target_file)) {
  // Save user data to CSV file
  $user_data = array($_POST['name'], $_POST['email'], $target_file);
  $fp = fopen('users.csv', 'a');
  fputcsv($fp, $user_data);
  fclose($fp);

  // Set session and cookie
  $_SESSION['name'] = $_POST['name'];
  setcookie("name", $_POST['name'], time()+3600);

  header("Location: view-users.php");
  exit();
} else {
  header("Location: index.php");
  exit();
}
?>
