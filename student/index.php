<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <?php include_once 'includes/head.php' ?>
    <style>
        .feed-container {
    margin-top: 20px;
    margin-left: 10px;
}

.feed-title {
    text-align: center;
}

.feed {
    width: 750px;
    height: 400px;
    overflow-y: auto;
    background-color: #f0f0f0;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.message-card {
    background-color: lightgrey;
    padding: 15px;
    margin-bottom: 20px;
    border-radius: 8px;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.message-date {
    color: #777;
}
    </style>
</head>
<body>
    <div>
    	<img id="img2" src="../images/feedicon.png" width="550px" style="position: absolute; position: fixed; z-index: 1; margin-left: 60%; margin-top: 18vh;">
    </div>
    <img src="../images/feed.png" id="img1" style="position: fixed;">
    	<?php include_once 'includes/nav.php' ?>
    <div class="content feed-container">
        <h1 class="feed-title">FEED</h1>
        <div class="pre-scrollable feed">
            <div class="feed-content">
                <div class="card feed-card">
                    <div class="card-body">
                        <?php
                        $sql = "select * from feed order by date desc, time desc;";
                        $res = mysqli_query($conn, $sql);
                        $rescheck = mysqli_num_rows($res);
                        if ($rescheck > 0) {
                            while ($row = mysqli_fetch_assoc($res)) {
                                ?>
                                <div class="message-card">
                                    <h5 class="card-title"><i class="far fa-user-circle"></i>&nbsp;<?php echo $row['user']; ?></h5>
                                    <p class="card-text"><?php echo $row['message']; ?></p>
                                    <p class="message-date"><small><?php echo $row['date']; ?></small></p>
                                </div>
                                <?php
                            }
                        }
                        ?>
                    </div>
                </div>  
            </div>    
        </div> 
    </div>
    <?php include_once 'includes/footer.php' ?>
    <script type="text/javascript" src="includes/jquery31.js"></script>
    <script>
      $(document).ready(function() {
         $("#add").removeClass("active");
        $("#cat").addClass("active");
        $("#heart").click(function() {
            $("#heart").toggleClass("far fa-heart");
            $("#heart").toggleClass("fas fa-heart");
        })
      });
    </script>
</body>
</html>