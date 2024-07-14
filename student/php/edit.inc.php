<?php
if (isset($_POST['edit'])) {
    include_once '../includes/db.inc.php';
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $uname = mysqli_real_escape_string($conn, $_POST['uname']);
    $fname = mysqli_real_escape_string($conn, $_POST['fname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);
    $yop = mysqli_real_escape_string($conn, $_POST['yop']);
    $percentage = mysqli_real_escape_string($conn, $_POST['percentage']);
    $sslc = mysqli_real_escape_string($conn, $_POST['sslc']);
    $puc = mysqli_real_escape_string($conn, $_POST['puc']);

    if(isset($_FILES['resume'])) {
        $resume = $_FILES['resume'];
        $resumeName = $_FILES['resume']['name'];
        $resumeTmpName = $_FILES['resume']['tmp_name'];
        $resumeSize = $_FILES['resume']['size'];
        $resumeError = $_FILES['resume']['error'];
        $resumeType = $_FILES['resume']['type'];

        $resumeExt = pathinfo($resumeName, PATHINFO_EXTENSION);
        $allowedExtensions = ['pdf'];

        if(in_array($resumeExt, $allowedExtensions)) {
            if($resumeError === 0) {
                if($resumeSize < 1000000) { // 1MB
                    $resumeNewName = "resume_".$id.".".$resumeExt;
                    $resumeDestination = '../resumes/'.$resumeNewName;
                    move_uploaded_file($resumeTmpName, $resumeDestination);
                    $sql = "UPDATE studentlogin SET uname=?, fname=?, lname=?, email=?, phone=?, course=?, yop=?, percentage=?, sslc=?, puc=?, resume=? WHERE id=?";
                    $stmt = mysqli_stmt_init($conn);
                    if (!mysqli_stmt_prepare($stmt, $sql)) {
                        ?>
                        <script>
                            alert("SQL error occurred!");
                            window.location.replace("../editprofile.php");
                        </script>
                    <?php
                    } else {
                        mysqli_stmt_bind_param($stmt, "sssssssssssi", $uname, $fname, $lname, $email, $phone, $course, $yop, $percentage, $sslc, $puc, $resumeDestination, $id);
                        mysqli_stmt_execute($stmt);
                        ?>
                        <script>
                            alert("Profile has been edited");
                            window.location.replace("../editprofile.php");
                        </script>  
                        <?php
                    }
                } else {
                    echo "Your file is too big!";
                }
            } else {
                echo "There was an error uploading your file!";
            }
        } else {
            echo "You cannot upload files of this type!";
        }
    }
}
?>
