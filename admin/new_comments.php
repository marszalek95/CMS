<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>


<?php

$comments = Comment::find_new_comments($session->user_id);

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
                           New comments
                        </h1>
            
                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Author</th>
                                        <th>Body</th>
                                        <th>Photo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    
                                    <?php foreach ($comments as $comment) : ?>
                                    <?php $photo = Photo::find_by_id($comment->photo_id); 
                                           $comment->updade_status($comment->id);?>
                                    <tr>
                                        <td><?php echo $comment->id; ?></td>
                                        <td><?php echo $comment->author; ?>                                        
                                            <div class="pictures_link">
                                                <a href="delete_comment.php?id=<?php echo $comment->id; ?>">Delete</a>
                                                <a href="../photo.php?id=<?php echo $comment->photo_id; ?>">View post</a>
                                            </div>
                                        </td>
                                        <td><?php echo $comment->body; ?></td>
                                        <td><img class="comments-photo-thumbnail" src="<?php echo $photo->picture_path(); ?>" alt=""></td>
                                    <?php                                        endforeach; ?>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>; ?>