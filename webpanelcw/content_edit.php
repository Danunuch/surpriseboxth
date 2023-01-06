<!DOCTYPE html>
<link rel="stylesheet" href="assets/css/shared/iconly.css">
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
<script src="https://cdn.tiny.cloud/1/2c646ifr40hywrvj32dwwml8e5qmxxr52qvzmjjq7ixbrjby/tinymce/6/tinymce.min.js"
referrerpolicy="origin"></script>
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

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM content WHERE id = :id");
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $row_content = $stmt->fetch(PDO::FETCH_ASSOC);

}

if (isset($_POST['edit-content'])) {
    $detail = $_POST['detail'];
    $img = $_FILES['img'];

    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $filePath1 = "upload/upload_content/" . $fileNew1;

    if (in_array($fileActExt1, $allow)) {
        if ($img['size'] > 0 && $img['error'] == 0) {
            if (move_uploaded_file($img['tmp_name'], $filePath1)) {
                $content = $conn->prepare("UPDATE content SET detail = :detail, img = :img WHERE id = :id");
                $content->bindParam(":detail", $detail);
                $content->bindParam(":img", $fileNew1);
                $content->bindParam(":id", $id);
                $content->execute();
            }
        }
    } else {
            $content = $conn->prepare("UPDATE content SET detail = :detail WHERE id = :id");
                $content->bindParam(":detail", $detail);
                $content->bindParam(":id", $id);
                $content->execute();
    }

    if ($content) {
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
        echo "<meta http-equiv='refresh' content='2;url=content'>";
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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surpriseboxth</title>

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
                <h3>Content Edit</h3>
            </div>
            <section class="section">
                <form method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"></h4>
                            <button type="submit" name="edit-content" class="btn btn-edit">บันทึก</button>
                        </div>
                        <div class="card-body">
                            <div class="content-text">
                                <textarea name="detail"><?php echo $row_content['detail'] ?></textarea>
                                <script>
                                tinymce.init({
                                    selector: 'textarea',
                                    height: "400",
                                    plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                                    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
                                    tinycomments_mode: 'embedded',
                                    tinycomments_author: 'Author name',
                                    mergetags_list: [{
                                            value: 'First.Name',
                                            title: 'First Name'
                                        },
                                        {
                                            value: 'Email',
                                            title: 'Email'
                                        },
                                    ]
                                });
                                </script>
                            </div>
                            <br>
                            <div class="title">
                                <div class="title-img">
                                    <span id="upload-img">รูปภาพ</span>
                                    <div class="group-pos">
                                        <input type="file" name="img" id="imgInput-cover" class="form-control">
                                        <button type="button" class="btn reset" id="reset1">ยกเลิก</button>
                                    </div>
                                    <span class="file-support">รองรับเฉพาะไฟล์นามสกุล ('jpg', 'jpeg', 'png','webp').</span>
                                    <div id="gallery-cover">
                                        <div class='box-edit-img-cover'>
                                            <span class='del-edit-img'></span>
                                            <img class='edit-img-cover' id='previewImg-cover'
                                                src='upload/upload_content/<?php echo $row_content['img'] ?>'>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

        </div>

        </form>
        </section>
        <?php include('footer.php'); ?>
    </div>
    </div>
    <script language="javascript" src="https://code.jquery.com/jquery-3.6.1.js"
        integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

    <script>
    function preview_image() {
        var total_file = document.getElementById("imgInput").files.length;
        for (var i = 0; i < total_file; i++) {
            $('#gallery').append(
                "<div class='box-edit-img'>  <span class='del-edit-img'><button type='submit' onclick='return confirm('Do you want to delete this image?')' name='del-img' class='btn-edit-del-img'><i class='bi bi-x-lg'></i></button></span>  <img class='previewImg' id='edit-img' src='" +
                URL.createObjectURL(event.target.files[i]) + "'> </div>");
            // $('#gallery').append("");

        }
    }
    </script>
    <script>
    let imgInput = document.getElementById('imgInput-cover');
    let previewImg = document.getElementById('previewImg-cover');

    imgInput.onchange = evt => {
        const [file] = imgInput.files;
        if (file) {
            previewImg.src = URL.createObjectURL(file);
        }
    }
    </script>
    <script>
    $(document).ready(function() {
        $('#reset1').click(function() {
            $('#imgInput-cover').val(null);
            $('#previewImg-cover').attr("src", "");
            // $('.previewImg').addClass('none');
            // $('.box-edit-img').addClass('none');
        });

    });
    </script>

</body>

</html>