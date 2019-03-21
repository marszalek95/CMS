<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php
/* 
 * Photo deleting interface
 */


if(empty($_GET['id']))
{
    redirect("photos.php");
}

$photo = Photo::find_by_id($_GET['id']);
$comment = new Comment();

if($photo)
{
    $photo->delete_all();
    $comment->delete_comment($_GET['id']);
    redirect("photos.php?page={$_GET['lastpage']}");
}
else
{
    redirect("photos.php");
}

?>

  <?php include("includes/footer.php"); ?>