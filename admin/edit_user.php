<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} 
/* @var $user User*/
?>

<?php

$message = "";

if(empty($_GET['id']))
{
    redirect("users.php");
}
else
{
    $user = User::find_by_id($_GET['id']);
}

if(isset($_POST['update']))
{
    $user->username = $_POST['username'];
    $user->first_name = $_POST['first_name'];
    $user->last_name = $_POST['last_name'];
    $user->description = $_POST['description'];
        
    if(!$user->username || !$user->password || !$user->first_name || !$user->last_name)
    {
        $message = "Some fields are empty!";
    }
    elseif($_FILES['file_upload']['size'] > 0)
    {
        $user->set_file($_FILES['file_upload']);
        $user->delete_photo();
        $user->user_image = $user->filename;
        $user->upload_photo();
    }
    elseif(empty($user->errors))
    {
        $user->update();
        $message = "User updated succesfully";
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
                            User
                            <small>Edit</small>
                        </h1>
                        <?php echo $message; ?>
                        <form action="" method="post" enctype="multipart/form-data">
                        <div class="col-md-6">
                        
                            
                            <div class="form-group">
                                <input type="file" name="file_upload">
                            </div>
                            </div>
                            
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="caption">Username</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $user->username; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="caption">First Name</label>
                                <input type="text" name="first_name" class="form-control" value="<?php echo $user->first_name; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="caption">Last Name</label>
                                <input type="text" name="last_name" class="form-control" value="<?php echo $user->last_name; ?>">
                            </div>
                            
                            <div class="form-group">
                                <label for="caption">Description</label>
                                <textarea class="form-control" name="description" id="" cols="15" rows="15"><?php echo $user->description; ?></textarea>
                                
                            </div>    
                           
                            
                            <div class="form-group">
                                <a class="btn btn-danger" href="delete_user.php?id=<?php echo $user->id; ?>">Delete</a>
                                <input type="submit" name="update" value="Update"class="btn btn-primary pull-right" >
                            </div>
                            
                            
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