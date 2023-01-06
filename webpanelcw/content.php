<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
require_once('config/surprise_db.php');
error_reporting(0);
session_start();
if (!isset($_SESSION['admin_login'])) {
    echo "<script>alert('กรุณา เข้าสู่ระบบ')</script>";
    echo "<meta http-equiv='refresh' content='0;url=login'>";
}

$data_content = $conn->prepare("SELECT * FROM content");
$data_content->execute();
$row_content = $data_content->fetchAll();



if (isset($_POST['change-status'])) {
    $check = $_POST['check'];
    $id = $_POST['id'];
    // echo "<script>alert('dddddd $check')</script>";
    $stmt = $conn->prepare("UPDATE content SET status = :status WHERE id =  :id");
    $stmt->bindParam(":status", $check);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    if ($stmt) {
        echo "<script>
        $(document).ready(function() {
            Swal.fire({
                text: 'เปลี่ยนสถานะเรียบร้อยแล้ว',
                icon: 'success',
                timer: 10000,
                showConfirmButton: false
            });
        })
        </script>";
        echo "<meta http-equiv='refresh' content='2;url=content'>";
    } else {
        echo "<script>alert('มีบางอย่างผิดพลาด!!!')</script>";
        echo "<meta http-equiv='refresh' content='2;url=content'>";
    }
}


// if (isset($_GET['id'])) {
//     $content_id = $_GET['id'];

//         $del_content = $conn->prepare("DELETE FROM content WHERE id = :content_id");
//         $del_content->bindParam(":content_id", $content_id);
//         $del_content->execute();

//         if ($del_content) {


//             echo "<script>
//             $(document).ready(function() {
//                 Swal.fire({
//                     text: 'ลบข้อมูลเรียบร้อยแล้ว',
//                     icon: 'success',
//                     timer: 10000,
//                     showConfirmButton: false
//                 });
//             })
//             </script>";
//             echo "<meta http-equiv='refresh' content='2;url=content'>";
//         } else {
//             echo "<script>alert('มีบางอย่างผิดพลาด!!!')</script>";
//             echo "<meta http-equiv='refresh' content='2;url=content'>";
//        }

// }


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surpriseboxth</title>
    <link rel="stylesheet" href="assets/css/shared/iconly.css">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/main/app.css">
    <!-- <link rel="stylesheet" href="assets/css/main/app-dark.css"> -->
    <link rel="stylesheet" href="css/content.css?v=<?php echo time(); ?>">
    <!-- <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon"> -->
    <link rel="shortcut icon" href="images/logo.png" type="image/png">

    <link rel="stylesheet" href="assets/css/shared/iconly.css">

</head>

<body style = "font-family: 'Kanit', sans-serif;">
    <div id="app">
        <?php include('sidebar.php'); ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Content</h3>
            </div>
            <section class="section">
                <form method="post">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"></h4>
                            <!-- <div class="flex-end">

                                <a href="content_add"><button type="button"
                                        class="btn btn-edit">เพิ่มข้อมูล</button></a>
                                <button type="submit" onclick="return confirm('ต้องการลบเนื้อหานี้ใช่หรือไม่?');"
                                    name="delete_all" class="btn btn-del">ลบข้อมูล</button>

                            </div> -->

                        </div>


                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead align="center">
                                        <tr>
                                            <!-- <th scope="col">
                                                <input type="checkbox" class="form-check-input checkbox-select"
                                                    id="select_all">
                                            </th> -->
                                            <th scope="col">รูปภาพ</th>
                                            <th scope="col">รายละเอียด</th>
                                            <!-- <th scope="col">สถานะ</th> -->
                                            <th scope="col">จัดการ</th>
                                        </tr>
                                    </thead>
                                    <?php
                                    for ($i = 0; $i < count($row_content); $i++) {
                                    ?>
                                    <tbody>
                                        <tr>
                                            <!-- <td align="center">
                                                <input type="checkbox" class="form-check-input checkbox checkbox-select"
                                                    name="ids[]" value=<?php echo $row_content[$i]['id'] ?>>
                                            </td> -->
                                            <td align="center" width="20%">
                                                <img width="50%"
                                                    src="upload/upload_content/<?php echo $row_content[$i]['img']; ?>"
                                                    alt="">
                                            </td>
                                            <td align="left"><?php echo $row_content[$i]['detail']; ?></td>
                                            <!-- <td align="center">
                                                <a type="input" class="btn" <?php if ($row_content[$i]['status'] == "on") {
                                                                                    echo " style='background-color: #06c258'";
                                                                                } else {
                                                                                    echo " style='background-color: #ff4122'";
                                                                                } ?> data-bs-toggle="modal"
                                                    href="#status<?php echo $row_content[$i]['id'] ?>" id="setting"><i
                                                        class="bi bi-gear"></i></a>

                                            </td> -->
                                            <td align="center">
                                                <div class="manage">
                                                    <a href="content_edit?id=<?php echo $row_content[$i]['id']; ?>"><button
                                                            type="button" class="btn"
                                                            style="background-color:#ffc107; color: #FFFFFF;"><i
                                                                class="bi bi-pencil-square"></i></button></a>
                                                   <!-- <a href="?id=<?php echo $row_content[$i]['id']; ?>" class="btn"
                                                        onclick="return confirm('ต้องการลบข้อมูลใช่หรือไม่?');"
                                                        name="delete_all"
                                                        style="background-color:#ff4122; color: #FFFFFF;"><i
                                                            class="bi bi-trash"></i></a> -->
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <!-- <div class="modal fade" id="status<?php echo $row_content[$i]['id'] ?>"
                                        data-bs-backdrop="static" aria-hidden="true">
                                        <div class="modal-dialog  modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">ตั้งค่าสถานะ
                                                    </h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-check form-switch">
                                                        <form method="post">
                                                            <div class="switch-box">
                                                                <span>OFF</span>
                                                                <input type="hidden" name="id"
                                                                    value="<?php echo $row_content[$i]['id']; ?>">
                                                                <input class="form-check-input" id="switch-check"
                                                                    name="check" type="checkbox"
                                                                    <?php if ($row_content[$i]['status'] == "on") {
                                                                                                                                                        echo "checked";
                                                                                                                                                    } else {
                                                                                                                                                        echo "";
                                                                                                                                                    } ?>>
                                                                <span>ON</span>
                                                            </div>
                                                            <div class="box-btn">
                                                                <button name="change-status" class="btn btn-status"
                                                                    type="submit">บันทึก</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div> -->
                                    <?php }
                                    ?>

                                </table>
                            </div>
                        </div>
                    </div>
                </form>
            </section>
            <?php include('footer.php'); ?>
        </div>
    </div>

    <script>
    //for checkbox
    $(document).ready(function() {
        $('#select_all').on('click', function() {
            if (this.checked) {
                $('.checkbox').each(function() {
                    this.checked = true;
                })
            } else {
                $('.checkbox').each(function() {
                    this.checked = false;
                })
            }
        })
        $('.checkbox').on('click', function() {
            if ($('.checkbox:checked').length == $('.checkbox').length) {
                $('#select_all').prop('checked', true);
            } else {
                $('#select_all').prop('checked', false);
            }
        })
    });
    </script>

    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

</body>

</html>