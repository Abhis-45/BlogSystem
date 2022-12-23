<?php include('server.php') ?>
<?php 
  if (!isset($_SESSION['email'])) {
  	$_SESSION['msg'] = "You must log in first";
  	header('location: login.php');
  }
?>
<!DOCTYPE html>
<html>

<head>
    <title>Bloging System </title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="header">
        <h2>Update</h2>
    </div>
    <?php 
$email=$_SESSION['email'];
$db = mysqli_connect('localhost', 'root', 'root', 'blog');
$results = mysqli_query($db, "SELECT * FROM users where email='$email'");
 ?>
    <form method="post" action="update.php">
        <?php include('errors.php'); ?>
        <?php while ($row = mysqli_fetch_array($results)) { ?>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="input-group">
            <label>First Name</label>
            <input type="text" name="fname" value="<?php echo $row['firstName']; ?>">
        </div>
        <div class="input-group">
            <label>Last Name</label>
            <input type="text" name="lname" value="<?php echo $row['lastName']; ?>">
        </div>
        <div class="input-group">
            <label>Role</label>
            <select name="role" id="">
                <option value="editor" selected>Editor</option>
                <option value="writer">Writer</option>
            </select>
        </div>
        <?php } ?>
        <div class="input-group">
            <button type="submit" class="btn" name="update">update</button>
    </form>
</body>

</html>