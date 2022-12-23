<?php
session_start();

// initializing variables
$fname  = " ";
$lname  = " ";
$email  = " ";
$phone  = " ";
$errors = array(); 

// connect to the database
$db = mysqli_connect('localhost', 'root', 'root', 'blog');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $fname = mysqli_real_escape_string($db, $_POST['fname']);
  $lname = mysqli_real_escape_string($db, $_POST['lname']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $phone = mysqli_real_escape_string($db, $_POST['phone']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
  $role = mysqli_real_escape_string($db, $_POST['role']);

  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  if (empty($fname)) { array_push($errors, "First name is required"); }
  if (empty($lname)) { array_push($errors, "Last name is required"); }
  if (empty($email)) { array_push($errors, "Email is required"); }
  if (empty($phone)) { array_push($errors, "Phone is required"); }
  if (empty($password_1)) { array_push($errors, "Password is required"); }
  if ($password_1 != $password_2) {
	array_push($errors, "The two passwords do not match");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE phone='$phone' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['phone'] === $phone) {
      array_push($errors, "phone already exists");
    }

    if ($user['email'] === $email) {
      array_push($errors, "email already exists");
    }
  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (firstName,lastName, email,phone,password,role) 
  			  VALUES('$fname','$lname', '$email', '$phone','$password','$role')";
  	mysqli_query($db, $query);
  	$_SESSION['email'] = $email;
  	$_SESSION['success'] = "You are now logged in";
  	header('location: index.php');
  }
}

// LOGIN USER
if (isset($_POST['login_user'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
  
    if (empty($email)) {
        array_push($errors, "email is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['email'] = $email;
          $_SESSION['success'] = "You are now logged in";
          header('location: index.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }
  
  if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $fname = $_POST['fname'];
    $lname =  $_POST['lname'];
    $role = $_POST['role'];
    mysqli_query($db, "UPDATE users SET FirstName='$fname',LastName='$lname', role='$role' WHERE id='$id'");
    header('location: index.php');
  }

  if (isset($_POST['addblog'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $post =  $_POST['post'];
    mysqli_query($db, "INSERT INTO posts (user_id,title,post) values ('$id','$title','$post')");
    header('location: index.php');
  }

  if (isset($_POST['updateblog'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $post =  $_POST['post'];
    mysqli_query($db, "UPDATE posts SET title='$title',post='$post' WHERE id='$id'");
    header('location: index.php');
  }

  if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    mysqli_query($db, "delete from posts WHERE id='$id'");
    header('location: index.php');
  }
  ?>