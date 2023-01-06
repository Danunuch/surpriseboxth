<!DOCTYPE html>
<link rel="stylesheet" href="assets/css/shared/iconly.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
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


$stmt = $conn->prepare("SELECT * FROM slide ");
$stmt->execute();
$row_slide = $stmt->fetch(PDO::FETCH_ASSOC);


$img = $conn->prepare("SELECT * FROM slide_img");
$img->execute();
$row_img = $img->fetchAll();



if (isset($_POST['del-img'])) {
    $img_id = $_POST['del-img'];
    $delete_img = $conn->prepare("DELETE FROM slide_img WHERE id = :id");
    $delete_img->bindParam(":id", $img_id);
    $delete_img->execute();

    if ($delete_img) {
        echo "<meta http-equiv='refresh' content='0;url=index_edit?id=$id'>";
    }
}


if (isset($_POST['edit-slide'])) {
    $content_id = $_POST['content'];
    $content = $conn->prepare("UPDATE slide SET content = :content");
    $content->bindParam(":content", $content_id);
    $content->execute();

    $title_id = $_POST['title'];
    $title = $conn->prepare("UPDATE slide SET title = :title");
    $title->bindParam(":title", $title_id);
    $title->execute();


    foreach ($_FILES['img']['tmp_name'] as $key => $value) {
        $file_names = $_FILES['img']['name'];

        $extension = strtolower(pathinfo($file_names[$key], PATHINFO_EXTENSION));
        $supported = array('jpg', 'jpeg', 'png', 'webp');
        if (in_array($extension, $supported)) {
            $new_name = rand() . '.' . "webp";
            if (move_uploaded_file($_FILES['img']['tmp_name'][$key], "upload/upload_home/" . $new_name)) {
                $sql = "INSERT INTO slide_img (img) VALUES(:image)";
                $upload_img = $conn->prepare($sql);
                $params = array(
                    'image' => $new_name

                );
                $upload_img->execute($params);
            }
        }
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
        echo "<meta http-equiv='refresh' content='2;url=index'>";
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

    if ($title) {
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
        echo "<meta http-equiv='refresh' content='2;url=index'>";
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
                <h3>Home Edit</h3>
            </div>
            <section class="section">
                <form method="post" enctype="multipart/form-data">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Home</h4>
                            <button type="submit" name="edit-slide" class="btn btn-edit">บันทึก</button>
                        </div>

                        <div class="card-body">
                            <div class="content">
                                <div class="content-text">
                                    <textarea name="title"><?php echo $row_slide['title'] ?></textarea>
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
                            </div>
                            </div>
                            
                            <div class="card-body">
                                <div class="content">
                                    <div class="content-text">
                                        <textarea name="content"><?php echo $row_slide['content'] ?></textarea>
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
                                </div>
                                </div>

                          
                                    <div class="content d-flex justify-content-center align-item-center">
                                        <div class="content-img" >
                                            <div class="group-pos">
                                                <input type="file" name="img[]" id="imgInput" onchange="preview_image();" class="form-control" multiple>
                                                <button type="button" class="btn reset" id="reset2">ยกเลิก</button>
                                            </div>
                                            <span class="file-support">รองรับเฉพาะไฟล์นามสกุล ('jpg', 'jpeg', 'png', 'webp').</span>
                                            <div id="gallery">
                                                <?php
                                                foreach ($row_img as $row_img) { ?>
                                                    <div class="box-edit-img">
                                                        <span class="del-edit-img"><button type="submit" onclick="return confirm('ต้องการลบรูปภาพใช่หรือไม่?')" name="del-img" value="<?php echo $row_img['id'] ?>" class="btn-edit-del-img"><i class="bi bi-x-lg"></button></i></span>
                                                        <img class='previewImg' id='edit-img' src="upload/upload_home/<?php echo $row_img['img'] ?>" alt="">
                                                    </div>
                                                <?php  }
                                                ?>
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
                $('#gallery').append("<div class='box-edit-img'>  <span class='del-edit-img'><button type='submit' onclick='return confirm('ต้องการลบรูปภาพใช่หรือไม่?')' name='del-img' class='btn-edit-del-img'><i class='bi bi-x-lg'></i></button></span>  <img class='previewImg' id='edit-img' src='" + URL.createObjectURL(event.target.files[i]) + "'> </div>");
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