<?php
require_once('webpanelcw/config/surprise_db.php');

$stmt = $conn->prepare("SELECT * FROM contact");
$stmt->execute();
$row_contact = $stmt->fetchAll();

$stmt = $conn->prepare("SELECT * FROM video");
$stmt->execute();
$row_video = $stmt->fetchAll();

?>

<header>

	<!-- Start Navigation -->
		<nav hidden> 
			<div class="nav-header">
				<a href="#" class="brand"><img src="images/logo.png" /></a>
				<button class="toggle-bar"><span class="material-icons-sharp">
menu
</span></button>	
			</div>								
			<ul class="menu">
				<li><a href="https://lin.ee/1737qIP" target="_blank"><i class="demo-icon icon-li"></i> <span class="d-inline-block d-lg-none"><?= $row_contact[0]["line"] ?></span></a></li>
				<li><a href="https://www.facebook.com/surpriseboxth" target="_blank"><i class="demo-icon icon-fi"></i> <span class="d-inline-block d-lg-none"><?= $row_contact[0]["facebook"] ?></span></a></li>
				<li><a href="https://www.instagram.com/surpriseboxth/" target="_blank"><i class="demo-icon icon-ii"></i> <span class="d-inline-block d-lg-none"><?= $row_contact[0]["instragram"] ?></span></a></li>
				<li><a href="https://www.tiktok.com/@surpriseboxth" target="_blank"><i class="demo-icon icon-ti"></i> <span class="d-inline-block d-lg-none"><?= $row_contact[0]["tiktok"] ?></span></a></li>		
				<li><a href="<?= $row_video[0]["link"] ?>" target="_blank" class="bg-info">วิธีการเล่น</a></li>
			</ul>
		</nav>
		<!-- End Navigation -->


</header>
