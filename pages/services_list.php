<?php
include "../db.php";
 
 
/* ============================
   SOFT DELETE (Deactivate)
   ============================ */
if (isset($_GET['delete_id'])) {
  $delete_id = $_GET['delete_id'];
 
 
  // Soft delete (set is_active to 0)
  mysqli_query($conn, "UPDATE services SET is_active=0 WHERE service_id=$delete_id");
 
 
  header("Location: services_list.php");
  exit;
}
 
 
/* ============================
   FETCH ALL SERVICES
   ============================ */
$result = mysqli_query($conn, "SELECT * FROM services ORDER BY service_id DESC");
?>
 
 
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Services</title>
</head>
<body>
 
 
<?php include "../nav.php"; ?>
    <div class="flex justify-center">

    <div class="size-fit w-1/2 rounded-3xl shadow-lg text-lg text-black flex flex-col text-center items-center addForm m-10">
      <h2 class="text-4xl font-serif font-bold text-center mb-6">Services</h2>
 
<table class="show-data" border="1" cellpadding="8">
  <tr>
    <th>ID</th>
    <th>Name</th>
    <th>Rate</th>
    <th>Status</th>
    <th>Action</th>
  </tr>
 
 
  <?php while($row = mysqli_fetch_assoc($result)) { ?>
    <tr>
      <td><?php echo $row['service_id']; ?></td>
      <td><?php echo $row['service_name']; ?></td>
      <td>₱<?php echo number_format($row['hourly_rate'],2); ?></td>
 
 
      <td>
        <?php
          if ($row['is_active'] == 1) {
            echo "Active";
          } else {
            echo "Inactive";
          }
        ?>
      </td>
 
 
      <td>
        <a class="edit-btn" href="services_edit.php?id=<?php echo $row['service_id']; ?>">Edit</a>
 
 
        <?php if ($row['is_active'] == 1) { ?>
          |
          <a class="deactivate-btn" href="services_list.php?delete_id=<?php echo $row['service_id']; ?>"
             onclick="return confirm('Deactivate this service?')">
             Deactivate
          </a>
        <?php } ?>
      </td>
    </tr>
  <?php } ?>
 
 
</table>
<p class="addClientbtn">
  <a href="services_add.php">+ Add Service</a>
</p>
    </div>
</div>
</body>
</html>
 