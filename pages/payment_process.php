<?php
include "../db.php";
 
 
$booking_id = $_GET['booking_id'];
 
 
$booking = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM bookings WHERE booking_id=$booking_id"));
 
 
$paidRow = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS paid FROM payments WHERE booking_id=$booking_id"));
$total_paid = $paidRow['paid'];
 
 
$balance = $booking['total_cost'] - $total_paid;
$message = "";
 
 
if (isset($_POST['pay'])) {
  $amount = $_POST['amount_paid'];
  $method = $_POST['method'];
 
 
  if ($amount <= 0) {
    $message = "Invalid amount!";
  } else if ($amount > $balance) {
    $message = "Amount exceeds balance!";
  } else {
 
 
    // 1) Insert payment
    mysqli_query($conn, "INSERT INTO payments (booking_id, amount_paid, method)
      VALUES ($booking_id, $amount, '$method')");
 
 
    // 2) Recompute total paid (after insert)
    $paidRow2 = mysqli_fetch_assoc(mysqli_query($conn, "SELECT IFNULL(SUM(amount_paid),0) AS paid FROM payments WHERE booking_id=$booking_id"));
    $total_paid2 = $paidRow2['paid'];
 
 
    // 3) Recompute new balance
    $new_balance = $booking['total_cost'] - $total_paid2;
 
 
    // 4) If fully paid, update booking status to PAID
    if ($new_balance <= 0.009) {
      mysqli_query($conn, "UPDATE bookings SET status='PAID' WHERE booking_id=$booking_id");
    }
 
 
    header("Location: bookings_list.php");
    exit;
  }
}
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Process Payment</title></head>
<body>
<?php include "../nav.php"; ?>
 
<div class="flex justify-center">
    <div class="size-fit w-1/2 rounded-3xl shadow-lg text-lg text-black flex flex-col text-center items-center addForm m-10">
      <h2 class="text-4xl font-serif font-bold text-center mb-6">Process Payment (Booking #<?php echo $booking_id; ?>)</h2>
 
      <div class="flex justify-center gap-10">
        <div class=" bg-neutral-200 rounded-lg p-2 w-50 "><p class="text-lg pr-4">Total Cost: ₱<?php echo number_format($booking['total_cost'],2); ?></p> </div>
        <div class=" bg-neutral-200 rounded-lg p-2 w-50 "><p class="text-lg pr-4">Total Paid: ₱<?php echo number_format($total_paid,2); ?></p></div>
        <div class=" bg-neutral-200 rounded-lg p-2 w-50 "><p class="text-lg pr-4">Balance: ₱<?php echo number_format($balance,2); ?></p></div>  
      </div>
      
      <p style="color:red;"><?php echo $message; ?></p>
        
      
      <form method="post" class="flex flex-col gap-2 mt-4">
        <label>Amount Paid</label>
        <input class="w-sm" type="number" name="amount_paid" step="0.01">
      
        <label>Method</label>
        <select class="w-sm" name="method">
          <option value="CASH">CASH</option>
          <option value="GCASH">GCASH</option>
          <option value="CARD">CARD</option>
        </select>
      
      
        <button class="w-sm" type="submit" name="pay">Save Payment</button>
      </form>
      
    </div>
  </div> 
</body>
</html>