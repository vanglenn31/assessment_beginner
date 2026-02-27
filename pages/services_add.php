<?php
include "../db.php";
 
$message = "";
 
if (isset($_POST['save'])) {
  $service_name = $_POST['service_name'];
  $description = $_POST['description'];
  $hourly_rate = $_POST['hourly_rate'];
  $is_active = $_POST['is_active'];
 
  // simple validation
  if ($service_name == "" || $hourly_rate == "") {
    $message = "Service name and hourly rate are required!";
  } else if (!is_numeric($hourly_rate) || $hourly_rate <= 0) {
    $message = "Hourly rate must be a number greater than 0.";
  } else {
    $sql = "INSERT INTO services (service_name, description, hourly_rate, is_active)
            VALUES ('$service_name', '$description', '$hourly_rate', '$is_active')";
    mysqli_query($conn, $sql);
 
    header("Location: services_list.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Add Service</title></head>
<body>
<?php include "../nav.php"; ?>
 <div class="flex justify-center">
    <div class="size-fit w-lg rounded-3xl shadow-lg text-lg text-black flex flex-col items-center addForm m-10">
        <h2 class="text-4xl font-serif font-bold text-center">Add Service</h2>
        <p style="color:red;"><?php echo $message; ?></p>
        
        <form class="flex flex-col" method="post">
        <label>Service Name*</label>
        <input class="w-sm" type="text" name="service_name">
        
        <label>Description</label>
        <textarea class="w-sm" name="description" rows="4" cols="40"></textarea>
        
        <div class="flex gap-6 mt-4" >
            <div class="flex flex-col w-1/2">
                <label>Hourly Rate (₱)*</label>
                <input  type="text" name="hourly_rate">
            </div>  
            <div class="flex flex-col w-1/2">
                <label>Active?</label>
                <select  name="is_active">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>
        
        <button class="w-sm" type="submit" name="save">Save Service</button>
        </form>
</div>
</div>
 
</body>
</html>
 