
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="css/addcomp.css">
    <?php include_once 'includes/head.php' ?>
    <style>

.dialogue-box {
    background-color: white; /* Light background for the dialogue box */
    border: 1px solid #ddd; /* Light border for a subtle definition */
    border-radius: 8px; /* Rounded corners for the dialogue box */
    padding: 10px 15px; /* Padding inside the dialogue box */
    position: relative; /* Enables the use of absolute positioning for pseudo-elements */
    margin: 10px 0; /* Adds some space around the dialogue box */
    max-width: 80%; /* Limits the width of the dialogue box */
}

.dialogue-box::before, .dialogue-box::after {
    content: ''; /* Necessary for pseudo-elements */
    position: absolute; /* Absolute positioning relative to the dialogue box */
    bottom: 100%; /* Positions the tip above the dialogue box */
    left: 20px; /* Position from the left */
    border: solid transparent; /* Transparent border */
    height: 0; /* Height of the pseudo-element */
    width: 0; /* Width of the pseudo-element */
    pointer-events: none; /* Ensures the tip doesn't interfere with mouse events */
    /* filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5)); Apply shadow effect to the entire box, including the tip */
}

.dialogue-box::before {
    border-color: rgba(255, 255, 255, 0); /* Transparent border color */
    border-bottom-color: #ddd; /* Color of the tip's border to match the dialogue box border */
    border-width: 10px; /* Size of the tip */
    margin-left: -10px; /* Centers the tip */
}

.dialogue-box::after {
    border-color: rgba(249, 249, 249, 0); /* Transparent border color */
    border-bottom-color: #f9f9f9; /* Color of the tip to match the dialogue box background */
    border-width: 9px; /* Slightly smaller than the ::before pseudo-element to create the effect */
    margin-left: -9px; /* Centers the tip */
    
}
.content-background{
    background-color: lightgray;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    /* filter: drop-shadow(0 2px 4px rgba(0,0,0,0.5)); /* Apply shadow effect to the entire box, including the tip */
    /* box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2); Stronger shadow effect */ */
}
    </style>
</head>
<body>
    <div>
    	<img id="img2" src="../images/feedicon.png" width="550px" style="position: absolute; position: fixed; z-index: 1; margin-left: 60%; margin-top: 18vh;">
    </div>
    <img src="../images/feed.png" id="img1" style="position: fixed;">
    	<?php include_once 'includes/nav.php' ?>
    <div class="content" style="margin-top: 20px; margin-left: 10px;">
    	<h1 class="form-row justify-content-center" style="margin-left: 100px;">FEED</h1> <br>
    	<div class="pre-scrollable" style="width: 700px; height: 400px; scroll-behavior: auto;">
         <div style="max-height: 90vh;">
             <div class="card" style="border: none;">
        <div class="content-background">
            <div class="card-body">
                <?php
                    $sql = "select * from feed order by date desc, time desc;";
                    $res = mysqli_query($conn, $sql);
                    $rescheck = mysqli_num_rows($res);
                    if ($rescheck > 0) {
                        while ($row = mysqli_fetch_assoc($res)) {
                            ?>
                            <div class="capsule">
                                <h6 class="card-title" style="color: black; width: 15%; padding: 10px 0; font-weight: bold; background: grey; border: none; border-radius: 6px; cursor: pointer; transition: background 0.3s ease-in-out; text-align: center;"><i class="far fa-user-circle"></i>&nbsp;<?php echo $row['user']; ?></h6>
                            </div>
                            <div class="dialogue-box">
                                <p class="card-text"><?php echo $row['message']; ?></p>
                            </div>
                          
                            <p><small><?php echo $row['date']; ?></small></p> 
                            <?php
                        }
                    }
                ?>
            </div>
        </div>
        </div>  
        </div>    
        </div> 
    <form action="php/feed.inc.php" method="POST" style="margin: 20px auto; display: block; width: 80%; max-width: 500px; background-color: #f2f2f2; padding: 20px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
          <div class="form-group">
            <textarea class="form-control" style="width: 100%; padding: 10px; border-radius: 8px; border: 1px solid #ccc; box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.1);" name="message" placeholder="Post a Comment..."></textarea>
          </div>
          <div class="form-group">
            <button type="submit" class="btn" name="post" style="color: white; width: 100%; padding: 10px 0; font-weight: bold; background: linear-gradient(to right, #4181ED, #3F4261); border: none; border-radius: 8px; cursor: pointer; transition: background 0.3s ease-in-out;">Post</button>
          </div>
    </form> 
    </div>
    <?php include_once 'includes/footer.php' ?>
    <script type="text/javascript" src="includes/jquery31.js"></script>
    <script>
      $(document).ready(function() {
         $("#add").removeClass("active");
        $("#cat").addClass("active");
      });
    </script>
</body>
</html>