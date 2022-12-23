<?php 
  session_start(); 

  if (!isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
  if (isset($_GET['logout'])) {
  	session_destroy();
  	unset($_SESSION['email']);
  	header("location: login.php");
  }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>

    <div class="header">
        <h2>Dashboard</h2>
    </div>
    <div class="content">
        <!-- notification message -->
        <?php if (isset($_SESSION['success'])) : ?>
        <div class="error success">
            <h3>
                <?php 
          	echo $_SESSION['success']; 
          	unset($_SESSION['success']);
          ?>
            </h3>
        </div>
        <?php endif ?>

        <!-- logged in user information -->
        <?php  if (isset($_SESSION['email'])) : ?>
        <p>Welcome <strong><?php echo $_SESSION['email']; ?></strong><a href="index.php?logout='1'"
                style="color: red; margin: 49px; ">logout</a></p>
        <?php endif ?>

        <?php 
$email=$_SESSION['email'];
$db = mysqli_connect('localhost', 'root', 'root', 'blog');
$results = mysqli_query($db, "SELECT * FROM users where email='$email'");
 ?>

        <table>
            <thead style="text-align:left ">
                <?php while ($row = mysqli_fetch_array($results)) { ?>
                <tr>
                    <th>First Name</th>
                    <td><?php echo $row['firstName']; ?></td>
                </tr>
                <tr>
                    <th>Last Name</th>
                    <td><?php echo $row['lastName']; ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?php echo $row['email']; ?></td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td><?php echo $row['phone']; ?></td>
                </tr>
                <tr>
                    <th>Role</th>
                    <td><?php echo $row['role']; ?></td>
                </tr>
                <tr>
                    <th>Action</th>
                    <td>
                        <a href="update.php" class="edit_btn">Edit</a>
                    </td>
                </tr>
            </thead>

        </table>

    </div>
    <div class="header">
        <h2>Blog</h2>
    </div>
    <div class="content">
        <?php 
	$id= $row['id']; 
	$role=$row['role'];
	?>
        <a href="addBlog.php?id=<?php echo $row['id']; ?>" class="edit_btn">Add New Blog</a>
        <?php } ?>
        <?php 
$db = mysqli_connect('localhost', 'root', 'root', 'blog');
if($role=="writer")
{
$results = mysqli_query($db, "SELECT * FROM posts where user_id=$id");
?>

        <table>
            <thead style="text-align:left ">
                <?php while ($row = mysqli_fetch_array($results)) { ?>
                <tr>
                    <th>Title</th>
                    <td><?php echo $row['title']; ?></td>
                </tr>
                <tr>
                    <th>Description</th>
                    <td><?php echo $row['post']; ?></td>
                </tr>
                <tr>
                    <th>Action</th>
                    <td>
                        <a href="showBlog.php?id=<?php echo $row['id']; ?>" class="edit_btn">Read</a>
                        <a href="updateBlog.php?id=<?php echo $row['id']; ?>" class="edit_btn">Edit</a>
                        <a href="deleteBlog.php?id=<?php echo $row['id']; ?>" class="edit_btn">Delete</a>
                    </td>
                </tr>
            </thead>
            <?php } ?>
        </table>
    </div>
    <?php
	} 
	else{
		$results = mysqli_query($db, "SELECT * FROM posts");
?>
    <table>
        <thead style="text-align:left ">
            <?php while ($row = mysqli_fetch_array($results)) { ?>
            <tr>
                <th>Title</th>
                <td><?php echo $row['title']; ?></td>
            </tr>
            <tr>
                <th>Description</th>
                <td><?php echo $row['post']; ?></td>
            </tr>
        </thead>
        <?php } ?>
    </table>
    <?php
	}
	?>
</body>

</html>