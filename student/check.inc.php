<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <?php include_once 'includes/head.php' ?>
</head>
<body>
    <div>
        <img id="img2" src="../images/graph1.svg" width="600px" style="position: absolute; position: fixed; z-index: 1; margin-left: 55%;
         margin-top: 19vh;">
    </div>
    <img src="../images/apply.png" id="img1" style="position: fixed;">
        <?php include_once 'includes/nav.php' ?> 
    <div class="content" style="margin-top: 10px; margin-left: 30px;">
    <br> <br><h2><u>Apply For a Company</u></h2>
        <br> <br> <br> 
        <?php
    include_once '../includes/db.inc.php';
    if (isset($_POST['check'])) {
        $company = $_POST['company'];
        $user = $_SESSION['username'];
        $sql = "select * from company where name='$company';";
        $res = mysqli_query($conn, $sql);
        if (mysqli_num_rows($res) > 0) {
            while ($row = mysqli_fetch_assoc($res)) {
                $compperc = $row['minperc'];
                $sql1 = "select * from studentlogin where fname='$user';";
                $res1 = mysqli_query($conn, $sql1);
                if (mysqli_num_rows($res1) > 0) {
                    while ($row1 = mysqli_fetch_assoc($res1)) {
                        $studperc = $row1['percentage'];
                        if ($studperc >= $compperc && $studperc > 40) { // Checking if student percentage is greater than 40
                            echo "<h5>You are eligible to apply for $company</h5>";
                            echo '<a href="php/apply.inc.php?comp='.$company.'" class="btn" style="width: 150px; color: white; font-weight: bold; background: linear-gradient(to left, #F55197, #EE891A);" name="apply">Apply</a>';
                        } else {
                            echo "<h5>Sorry, you are not eligible to apply for $company at this time. Minimum percentage requirement not met.</h5>";
                        }
                    }
                }
            }
        }
    }
    ?>
    </div>
    <br> <br> <br> <br> <br>
   

    <?php include_once 'includes/footer.php' ?>
    <script>
      $(document).ready(function() {
         $("#home").removeClass("active");
        $("#apply").addClass("active");
        
      });
    </script>
</body>
</html>
