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
        <h2>Read Post</h2>
    </div>
    <form method="post" action="showBlog.php">
        <?php include('errors.php'); ?>
        <?php $id= htmlspecialchars($_GET["id"]); ?>
        <?php 
$db = mysqli_connect('localhost', 'root', 'root', 'blog');
$results = mysqli_query($db, "SELECT * FROM posts where id='$id'");
 ?>
        <?php while ($row = mysqli_fetch_array($results)) { ?>
        <div class="input-group">
            <label>Title</label>
            <?php echo $row['title']; ?>
        </div>
        <div class="input-group">
            <label>Post</label>
            <?php echo $row['post']; ?>
        </div>
        <?php } ?>
        <div class="input-group">
            <a href="index.php"><button type="button" class="btn" name="updateblog">Go Home page</button></a>
        </div>
    </form>
</body>

</html>