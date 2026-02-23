<?php
include "../db.php";
 
$id = $_GET['id'];
 
$get = mysqli_query($conn, "SELECT * FROM clients WHERE client_id = $id");
$client = mysqli_fetch_assoc($get);
 
$message = "";
 
if (isset($_POST['update'])) {
  $full_name = $_POST['full_name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $address = $_POST['address'];
 
  if ($full_name == "" || $email == "") {
    $message = "Name and Email are required!";
  } else {
    $sql = "UPDATE clients
            SET full_name='$full_name', email='$email', phone='$phone', address='$address'
            WHERE client_id=$id";
    mysqli_query($conn, $sql);
    header("Location: clients_list.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Edit Client</title>
<link rel="stylesheet" href="../../assesment/styles/pages.css">
</head>

<body class="body">
<?php include "../nav.php"; ?>
<div class="flex justify-center">
    <div class="h-1/2 w-lg rounded-3xl shadow-lg text-lg text-black flex flex-col text-center items-center addForm m-10">
      <h2 class="text-4xl font-serif font-bold text-center">Edit Client</h2>
      <p style="color:red;"><?php echo $message; ?></p>
      
      <form method="post">
        <label>Full Name*</label>
        <input class="w-sm"type="text" name="full_name" value="<?php echo $client['full_name']; ?>">
      
        <label>Email*</label>
        <input class="w-sm" type="text" name="email" value="<?php echo $client['email']; ?>">
      
        <label>Phone</label>
        <input class="w-sm" type="text" name="phone" value="<?php echo $client['phone']; ?>">
      
        <label>Address</label>
        <input class="w-sm" type="text" name="address" value="<?php echo $client['address']; ?>">
      
        <button class="w-sm" type="submit" name="update">Update</button>
      </form>
    </div>
  </div>

</body>
</html>