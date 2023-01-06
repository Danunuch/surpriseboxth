<?php
require_once('webpanelcw/config/surprise_db.php');

$stmt = $conn->prepare("SELECT * FROM contact");
$stmt->execute();
$row_contact = $stmt->fetchAll();

?>


<footer>


    <section id="footer-section">


        <div class="container-xxl">
            <div class="row">
                <div class="col-lg-4">

                    <h4 class="text-white"><?= $row_contact[0]["company_name"] ?></h4>
                    <p><?= $row_contact[0]["content"] ?></p>

                </div>
                <div class="col-lg-4">

                    <ul class="con-1">
                        <li>
                            <a href="https://lin.ee/1737qIP" class="text-white" target="_blank"><?= $row_contact[0]["line"] ?></a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/surpriseboxth" class="text-white" target="_blank"><?= $row_contact[0]["facebook"] ?></a>
                        </li>

                        <li>
                           <a href="https://www.instagram.com/surpriseboxth/" class="text-white" target="_blank"><?= $row_contact[0]["instragram"] ?></a>
                       </li>
                       <li>
                        <a href="https://www.tiktok.com/@surpriseboxth" class="text-white" target="_blank"><?= $row_contact[0]["tiktok"] ?></a>
                    </li>

                </ul>
                <br>
                <a href="https://play.google.com/store/apps/details?id=uni.EB0076F" class="intro-btn" target="_blank"><img src="images/app_store.png" class="img-fluid"></a>
                <a href="https://play.google.com/store/apps/details?id=uni.EB0076F" class="intro-btn" target="_blank"><img src="images/google_pay.png" class="img-fluid"></a>

            </div>
            <div class="col-lg-4">


                <ul class="con-2">
                    <li><?= $row_contact[0]["address"] ?>
                        <br>
                        <a href="https://www.google.com/maps/place/%E0%B8%AD%E0%B8%B2%E0%B8%84%E0%B8%B2%E0%B8%A3%E0%B9%81%E0%B8%81%E0%B9%81%E0%B8%A5%E0%B9%87%E0%B8%84%E0%B8%8B%E0%B8%B5%E0%B9%88+%E0%B9%80%E0%B8%9E%E0%B8%A5%E0%B8%AA+%E0%B9%81%E0%B8%82%E0%B8%A7%E0%B8%87+%E0%B8%8A%E0%B9%88%E0%B8%AD%E0%B8%87%E0%B8%99%E0%B8%99%E0%B8%97%E0%B8%A3%E0%B8%B5+%E0%B9%80%E0%B8%82%E0%B8%95+%E0%B8%A2%E0%B8%B2%E0%B8%99%E0%B8%99%E0%B8%B2%E0%B8%A7%E0%B8%B2+%E0%B8%81%E0%B8%A3%E0%B8%B8%E0%B8%87%E0%B9%80%E0%B8%97%E0%B8%9E%E0%B8%A1%E0%B8%AB%E0%B8%B2%E0%B8%99%E0%B8%84%E0%B8%A3+10120/@13.6977486,100.5384537,17z/data=!3m1!4b1!4m5!3m4!1s0x30e29f5079eb2cfd:0x4d159ce3957876b9!8m2!3d13.6977434!4d100.5406424" target="_new" class="btn btn-info rounded-pill mt-3"><i class="demo-icon icon-im"></i> Google Map</a></li>
                    </ul>



                </div>
            </div>
        </div>












    </section>


    <section id="section-copy">
        <div class="container-xxl text-center">
            <span>
                <img src="images/logocw.png" alt="บริษัทรับทำเว็บไซต์" title="บริษัทรับทำเว็บไซต์">
            </span> Engine by <a class="text-white" href="http://www.cw.in.th/" title="บริษัทรับทำเว็บไซต์" target="_blank">CW</a>
            ©  2023 www.surpriseboxth.com
        </div>
    </section>

    <div class="back-top">
        <div class="scroll-line"></div>
        <span class="scoll-text">กลับขึ้นข้างบน</span>
    </div>


</div>




</footer>


