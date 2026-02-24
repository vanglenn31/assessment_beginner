<?php
include "../db.php";
$id = $_GET['id'];
 
$get = mysqli_query($conn, "SELECT * FROM services WHERE service_id = $id");
$service = mysqli_fetch_assoc($get);
 
if (isset($_POST['update'])) {
  $name = $_POST['service_name'];
  $desc = $_POST['description'];
  $rate = $_POST['hourly_rate'];
  $active = $_POST['is_active'];
 
  mysqli_query($conn, "UPDATE services
    SET service_name='$name', description='$desc', hourly_rate='$rate', is_active='$active'
    WHERE service_id=$id");
 
  header("Location: services_list.php");
  exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Edit Service</title>
<link rel="stylesheet" href="../../assesment/styles/pages.css">
</head>
<body class="body">
<?php include "../nav.php"; ?>

    <div class="flex justify-center">
        <div class="size-fit w-lg rounded-3xl shadow-lg text-lg text-black flex flex-col  items-center addForm m-10">
        
            <h2 class="text-4xl font-serif font-bold text-center mb-6">Edit Service</h2>
            
            <form method="post" class=" flex flex-col">
            <label>Service Name</label>
            <input class="w-sm" type="text" name="service_name" value="<?php echo $service['service_name']; ?>">
            
            <label>Description</label>
            <textarea class="w-sm " name="description" rows="4" cols="40"><?php echo $service['description']; ?></textarea>
            <div class="flex gap-6 mt-4" >
                <div class="flex flex-col w-1/2">
                <label>Hourly Rate</label>
                <input type="text"name="hourly_rate" value="<?php echo $service['hourly_rate']; ?>">
                </div>
                <div class="flex flex-col w-1/2">
                <label>Active</label>
                <select name="is_active">
                    <option value="1" <?php if($service['is_active']==1) echo "selected"; ?>>Yes</option>
                    <option value="0" <?php if($service['is_active']==0) echo "selected"; ?>>No</option>
                </select>
                </div>
            </div>
            <button class="w-sm" type="submit" name="update">Update</button>
            </form>
        </div>
    </div>
</body>
</html>