<?php
include 'album.php';
if (isset($_GET['id'])) {
    $album_info = $album_obj->delete_music_info_by_id($_GET['id']);


} else {
    header('Location: album-manager.php');
}

?>
 
 <?php
if (isset($_SESSION['message'])) {
    echo "<p class='custom-alert'>" . $_SESSION['message'] . "</p>";
    unset($_SESSION['message']);
}
?>
