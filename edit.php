<?php 

$server_name = "localhost";
$user_name = "Virag";
$password = "Beautyflower1";
$database = "CRUD";

$connection = new mysqli($server_name, $user_name, $password, $database);

$name = $email = $phone = $address = $errorMessage = $successMessage = $id = '';

if($_SERVER['REQUEST_METHOD'] == 'GET') {
  // GET method: show the data of the client

  if(!isset($_GET["id"])) {
    header("location: ./index.php");
    exit;
  }

  $id = $_GET["id"];

  // read the selected row of the client from the database table

  $sql = "SELECT * FROM clients WHERE id=$id";
  $result = $connection->query($sql);
  $row = $result->fetch_assoc();

  if(!$row) {
    header("location: ./index.php");
    exit;
  }

  $name = $row["name"];
  $email = $row["email"];
  $phone = $row["phone"];
  $address = $row["address"];

} else {
  // POST method: update the data of the client

  $name = $_POST["name"];
  $email = $_POST["email"];
  $phone = $_POST["phone"];
  $address = $_POST["address"];

  do {
    if(empty($name) || empty($email) || empty($phone) || empty($address)) {
      $errorMessage = "All the fields are required!";
      break;
    }

    $sql = "UPDATE clients " . "SET name = $name, email = $email, phone = $phone, address = $address" . "WHERE id = $id";
    $result = $connection->query($sql);

    if(!$result) {
      $errorMessage = "Invalid query: " . $connection->error;
      break;
    }

    $successMessage = "Client added correctly!";

    header("location: ./index.php");

  } while (false);

}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>CRUD</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</head>
<body>
  <div class='container my-5'>
    <h2>New Client</h2>
    <?php 

      if(!empty($errorMessage)) {
      echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
      <strong>$errorMessage</strong>
      <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
     </div>";
      }

     ?>
    <form method='POST'>
      <input type="hidden" value="<?php echo $id; ?>" name='id'>
      <div class='row mb-3'>
        <label class='col-sm-3 col-form-label'>Name</label>
        <div class='col-sm-6'>
          <input type="text" class='form-control' name='name' value="<?php echo $name; ?>">
        </div>
      </div>
      <div class='row mb-3'>
        <label class='col-sm-3 col-form-label'>Email</label>
        <div class='col-sm-6'>
          <input type="text" class='form-control' name='email' value="<?php echo $email; ?>">
        </div>
      </div>
      <div class='row mb-3'>
        <label class='col-sm-3 col-form-label'>Phone</label>
        <div class='col-sm-6'>
          <input type="text" class='form-control' name='phone' value="<?php echo $phone; ?>">
        </div>
      </div>
      <div class='row mb-3'>
        <label class='col-sm-3 col-form-label'>Address</label>
        <div class='col-sm-6'>
          <input type="text" class='form-control' name='address' value="<?php echo $address; ?>">
        </div>
      </div>
      <?php 
      
        if(!empty($successMessage)) {
        echo "<div class='row mb-3'>
        <div class='offset-sm-3 col-sm-6'>
          <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>$successMessage</strong>
            <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>
        </div>
      </div>";
        }
      
      ?>
      <div class='row mb-3'>
        <div class='offset-sm-3 col-sm-3 d-grid'>
          <button class='btn btn-primary' type='submit'>Submit</button>
        </div>
        <div class='col-sm-3 d-grid'>
          <a href="./index.php" class='btn btn-outline-primary' role='button'>Cancel</a>
        </div>
      </div>
    </form>
  </div>
</body>
</html>