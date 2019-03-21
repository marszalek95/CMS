<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php
/* 
 * User deleting interface
 */


if(empty($_GET['id']))
{
    redirect("users.php");
}

$user = User::find_by_id($_GET['id']);

if($user)
{
    $user->delete_all();
    if($user->id == $session->user_id)
    {
        redirect("logout.php");
    }
    else
    {
    redirect("users.php?page={$_GET['lastpage']}");
    }
}
else
{
    redirect("users.php");
}

?>

  <?php include("includes/footer.php"); ?>