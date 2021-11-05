<?php
include_once('../dbconnect.php');
$admin =  $_REQUEST['admin'];
$username = $_REQUEST['username'];
$name = $_REQUEST['name'];
$password_1 = $_REQUEST['password_1'];
$errors = array(); 
// REGISTER USER
if (isset($_POST['reg_user'])) {

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($username)) { array_push($errors, "Username is required"); }
  if (empty($name)) { array_push($errors, "Name is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO Users (Username, isAdmin, Name, Password) VALUES('$username','$admin', '$name', '$password')";
  	mysqli_query($conn, $query);
  	header('location: ../page/user.php');
  }
}
