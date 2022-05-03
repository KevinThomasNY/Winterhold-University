<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drop Prerequisite</title>
    <link
      rel="shortcut icon"
      type="image/png"
      href="../../resources/images/favicon.png"
    />
    <link rel="stylesheet" href="../../css/home.css">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body>
</body>

</html> <?php
session_start();
include ("../db.php");
if (isset($_SESSION['sess_user_id']) && $_SESSION['sess_user_id'] != "") {
    #echo '<h1>Welcome '.$_SESSION['sess_first_name']. " " .$_SESSION['sess_last_name']. '</h1>';
    
} else {
    header('location:../login.php');
}
$prereq_id = trim($_GET['prereq_id']);
$course_id = trim($_GET['course_id']);
try {
    $query = "DELETE from prerequite where course_id = '".$course_id."' and prereq_id = '".$prereq_id."';";

    $stmt = $db->prepare($query);
    $stmt->execute();
?> <script type="text/javascript">
    let timerInterval
    Swal.fire({
        title: 'Prerequisite Deleted Successfully...',
        allowOutsideClick: false,
        icon: "success",
        html: 'I will close in <b></b> milliseconds.',
        timer: 2000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading()
            const b = Swal.getHtmlContainer().querySelector('b')
            timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
            }, 100)
        },
        willClose: () => {
            clearInterval(timerInterval)
        }
    }).then((result) => {
        /* Read more about handling dismissals below */
        if (result.dismiss === Swal.DismissReason.timer) {
            console.log('I was closed by the timer')
        }
    }).then(function() {
        window.location = "home_course_catolog.php";
    })
</script> <?php
    // header('location:./student_hold.php');
    
}
catch(PDOException $e) {
?> <script type="text/javascript">
    Swal.fire({
        icon: 'error',
        title: 'Error...',
        text: 'Something went wrong',
        allowOutsideClick: false,
        allowEscapeKey: false,
        confirmButtonText: 'Take me back to course catolog!',
    }).then(function() {
        window.location = "home_course_catolog.php";
    })
</script> <?php
}
?>