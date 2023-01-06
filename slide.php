<?php
require_once('webpanelcw/config/surprise_db.php');

$stmt = $conn->prepare("SELECT * FROM slide_img");
$stmt->execute();
$row_img = $stmt->fetchAll();

?>


<div class="slider banner_index">
    <?php for ($i = 0; $i < count($row_img); $i++) { ?>
        <div class="ps-0 pe-0">
            <img class="img-fluid w-100" src="webpanelcw/upload/upload_home/<?php echo $row_img[$i]['img'] ?>">
        </div>


    <?php } ?>
</div>