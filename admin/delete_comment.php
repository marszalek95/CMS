<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php

if(empty($_GET['id']))
{
    redirect("comments.php");
}

$comment = Comment::find_by_id($_GET['id']);

if($comment)
{
    $comment->delete();
    $last_page = $_SERVER['HTTP_REFERER'];
    $last_page_number = $_GET['lastpage'];
    $last_page = substr($last_page, 0, -1) . $last_page_number;
    redirect($last_page);
}
else
{
    redirect("comments.php");
}

?>

  <?php include("includes/footer.php"); ?>