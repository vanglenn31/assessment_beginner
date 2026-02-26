<?php
include "../db.php";
 
$clients = mysqli_query($conn, "SELECT * FROM clients ORDER BY full_name ASC");
$services = mysqli_query($conn, "SELECT * FROM services WHERE is_active=1 ORDER BY service_name ASC");
 
if (isset($_POST['create'])) {
  $client_id = $_POST['client_id'];
  $service_id = $_POST['service_id'];
  $booking_date = $_POST['booking_date'];
  $hours = $_POST['hours'];
 
  // get service hourly rate
  $s = mysqli_fetch_assoc(mysqli_query($conn, "SELECT hourly_rate FROM services WHERE service_id=$service_id"));
  $rate = $s['hourly_rate'];
 
  $total = $rate * $hours;
 
  mysqli_query($conn, "INSERT INTO bookings (client_id, service_id, booking_date, hours, hourly_rate_snapshot, total_cost, status)
    VALUES ($client_id, $service_id, '$booking_date', $hours, $rate, $total, 'PENDING')");
 
  header("Location: bookings_list.php");
  exit;
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Create Booking</title>
<link rel="stylesheet" href="../../assesment/styles/pages.css">
</head>
<body class="body">
<?php include "../nav.php"; ?>

  <div class="flex justify-center">
      <div class="h-1/2 w-lg rounded-3xl shadow-lg text-lg text-black flex flex-col text-center items-center addForm m-10">
 
      <h2 class="text-4xl font-serif font-bold text-center">Create Booking</h2>
      
      <form method="post" class="flex flex-col">
        <label class="mt-4">Client</label>
        <select class="w-sm " name="client_id">
          <?php while($c = mysqli_fetch_assoc($clients)) { ?>
            <option value="<?php echo $c['client_id']; ?>"><?php echo $c['full_name']; ?></option>
          <?php } ?>
        </select>
      
        <label class="mt-4">Service</label>
        <select class="w-sm" name="service_id">
          <?php while($s = mysqli_fetch_assoc($services)) { ?>
            <option value="<?php echo $s['service_id']; ?>">
              <?php echo $s['service_name']; ?> (₱<?php echo number_format($s['hourly_rate'],2); ?>/hr)
            </option>
          <?php } ?>
        </select>
        <div class="flex gap-6 mt-4 w-sm" >
          <div class="flex flex-col w-1/2">
            <label>Date</label>
            <input  type="date" name="booking_date">
          </div>
          <div class="flex flex-col w-1/2">
            <label>Hours</label>
            <input type="number" name="hours" min="1" value="1">
          </div>
        </div>
      
        <button class="w-sm" type="submit" name="create">Create Booking</button>
      </form>
    </div>
  </div>
</body>
</html>