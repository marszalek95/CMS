<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php

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
    redirect("photos.php");
}
else
{
    redirect("photos.php");
}

?>

  <?php include("includes/footer.php"); ?>