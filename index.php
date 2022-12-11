<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD Operations</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
  <div class='container my-5'>
    <h2>List of Clients</h2>
    <a class='btn btn-primary' href="/create.php" role='button'>New Client</a>
    <table class="table">
      <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Address</th>
          <th>Created At</th>
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $server_name = "localhost";
        $user_name = "root";
        $password = "";
        $database = "CRUD";

        $connection = new mysqli($server_name, $user_name, $password, $database);

        if($connection->connect_error) {
          die("Connection failed: " . $connection->connect_error);
        }

        $sql = "SELECT FROM clients";
        $result = $connection->query($sql);

        if(!$result) {
          die("Invalid query: " . $connection->error);
        }

        while($row = $result->fetch_assoc()) {
          echo "
          <tr>
          <td>$row[id]</td>
          <td>$row[name]</td>
          <td>$row[email]</td>
          <td>$row[phone]</td>
          <td>$row[address]</td>
          <td>$row[created_at]</td>
          <td>
            <a class='btn btn-primary btn-sm' href='/edit.php'>Edit</a>
            <a class='btn btn-danger btn-sm' href='/delete.php'>Delete</a>
          </td>
        </tr>
          ";
        }
         ?>
      </tbody>
    </table>
  </div>
</body>
</html>