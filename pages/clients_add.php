<?php
include "../db.php";
 
$message = "";
 
if (isset($_POST['save'])) {
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
 
  if ($full_name == "" || $email == "") {
    $message = "Name and Email are required!";
  } else {
    $sql = "INSERT INTO clients (full_name, email, phone, address)
            VALUES ('$full_name', '$email', '$phone', '$address')";
    mysqli_query($conn, $sql);
    header("Location: clients_list.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Add Client</title>
</head>
<body class="body">
<?php include "../nav.php"; ?>

  <div class="flex justify-center">
    <div class="h-1/2 w-lg rounded-3xl shadow-lg text-lg text-black flex flex-col text-center items-center addForm m-10">
      <h2 class="text-4xl font-serif font-bold text-center">Add Client</h2>
      <p style="color:red;"><?php echo $message; ?></p>
  

      <form method="post">
      <label>Full Name*</label>
      <input class="w-sm" type="text" name="full_name" placeholder="Please enter your name">
      
      <label>Email*</label>
      <input class="w-sm" type="text" name="email" placeholder="Please enter your email address">
      
      <label>Phone</label>
      <input class="w-sm" type="text" name="phone" placeholder="Please enter your mobile number (Optional)">
      
      <label>Address</label>
      <input class="w-sm" type="text" name="address" placeholder="Please enter your address(Optional)">
      
      <button class="w-sm" class="h-20" type="submit" name="save">Save</button>
      </form>
    </div>
</div>
</body>
</html>
