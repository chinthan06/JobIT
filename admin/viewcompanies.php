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
    border-collapse: separate; /* Use separate to allow border-radius */
    border-spacing: 0; /* Removes the default spacing */
    background-color: whitesmoke; /* White background for the table */
    color: black; /* Text color */
    border-radius: 10px; /* Curvy edges */
    overflow: hidden; /* Ensures the inner elements don't overflow the rounded corners */
}

.table th, .table td {
    text-align: left; /* Aligns text to the left */
    padding: 12px; /* Adds padding */
    border-bottom: 1px solid #dee2e6; /* Adds a subtle border to the bottom of each cell */
    color: black; /* White text color */
}

.table thead {
    background-color: lightgray; /* Blue background for the header */
    color: black; 
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

.table tbody td a:hover {
    text-decoration: none; /* Removes underline on hover */
}

.btn-edit {
    background-color: #f39c12; /* Orange background */
}

.btn-edit:hover {
    background-color: #e67e22; /* Darker orange on hover */
}

.btn-delete {
    background-color: #d9534f; /* Red background */
}

.btn-delete:hover {
    background-color: #c9302c; /* Darker red on hover */
}

/* Custom icons color */
.fas.fa-pen {
    color: #ffffff; /* White color for edit icon */
}

.fas.fa-trash {
    color: #ffffff; /* White color for delete icon */
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
      <h1 class="form-row justify-content-center" style="margin-left: 100px; font-weight: bold;">View Company</h1> <br>
       <form method="GET">
        <input type="text" name="search" placeholder="Search by company name" style="border-radius: 5px;">
         <input type="submit" value="Search" style = "border-radius: 5px;">
       </form>
       <br>
       <div class="table-responsive">
        <table class="table table-hover table-borderless table-dark">
          <thead>
            <tr>
              <th scope="col">Company Name</th>
              <th scope="col">Type</th>
              <th scope="col">Website</th>
              <th scope="col">Phone</th>
              <th scope="col">Status</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
              $search = isset($_GET['search']) ? $_GET['search'] : '';
              $sql = "SELECT * FROM company WHERE name LIKE '%$search%' ORDER BY id;";
              $res = mysqli_query($conn, $sql);
              $rescheck = mysqli_num_rows($res);
              if($rescheck > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    echo '<tr>';
                      echo '<td>'.$row['name'].'</td>';
                      echo '<td>'.$row['type'].'</td>';
                      echo '<td>'.$row['website'].'</td>';
                      echo '<td>'.$row['number'].'</td>';
                      echo '<td>'.$row['status'].'</td>';
                      ?>
                      <td>
                        <a href="editcomp.php?edit=<?php echo $row['id']; ?>" class="btn btn-sm btn-edit" name="editcomp"><i class="fas fa-pen"></i></a>
                        <a href="php/crud.php?delete=<?php echo $row['id']; ?>" class="btn btn-sm btn-delete" name="deletecomp"><i class="fas fa-trash"></i></a>
                      </td>
                      <?php
                    echo '</tr>';
                }
              }
             ?>
          </tbody>
        </table>
        </div>
       </form>
    </div>
    <?php include_once 'includes/footer.php' ?>
</body>
</html>