<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>

<?php

$message = "";

if(isset($_POST['submit']))
{
    $photo = new Photo();
    $photo->title = $_POST['title'];
    $photo->caption = $_POST['caption'];
    $photo->alternate_text = $_POST['alternate_text'];
    $photo->description = $_POST['description'];
    $photo->add_by_id = $session->user_id;
    $photo->set_file($_FILES['file_upload']);
    $photo->views = 0;
    $photo->date = date('F d, Y') . ' at ' . date('G:i');
    
    if($photo->save_all())
    {
        $message = "Photo uploaded succesfully";
    }
    else
    {
        $message = join('<br>', $photo->errors);
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
                            Upload
                           
                        </h1>
                       
                        
                        <div class="col-md-6">
                        <?php echo $message; ?>
                        <form action="" method="post" enctype="multipart/form-data">
                            
                            <div class="form-group">
                                <label for="caption">Title</label>
                                <input type="text" name="title" class="form-control">
                                
                            </div>
                            
                            <div class="form-group">
                                
                                <input type="file" name="file_upload">
                                
                            </div>
                            
                            <div class="form-group">
                                <label for="caption">Caption</label>
                                <input type="text" name="caption" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="caption">Alternate Text</label>
                                <input type="text" name="alternate_text" class="form-control">
                            </div>
                            
                            <div class="form-group">
                                <label for="caption">Description</label>
                                <textarea class="form-control" name="description" id="" cols="30" rows="30"></textarea>
                                
                            </div>
                            
                            <input type="submit" name="submit">
                            
                            
                        </form>
                        </div>
                        
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>