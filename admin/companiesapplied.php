<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Document</title>
  <!-- <link rel="stylesheet" type="text/css" href="css/addcomp.css"> -->
  <?php include_once 'includes/head.php' ?>
  <style>
      .table-responsive {
    overflow-x: auto; /* Ensures the table is responsive */
}

.table {
    width: 100%; /* Full width */
    border-collapse: collapse; /* Collapses borders */
    background-color: white; /* White background for the table */
    color: black; /* Text color */
    border-radius: 8px; /* Makes edges curvy */
    overflow: hidden; /* Ensures content respects border radius */
}

.table th, .table td {
    text-align: left; /* Aligns text to the left */
    padding: 12px; /* Adds padding */
    border-bottom: 1px solid #dee2e6; /* Adds a subtle border to the bottom of each cell */
    color: black; /* White text color */
}

.table thead {
    background-color: lightgrey; /* Blue background for the header */
    color: black; /* White text color */
}

.table tbody tr:hover {
    background-color: #375a7f; /* Darker shade on hover */
}

.table tbody td a {
    display: inline-block; /* Allows padding and margin */
    margin: 0 5px; /* Space between buttons */
    padding: 5px 10px; /* Padding inside buttons */
    color: black; /* White text color */
}
body {
    background-image: url('training.png');
    background-size: cover; /* Cover the entire page */
    background-position: center; /* Center the background image */
    background-repeat: no-repeat; /* Do not repeat the image */
}
  </style>
</head>
<body>
  <?php include_once 'includes/nav.php' ?>
  <div class="container">
    <h1 class="form-row justify-content-center" style="margin-left: 100px; font-weight: bold">View Company</h1> <br>
    <form method="POST">
      <input type="text" name="search" placeholder="Search by company name" style="border-radius: 8px;">
      <input type="submit" name="submit" value="Search" style="border-radius: 8px;">
    </form>
    <div class="table-responsive">
      <table class="table table-hover table-borderless table-dark">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Company Name</th>
            <th scope="col">Student Name</th>
            <th scope="col">Status</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $sql = "SELECT * FROM applied";
            if (isset($_POST['search'])) {
              $search = mysqli_real_escape_string($conn, $_POST['search']);
              $sql .= " WHERE company LIKE '%$search%'";
            }
            $sql .= ";";
            $res = mysqli_query($conn, $sql);
            $rescheck = mysqli_num_rows($res);
            if($rescheck > 0) {
              while ($row = mysqli_fetch_assoc($res)) {
                echo '<tr>';
                echo '<td>'.$row['id'].'</td>';
                echo '<td>'.$row['company'].'</td>';
                echo '<td>'.$row['name'].'</td>';
                echo '<td>'.$row['status'].'</td>';
                echo '</tr>';
              }
            }
          ?>
        </tbody>
      </table>
    </div>
  </div>
  <?php include_once 'includes/footer.php' ?>
</body>
</html>