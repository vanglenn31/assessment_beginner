<?php
session_start();
 
// If not logged in, redirect to login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
} 
include "db.php";
 
$clients = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM clients"))['c'];
$services = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM services"))['c'];
$bookings = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) AS c FROM bookings"))['c'];
 
$revRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS s FROM payments"));
$revenue = $revRow['s'];
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Dashboard</title>
  <link rel="stylesheet" href="./styles/index.css">
</head>
<body class="body">
  <?php include "nav.php"; ?>
  
  <h2 class="text-4xl font-serif font-bold text-center m-6">Dashboard</h2>
  <h3 class="text-2xl font-serif font-bold text-center mb-6">Welcome, <?php echo $_SESSION['username']; ?>!</h3>
  <div class="flex justify-center ">
    <ul class="h-60 w-1/2 rounded-sm shadow-lg text-lg text-sky-100 grid grid-cols-2 gap-5 p-6 list justify-items-center p-8" >
      <li class="list-item rounded-lg p-2 w-60 ">Total Clients: <p class="text-end text-2xl pr-4"><b><?php echo $clients; ?></b></p></li>
      <li class="list-item rounded-lg p-2 w-60 ">Total Services: <p class="text-end text-2xl pr-4"><b><?php echo $services; ?></b></p></li>
      <li class="list-item rounded-lg p-2 w-60 ">Total Bookings: <p class="text-end text-2xl pr-4"><b><?php echo $bookings; ?></b></p></li>
      <li class="list-item rounded-lg p-2 w-60 ">Total Revenue: <p class="text-end text-2xl pr-4"><b>₱<?php echo number_format($revenue,2); ?></b></p></li>
    </ul>
  </div>
  
  <p class="text-center m-10">
    Quick links:
    <a class="relative inline-block text-gray-700 transition-colors duration-300 hover:text-blue-600 after:block after:h-[2px] after:bg-blue-600 after:scale-x-0 after:origin-left
      after:transition-transform after:duration-300 hover:after:scale-x-100" href="./pages/clients_add.php">Add Client</a> |
    <a class="relative inline-block text-gray-700 transition-colors duration-300 hover:text-blue-600 after:block after:h-[2px] after:bg-blue-600 after:scale-x-0 after:origin-left
      after:transition-transform after:duration-300 hover:after:scale-x-100" href="./pages/bookings_create.php">Create Booking</a>
  </p>
 
</body>
</html>