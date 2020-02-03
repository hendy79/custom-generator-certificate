<!DOCTYPE html>
<html>
<body>
<form method="post" action="<?php echo $_SERVER['PHP_SELF'];?>">
  Name: <input type="text" name="fname">
  <input type="submit">
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['fname'];
    if (empty($name)) {
        echo "Name is empty";
    } else {
        $cookie_name = "user";
        $cookie_value = $_POST['fname'] ;
        setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        session_start();
        $_SESSION['user'] = $name;
        header('location:canvas.php');
    }
}
?>

<?php

?>
</body>
</html>