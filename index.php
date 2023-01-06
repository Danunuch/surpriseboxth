<?php
require_once('webpanelcw/config/surprise_db.php');
error_reporting(0);
$stmt_slide  = $conn->prepare("SELECT * FROM slide");
$stmt_slide->execute();
$row_slide = $stmt_slide->fetchAll();

$stmt_video = $conn->prepare("SELECT * FROM video");
$stmt_video->execute();
$row_video = $stmt_video->fetchAll();

$stmt_content = $conn->prepare("SELECT * FROM content");
$stmt_content->execute();
$row_content = $stmt_content->fetchAll();

$stmt_slide_img = $conn->prepare("SELECT * FROM slide_img");
$stmt_slide_img->execute();
$row_slide_img = $stmt_slide_img->fetchAll();



?>


<!DOCTYPE html>
<html lang="en" class="desktop">

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Kanit&display=swap" rel="stylesheet">
  <link rel="shortcut icon" href="images/favicon.ico">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=0.85">
  <meta name="description" content="บริษัทซูเปอร์ลักกี้บ๊อกซ์,ซูเปอร์ลักกี้บ๊อกซ์,กล่องสุ่ม,กล่องสุ่มออนไลน์,surprise box ,super lucky box ,เซอร์ไพรส์บ๊อกซ์,กล่องสุ่มราคาถูก,กล่องสุ่มไอโฟน,กล่องสุ่มราคาถูก,กล่องสุ่มแบรนด์เนม,กล่องสุ่มเครื่องสำอาง,กล่องสุ่มเซอร์ไพรส์บ๊อกซ์,กล่องสุ่มคุ้มๆ">
  <meta name="keyword" content="บริษัทซูเปอร์ลักกี้บ๊อกซ์,ซูเปอร์ลักกี้บ๊อกซ์,กล่องสุ่ม,กล่องสุ่มออนไลน์,surprise box ,super lucky box ,เซอร์ไพรส์บ๊อกซ์,กล่องสุ่มราคาถูก,กล่องสุ่มไอโฟน,กล่องสุ่มราคาถูก,กล่องสุ่มแบรนด์เนม,กล่องสุ่มเครื่องสำอาง,กล่องสุ่มเซอร์ไพรส์บ๊อกซ์,กล่องสุ่มคุ้มๆ">
  <meta name="author" content="บริษัทซูเปอร์ลักกี้บ๊อกซ์,ซูเปอร์ลักกี้บ๊อกซ์,กล่องสุ่ม,กล่องสุ่มออนไลน์,surprise box ,super lucky box ,เซอร์ไพรส์บ๊อกซ์,กล่องสุ่มราคาถูก,กล่องสุ่มไอโฟน,กล่องสุ่มราคาถูก,กล่องสุ่มแบรนด์เนม,กล่องสุ่มเครื่องสำอาง,กล่องสุ่มเซอร์ไพรส์บ๊อกซ์,กล่องสุ่มคุ้มๆ">

  <title>บริษัทซูเปอร์ลักกี้บ๊อกซ์,ซูเปอร์ลักกี้บ๊อกซ์,กล่องสุ่ม</title>


  <link href="css/spinner.css" rel="stylesheet">
  <link href="css/bootstrap.min.css" rel="stylesheet">


  <script src="js/core.min.js"></script>
  <script src="js/script.min.js"></script>

  <script src="js/jquery.min.js"></script>

  <script type="text/javascript">
    'use strict';
    var $window = $(window);
    $window.on({
      'load': function() {

        /* Preloader */
        $('.spinner').fadeOut(2500);
      },

    });
  </script>

  <script src="js/lazyload.js"></script>
</head>



<body style=" font-family: 'Kanit', sans-serif;">
  <!-- Pre loader -->
  <div class="spinner" id="loading-body">
    <div>
      <div class="bounce1"></div>
      <div class="bounce2"></div>
      <div class="bounce3"></div>
    </div>
  </div>

  <?php include("header.php"); ?>

  <main>

    <?php include("slide.php"); ?>

    <section id="intro-section">
      <div class="container-xxl">
        <div class="text-center">
         
            <h1 class="mb-4 text-primary"><img src="images/intro-h1.png" class="img-fluid"><?= $row_slide[0]["title"] ?><?= $row_slide[0]["content"] ?></h1> 
              
              <a href="https://play.google.com/store/apps/details?id=uni.EB0076F" class="intro-btn" target="_blank"><img src="images/app_store.png" class="img-fluid"></a>
              <a href="https://play.google.com/store/apps/details?id=uni.EB0076F" class="intro-btn" target="_blank"><img src="images/google_pay.png" class="img-fluid"></a>
          </div>
        </div>

    </section>


    <section id="app-section">

      <?php for ($i = 1; $i <= 6; $i++) { ?>
        <div class="container-fluid item-app">
          <div class="row align-items-center">
            <div class="col-lg-6 text-app py-5 px-lg-5">

              <h2><?= $row_content[$i - 1]["detail"] ?></h2>


            </div>
            <div class="col-lg-6 img-app p-0">
              <img class="lazy img-fluid" data-src="webpanelcw/upload/upload_content/<?php echo $row_content[$i - 1]["img"] ?>">
            </div>
          </div>
        </div>



      <?php } ?>
      <?php

      function getYoutubeEmbedUrl($url)
      {
        $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_]+)\??/i';
        $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))(\w+)/i';

        if (preg_match($longUrlRegex, $url, $matches)) {
          $youtube_id = $matches[count($matches) - 1];
        }

        if (preg_match($shortUrlRegex, $url, $matches)) {
          $youtube_id = $matches[count($matches) - 1];
        }
        return 'https://www.youtube.com/embed/' . $youtube_id;
      }

      $url = $row_video[0]['link'];
      $embeded_url = getYoutubeEmbedUrl($url);

      // echo $embeded_url;
      ?>

      <div class="container-fluid item-app">
        <div class="row align-items-center">
          <div class="col-lg-6 text-app py-5 px-lg-5">

            <h2><?= $row_video[0]["title_link"] ?></h2>

          </div>
          <div class="col-lg-6 img-app p-0 p-lg-5 pe-lg-0">
            <div class="ratio ratio-4x3">
              <!-- <object width="425" height="350" data="<?php echo $row_video[0]['link'] ?>" type="application/x-shockwave-flash">
                <param name="src" value="<?php echo $row_video[0]['link'] ?>" />
              </object> -->
              <!-- <iframe src="https://www.youtube.com/embed/WREgTfzSATs?rel=0" title="YouTube video" allowfullscreen></iframe> -->
              <iframe src="<?php echo $embeded_url ?>" title="YouTube video" allowfullscreen></iframe>
            </div>
          </div>
        </div>
      </div>

    </section>



  </main>



  <?php include("footer.php"); ?>




</body>

</html>