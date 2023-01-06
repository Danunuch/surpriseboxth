<!DOCTYPE html>
<script src="https://cdn.tiny.cloud/1/2c646ifr40hywrvj32dwwml8e5qmxxr52qvzmjjq7ixbrjby/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
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

if (isset($_POST['add-content'])) {
    $detail = $_POST['detail'];
    $img = $_FILES['img'];
    $status = "on";

    $allow = array('jpg', 'jpeg', 'png', 'webp');
    $extention1 = explode(".", $img['name']); //เเยกชื่อกับนามสกุลไฟล์
    $fileActExt1 = strtolower(end($extention1)); //แปลงนามสกุลไฟล์เป็นพิมพ์เล็ก
    $fileNew1 = rand() . "." . "webp";
    $filePath1 = "upload/upload_content/" . $fileNew1;

    if (empty($detail)) {
        echo "<script>alert('กรุณากรอกรายละเอียด')</script>";
    } else {
        try {

            if (in_array($fileActExt1, $allow)) {
                if ($img['size'] > 0 && $img['error'] == 0) {
                    if (move_uploaded_file($img['tmp_name'], $filePath1)) {
                        $content = $conn->prepare("INSERT INTO content(detail,img ,status)
                                        VALUES(:detail, :img,:status)");
                        $content->bindParam(":detail", $detail);
                        $content->bindParam(":img", $fileNew1);
                        $content->bindParam(":status", $status);
                        $content->execute();
                        $id_product = $conn->lastInsertId();
                    }
                }
            }


            if ($content) {
                echo "<script>
                $(document).ready(function() {
                    Swal.fire({
                        text: 'เพิ่มเนื้อหาเรียบร้อยแล้ว',
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
                        text: 'มีบางอย่างผิดปกติ!!!',
                        icon: 'error',
                        timer: 10000,
                        showConfirmButton: false
                    });
                })
                </script>";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
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

<body>
    <div id="app">
        <?php include('sidebar.php'); ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>เพิ่มเนื้อหา</h3>
            </div>
            <section class="section">
                <form method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"></h4>
                            <button type="submit" name="add-content" class="btn btn-edit">บันทึก</button>
                        </div>
                        <div class="card-body">      
                            <div class="content-text">
                                    <textarea name="detail"></textarea>
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
                            <div class="title">
                                <div class="title-img">
                                    <span id="upload-img">รูปภาพ</span>
                                    <div class="group-pos">
                                        <input type="file" name="img" id="imgInput-cover" class="form-control">
                                        <button type="button" class="btn reset" id="reset1">ยกเลิก</button>
                                    </div>
                                    <span class="file-support">รองรับเฉพาะไฟล์นามสกุล ('jpg', 'jpeg', 'png', 'webp').</span>
                                    <div id="gallery-cover">
                                        <div class='box-edit-img-cover'>
                                            <span class='del-edit-img'></span>
                                            <img class='edit-img-cover' id='previewImg-cover' src=''>
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
    <script language="javascript" src="https://code.jquery.com/jquery-3.6.1.js" integrity="sha256-3zlB5s2uwoUzrXK3BT7AX3FyvojsraNFxCc2vC/7pNI=" crossorigin="anonymous"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

    <script>
        function preview_image() {
            var total_file = document.getElementById("imgInput").files.length;
            for (var i = 0; i < total_file; i++) {
                $('#gallery').append("<div class='box-edit-img'>  <span class='del-edit-img'></span>  <img class='previewImg' id='edit-img' src='" + URL.createObjectURL(event.target.files[i]) + "'> </div>");
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
            $('#imgout').click(function() {
                $('#imgInput').val(null);
            });

        });
    </script>

</body>

</html>