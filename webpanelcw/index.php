<?php
require_once('config/surprise_db.php');
session_start();
error_reporting(0);
if (!isset($_SESSION['admin_login'])) {
    echo "<script>alert('กรุณา เข้าสู่ระบบ')</script>";
    echo "<meta http-equiv='refresh' content='0;url=login'>";
}


$stmt = $conn->prepare("SELECT * FROM slide");
$stmt->execute();
$row_slide = $stmt->fetch(PDO::FETCH_ASSOC);

$stmt = $conn->prepare("SELECT * FROM slide_img");
$stmt->execute();
$row_img = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surpriseboxth</title>

    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="css/index.css">
    <!-- <link rel="stylesheet" href="assets/css/main/app-dark.css"> -->
    <!-- <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon"> -->
    <link rel="shortcut icon" href="images/logo.png" type="image/png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/shared/iconly.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
</head>

<body style="font-family: 'Kanit', sans-serif;">
    <div id="app">
        <?php include('sidebar.php'); ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Home</h3>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"></h4>
                        <a href="index_edit"><button type="button" class="btn btn-edit">แก้ไข</button></a>
                    </div>
                    <div class="card-body">
                        <?php echo $row_slide['title']; ?>
                        <?php echo $row_slide['content']; ?>

                    </div>
                    <div class="card-body">
                        <div class="pre-img">
                            <img width="100%" src="upload/upload_home/<?php echo $row_img[0]['img']; ?>" alt="">
                        </div>
                    </div>
                </div>

            </section>
            <?php include('footer.php'); ?>
        </div>
    </div>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

</body>

</html>