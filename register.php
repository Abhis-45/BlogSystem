<?php include('server.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Bloging System</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="header">
        <h2>Register</h2>
    </div>

    <form method="post" action="register.php">
        <?php include('errors.php'); ?>
        <div class="input-group">
            <label>First Name</label>
            <input type="text" name="fname" value="<?php echo $fname; ?>">
        </div>
        <div class="input-group">
            <label>Last Name</label>
            <input type="text" name="lname" value="<?php echo $lname; ?>">
        </div>
        <div class="input-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>">
        </div>
        <div class="input-group">
            <label>Phone</label>
            <input type="number" name="phone" value="<?php echo $phone; ?>">
        </div>
        <div class="input-group">
            <label>Password</label>
            <input type="password" name="password_1">
        </div>
        <div class="input-group">
            <label>Confirm password</label>
            <input type="password" name="password_2">
        </div>
        <div class="input-group">
            <label>Role</label>
            <select name="role" id="">
                <option value="editor" selected>Editor</option>
                <option value="writer">Writer</option>
            </select>
        </div>
        <div class="input-group">
            <button type="submit" class="btn" name="reg_user">Register</button>
        </div>
        <p>
            Already a member? <a href="login.php">Sign in</a>
        </p>
    </form>
</body>

</html>