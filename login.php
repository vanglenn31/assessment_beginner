<?php
session_start();
 
// If already logged in, redirect to index
if (isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}
 
$error = "";
 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $username = $_POST['username'];
    $password = $_POST['password'];
 
    // Static admin login
    if ($username === "admin" && $password === "admin") {
 
        $_SESSION['username'] = "ADMIN";
        header("Location: index.php");
        exit();
 
    } else {
        $error = "Invalid username or password!";
    }
}
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" href="../assesment/styles/login.css">
</head>
<body>
 <div class="login-container">
    <div class="login-card"> 
<h2>Login Form</h2>
 
<?php if ($error != ""): ?>
    <p class="error" style="color:red;"><?php echo $error; ?></p>
<?php endif; ?>
 
<form method="POST">
    <div class="input-group">
         <label>Username:</label>
    <input class="w-sm" type="text" name="username" required>
</div>
<div class="input-group">
    <label>Password:</label>
    <input class="w-sm" type="password" name="password" required>
 
    </div>
   
    <button class="w-sm" type="submit">Login</button>
</form>
</div>
</div>
 <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</body>
</html>