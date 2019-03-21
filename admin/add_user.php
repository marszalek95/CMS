<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>


<?php

$message = "";

if(isset($_POST['submit']))
{
    $user = new User();
    $user->username = $_POST['username'];
    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    $user->password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $user->set_file($_FILES['file_upload']);
    $user->user_image = $user->filename;
    
    if(User::check_username($user->username))
    {
        $message = "This username is taken!";
    }
    elseif(!$user->username || !$user->password || !$user->first_name || !$user->last_name)
    {
        $message = "Some fields are empty!";
    }
    elseif($user->save_all())
    {  
        $message = "User added succesfully";
    }
    else
    {
        $message = join("<br>", $user->errors);
    }
}
?>




        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
            <!-- Brand and toggle get grouped for better mobile display -->
           
            <?php include("includes/top_nav.php") ?>
            
            <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->

            <?php include("includes/side_nav.php") ?>
          
            <!-- /.navbar-collapse -->
        </nav>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Users
                        </h1>
                            <?php echo $message; ?>
                        <form action="" method="post" enctype="multipart/form-data">
                         
                        <div class="col-md-6 col-md-offset-3">
                            
                            <div class="form-group">
                                <input type="file" name="file_upload">
                            </div>
                          
                            <div class="form-group">
                                    <label for="caption">Username</label>
                                <input type="text" name="username" class="form-control">
                                
                            </div>
                                                      
                            <div class="form-group">
                                <label for="caption">First Name</label>
                                <input type="text" name="first_name" class="form-control" >
                            </div>
                            
                            <div class="form-group">
                                <label for="caption">Last Name</label>
                                <input type="text" name="last_name" class="form-control" >
                            </div>
                            
                            <div class="form-group">
                                <label for="caption">Password</label>
                                <input type="password" name="password" class="form-control" >
                            </div>
                                                   
                            <div class="form-group">
                                <input type="submit" name="submit" value="Submit "class="btn btn-primary pull-right" >
                            </div>                         
                        </div>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>