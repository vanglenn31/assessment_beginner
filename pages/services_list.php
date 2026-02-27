<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM services ORDER BY service_id DESC");
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Services</title></head>
<body class="body">
<?php include "../nav.php"; ?>
    <div class="flex justify-center">
        <div class="size-fit w-3/4 rounded-3xl shadow-lg text-lg text-black flex flex-col text-center items-center addForm m-10">
            <h2 class="text-4xl font-serif font-bold text-center mb-6">Services</h2>
            
            <table class="show-data" border="1" cellpadding="8">
            <tr>
                <th>ID</th><th>Name</th><th>Rate</th><th>Active</th><th>Action</th>
            </tr>
            <?php while($row = mysqli_fetch_assoc($result)) { ?>
                <tr>
                <td><?php echo $row['service_id']; ?></td>
                <td><?php echo $row['service_name']; ?></td>
                <td>₱<?php echo number_format($row['hourly_rate'],2); ?></td>
                <td><?php echo $row['is_active'] ? "Yes" : "No"; ?></td>
                <td><a class="edit-btn" href="services_edit.php?id=<?php echo $row['service_id']; ?>">Edit</a></td>
                </tr>
            <?php } ?>
            </table>
        </div>
    </div>
</body>
</html>