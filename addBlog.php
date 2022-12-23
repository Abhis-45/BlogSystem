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
    <title>Bloging System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="header">
        <h2>Add Post</h2>
    </div>

    <form method="post" action="addBlog.php">
        <?php include('errors.php'); ?>
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($_GET["id"]); ?>">
        <div class="input-group">
            <label>Title</label>
            <input type="text" name="title">
        </div>
        <div class="input-group">
            <label>Post</label>
            <textarea name="post" id="" cols="90" rows="10"></textarea>
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="addblog">Add Blog</button>
        </div>
    </form>
</body>

</html>