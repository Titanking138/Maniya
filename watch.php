<?php
$hideNav = true;
require_once("include/header.php");

if (!isset($_GET["id"])) {
    # TODO :  modify page with adding some css like error 404 page not found  
    ErrorMessage::errorShow("Page not Found ");
}

$entityId = $_GET["id"];
$video = new Video($conn, $entityId);
$video->incrementView();

$upNextVideo = VideoProvide::getUpNext($conn, $video);
?>

<div class="videoContainer">
    <div class="watchNav videoControl">
        <button onclick="goBack()">
            <i class="fas fa-arrow-left"></i>
        </button>
        <h1><?php echo $video->getTitle(); ?></h1>
    </div>

    <div class="videoControl upNext" style="display: none;">
        <button onclick="restartVideo();"><i class="fas fa-redo"></i></button>

        <div class="upNextContainer">
            <h2>Up next:</h2>
            <h3><?php echo $upNextVideo->getTitle(); ?></h3>
            <h3><?php echo $upNextVideo->getNextEpisodeNum(); ?></h3>
            <button class="playNext" onclick="watchNow(<?php echo $upNextVideo->getId(); ?>)"><i class="fas fa-play"></i>play</button>
        </div>
    </div>
    <video autoplay controls onended="showUpNext()">
        <source src="<?php echo $video->getFilePath(); ?>" type="video/mp4">
    </video>
</div>
<script>
    initVideo("<?php echo $video->getId(); ?>", "<?php echo $userLoggedIn; ?>");
</script>