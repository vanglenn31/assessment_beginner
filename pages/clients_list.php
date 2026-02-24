<?php
include "../db.php";
$result = mysqli_query($conn, "SELECT * FROM clients ORDER BY client_id DESC");
?>
<!doctype html>
<html>
<head><meta charset="utf-8"><title>Clients</title>
<link rel="stylesheet" href="../../assesment/styles/pages.css">
</head>

<body class="body">
<?php include "../nav.php"; ?>
  <div class="flex justify-center">
    <div class="size-fit w-3/4 rounded-3xl shadow-lg text-lg text-black flex flex-col text-center items-center addForm m-10">
      <h2 class="text-4xl font-serif font-bold text-center mb-6">Clients</h2>
      
      <table class="show-data" border="1" cellpadding="8">
        <tr>
          <th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Action</th>
        </tr>
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $row['client_id']; ?></td>
            <td><?php echo $row['full_name']; ?></td>
            <td><?php echo $row['email']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td>
              <a class="edit-btn" href="clients_edit.php?id=<?php echo $row['client_id']; ?>">Edit</a>
            </td>
          </tr>
        <?php } ?>
      </table>
      <p class="addClientbtn"><a href="clients_add.php">+ Add Client</a></p>
    </div>
  </div>
</body>
</html>