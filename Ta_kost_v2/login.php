<?php
include 'config.php';

session_start();

error_reporting(0);

// isset untuk memeriksa suatu objek dari nilai inputan form
// mysqli_fetch_assoc menghasilkan array asosiatif yang mana index-nya sesuai dengan nama kolom yang diseleksi
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM register WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result); 
        $_SESSION['username'] = $row['username'];
        header("Location: home.php");
    } else {
        echo "<script>alert('Email atau kata sandi yang anda masukkan salah.')</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login user</title>
    <link rel="stylesheet" href="login.css">
    <link rel="shortcut icon" href="img/logo.png" type="image/x-icon">
</head>

<body>
    <div class="form">
        <h2>Login</h2>
        <form action="" method="POST" class="login-email">
            <input type="email" name="email" placeholder="Email" value="<?php echo $email; ?>" required>

            <input type="password" name="password" placeholder="Password" value="<?php echo $_POST['password']; ?>" required>

            <button type="submit" name="submit">Login</button>

            <p>Masuk sebagai Admin? <a href="admin/adminlogin.php"><b>Admin</b></a></p>
            <p>Belum punya akun? <a href="register.php"><b>Register disini</b></a></p>
           
        </form>
    </div>
</body>

</html>