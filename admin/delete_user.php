<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php

if(empty($_GET['id']))
{
    redirect("users.php");
}

$user = User::find_by_id($_GET['id']);

if($user)
{
    $user->delete_all();
    redirect("users.php?page={$_GET['lastpage']}");
}
else
{
    redirect("users.php");
}

?>

  <?php include("includes/footer.php"); ?>