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
        <h2>Update Post</h2>
    </div>
    <form method="post" action="updateBlog.php">
        <?php include('errors.php'); ?>
        <?php $id= htmlspecialchars($_GET["id"]); ?>
        <?php 
$db = mysqli_connect('localhost', 'root', 'root', 'blog');
$results = mysqli_query($db, "SELECT * FROM posts where id='$id'");
 ?>
        <?php while ($row = mysqli_fetch_array($results)) { ?>
        <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
        <div class="input-group">
            <label>Title</label>
            <input type="text" name="title" value="<?php echo $row['title']; ?>">
        </div>
        <div class="input-group">
            <label>Post</label>
            <textarea name="post" id="" cols="90" rows="10"><?php echo $row['post']; ?></textarea>
        </div>
        <?php } ?>
        <div class="input-group">
            <button type="submit" class="btn" name="updateblog">Update Blog</button>
        </div>
    </form>
</body>

</html>