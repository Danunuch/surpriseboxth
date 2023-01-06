<script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
require_once('config/surprise_db.php');
session_start();
error_reporting(0);
if (!isset($_SESSION['admin_login'])) {
    echo "<script>alert('กรุณา เข้าสู่ระบบ')</script>";
    echo "<meta http-equiv='refresh' content='0;url=login'>";
}

$id = 1;

$data_contact = $conn->prepare("SELECT * FROM contact WHERE id = :id");
$data_contact->bindParam(":id", $id);
$data_contact->execute();
$row_contact = $data_contact->fetch(PDO::FETCH_ASSOC);

$data_video = $conn->prepare("SELECT * FROM video WHERE id = :id");
$data_video->bindParam(":id", $id);
$data_video->execute();
$row_video = $data_video->fetch(PDO::FETCH_ASSOC);


if (isset($_POST['edit-contact'])) {
    $company_name = $_POST['company_name'];  
    $content = $_POST['content'];
    $line = $_POST['line'];
    $facebook = $_POST['facebook'];
    $instragram = $_POST['instragram'];
    $tiktok = $_POST['tiktok'];
    $address = $_POST['address'];


                $edit_contact = $conn->prepare("UPDATE contact SET company_name=:company_name, content = :content, line = :line, facebook = :facebook, instragram = :instragram, tiktok = :tiktok, 
                                        address = :address WHERE id = :id");
                $edit_contact->bindParam(":company_name", $company_name);
                $edit_contact->bindParam(":content", $content);
                $edit_contact->bindParam(":line", $line);
                $edit_contact->bindParam(":facebook", $facebook);
                $edit_contact->bindParam(":instragram", $instragram);
                $edit_contact->bindParam(":tiktok", $tiktok);
                $edit_contact->bindParam(":address", $address);
                $edit_contact->bindParam(":id", $id);
                $edit_contact->execute();

                if ($edit_contact) {
                    echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            text: 'แก้ไขข้อมูลเรียบร้อยแล้ว',
                            icon: 'success',
                            timer: 10000,
                            showConfirmButton: false
                        });
                    })
                    </script>";
                    echo "<meta http-equiv='refresh' content='2;url=contact_us'>";
                } else {
                    echo "<script>
                    $(document).ready(function() {
                        Swal.fire({
                            text: 'มีบางอย่างผิดพลาด!!!',
                            icon: 'error',
                            timer: 10000,
                            showConfirmButton: false
                        });
                    })
                    </script>";
                }
            }



            if (isset($_POST['edit-video'])) {
                $title_link = $_POST['title_link'];  
                $link = $_POST['link'];
            
            
                            $edit_video = $conn->prepare("UPDATE video SET title_link =:title_link , link = :link WHERE id = :id");
                            $edit_video->bindParam(":title_link", $title_link);
                            $edit_video->bindParam(":link", $link);
                            $edit_video->bindParam(":id", $id);
                            $edit_video->execute();
            
                            if ($edit_video) {
                                echo "<script>
                                $(document).ready(function() {
                                    Swal.fire({
                                        text: 'แก้ไขข้อมูลเรียบร้อยแล้ว',
                                        icon: 'success',
                                        timer: 10000,
                                        showConfirmButton: false
                                    });
                                })
                                </script>";
                                echo "<meta http-equiv='refresh' content='2;url=contact_us'>";
                            } else {
                                echo "<script>
                                $(document).ready(function() {
                                    Swal.fire({
                                        text: 'มีบางอย่างผิดพลาด!!!',
                                        icon: 'error',
                                        timer: 10000,
                                        showConfirmButton: false
                                    });
                                })
                                </script>";
                            }
                        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/shared/iconly.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surpriseboxth</title>

    <link rel="stylesheet" href="assets/css/main/app.css">
    <!-- <link rel="stylesheet" href="assets/css/main/app-dark.css"> -->
    <!-- <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon"> -->
    <link rel="shortcut icon" href="images/logo.png" type="image/png">
    <link rel="stylesheet" href="css/contact.css?v=<?php echo time(); ?>">
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
                <h3>About</h3>
            </div>
            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr align="center">
                                        <th width="20%">ชื่อบริษัท</th>
                                        <th width="20%">รายละเอียด</th>
                                        <th width="10%">Line ID</th>
                                        <th width="10%">Facebook</th>
                                        <th width="10%">Instragram</th>
                                        <th width="10%">Tiktok</th>
                                        <th width="20%">ที่อยู่</th>
                                        <th width="10%">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td align="left"><?php echo $row_contact['company_name']; ?></td>
                                        <td align="left"><?php echo $row_contact['content']; ?></td>
                                        <td align="center"><?php echo $row_contact['line']; ?></td>
                                        <td align="center"><?php echo $row_contact['facebook']; ?></td>
                                        <td align="center"><?php echo $row_contact['instragram']; ?></td>
                                        <td align="center"><?php echo $row_contact['tiktok']; ?></td>
                                        <td align="left"><?php echo $row_contact['address']; ?></td>
                                        <td align="center">
                                            <a type="input" class="btn btn-warning" style="color: #FFFFFF;"
                                                data-bs-toggle="modal" href="#info<?php echo $row_contact['id'] ?>"><i
                                                    class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="modal fade" id="info<?php echo $row_contact['id'] ?>" data-bs-backdrop="static"
                                aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">เกี่ยวกับเรา</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="content-contact">
                                                <h6>ชื่อบริษัท :</h6>
                                                <span><?php echo $row_contact['company_name']; ?></span>
                                                <h6>รายละเอียด :</h6>
                                                <span><?php echo $row_contact['content']; ?></span>
                                                <h6>Line ID :</h6>
                                                <span><?php echo $row_contact['line']; ?></span>
                                                <h6>Facebook :</h6>
                                                <span><?php echo $row_contact['facebook']; ?></span>
                                                <h6>Instragram :</h6>
                                                <span><?php echo $row_contact['instragram']; ?></span>
                                                <h6>Tiktok :</h6>
                                                <span><?php echo $row_contact['tiktok']; ?></span>
                                                <h6>Address :</h6>
                                                <span><?php echo $row_contact['address']; ?></span>
                                            </div>
                                            <div class="edit-contact">
                                                <a type="input" class="btn btn-edit" data-bs-toggle="modal"
                                                    href="#edit-info<?php echo $row_contact['id'] ?>">แก้ไขข้อมูล</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="edit-info<?php echo $row_contact['id'] ?>"
                                data-bs-backdrop="static" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">แก้ไขข้อมูล</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" enctype="multipart/form-data">
                                                <div class="content-contact">
                                                    <h6>ชื่อบริษัท :</h6>
                                                    <input type="text" name="company_name" class="form-control"
                                                        value="<?php echo $row_contact['company_name']; ?>">
                                                    <h6>รายละเอียด :</h6>
                                                    <input type="text" name="content" class="form-control"
                                                        value="<?php echo $row_contact['content']; ?>">
                                                    <h6>Line ID :</h6>
                                                    <input type="text" name="line" class="form-control"
                                                        value="<?php echo $row_contact['line']; ?>">
                                                    <h6>Facebook :</h6>
                                                    <input type="text" name="facebook" class="form-control"
                                                        value="<?php echo $row_contact['facebook']; ?>">
                                                    <h6>Instragram :</h6>
                                                    <input type="text" name="instragram" class="form-control"
                                                        value="<?php echo $row_contact['instragram']; ?>">
                                                    <h6>Tiktok :</h6>
                                                    <input type="text" name="tiktok" class="form-control"
                                                        value="<?php echo $row_contact['tiktok']; ?>">
                                                    <h6>ที่อยู่ :</h6>
                                                    <input type="text" name="address" class="form-control"
                                                        value="<?php echo $row_contact['address']; ?>">
                                                </div>
                                                <div class="edit-contact">
                                                    <button class="btn btn-edit" name="edit-contact">บันทึก</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>



            <section class="section">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"></h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr align="center">
                                        <th width="20%">หัวข้อ</th>
                                        <th width="20%">Link</th>
                                        <th width="10%">จัดการ</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <tr>
                                        <td align="left"><?php echo $row_video['title_link']; ?></td>
                                        <td align="left"><?php echo $row_video['link']; ?></td>
                                        <td align="center">
                                            <a type="input" class="btn btn-warning" style="color: #FFFFFF;"
                                                data-bs-toggle="modal" href="#info1<?php echo $row_video['id'] ?>"><i
                                                    class="bi bi-pencil-square"></i></a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <div class="modal fade" id="info1<?php echo $row_video['id'] ?>" data-bs-backdrop="static"
                                aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">แก้ไขข้อมูล</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                        <div class="content-contact">
                                                <h6>หัวข้อ :</h6>
                                                <span><?php echo $row_video['title_link']; ?></span>
                                                <h6>Link :</h6>
                                                <span><?php echo $row_video['link']; ?></span>
                                            </div>
                                            <div class="edit-video">
                                                <a type="input" class="btn btn-edit" data-bs-toggle="modal"
                                                    href="#edit-info1<?php echo $row_video['id'] ?>">แก้ไขข้อมูล</a>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal fade" id="edit-info1<?php echo $row_video['id'] ?>"
                                data-bs-backdrop="static" aria-hidden="true">
                                <div class="modal-dialog  modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">แก้ไขข้อมูล</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" enctype="multipart/form-data">
                                            <div class="content-contact">
                                                    <h6>หัวข้อ :</h6>
                                                    <input type="text" name="title_link" class="form-control"
                                                        value="<?php echo $row_video['title_link']; ?>">
                                                    <h6>Link :</h6>
                                                    <input type="text" name="link" class="form-control"
                                                        value="<?php echo $row_video['link']; ?>">
                                                </div>
                                                <div class="edit-video">
                                                    <button class="btn btn-edit" name="edit-video">บันทึก</button>
                                                </div>
                                            </form>
                                        </div>

                                    </div>
                                </div>
                            </div>
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