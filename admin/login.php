<?php require_once('includes/header.php'); ?>



<?php

$the_message ="";

if($session->is_signed_in())
{
    redirect("index.php");
}

if(isset($_POST['submit']))
{
    
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    $user_found = User::verify_user($username, $password);
    
    
    if($user_found)
    {
        $session->login($user_found);
        redirect("index.php");
    }
    else
    {
        $the_message = "Your password or username are incorrect! <br>";

    }
    
}
else
{
    $username = "";
    $password = "";
}





?>



<div class="col-md-4 col-md-offset-3">
    
    <center><h1 class="page-header login-form-page">Login form</h1></center>
                            
                          
                        

<h4 class="bg-danger"><?php echo $the_message; ?></h4>
	
<form id="login-id" action="" method="post">
	
<div class="form-group">
    <label for="username" class="login-form-page">Username:</label>
    <input type="text" class="form-control" name="username" size="10" value="<?php echo htmlentities($username); ?>" >

</div>

<div class="form-group">
	<label for="password" class="login-form-page">Password:</label>
        <input type="password" class="form-control" name="password" size="20" value="<?php echo htmlentities($password); ?>">
	
</div>


<div class="form-group">
<input type="submit" name="submit" value="Login" class="btn btn-primary">

</div>


</form>


</div>
