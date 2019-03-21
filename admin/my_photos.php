<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>


<?php


$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$user_id = $_GET['id'];

$items_per_page = 4;

$items_total_count = Photo::count_records_by_user($user_id);

$paginate = new Pagination($page, $items_per_page, $items_total_count);

$photos = Photo::photos_added_by_user($user_id, $items_per_page, $paginate->offset());

$author = User::find_by_id($user_id);



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
                            My photos                         
                        </h1>
                        <div class="col-md-12">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Photo</th>
                                        <th>ID</th>
                                        <th>Author</th>
                                        <th>File Name</th>
                                        <th>Title</th>
                                        <th>Size</th>
                                        <th>Comments</th>
                                        <th>Views</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                     <?php foreach ($photos as $photo) :  ?>
                                    
                                    <tr>
                                        
   
                                        <td><img class="img-responsive img-rounded" src="<?php echo $photo->picture_path(); ?>" alt="">
                                        
                                            <div class="pictures_link">
                                                <a href="delete_photo.php?id=<?php echo $photo->id; ?>">Delete</a>
                                                <a href="edit_photo.php?id=<?php echo $photo->id; ?>">Edit</a>
                                                <a href="../photo.php?id=<?php echo $photo->id; ?>">View</a>
                                            </div>
                                        
                                        </td>
                                        <td><?php echo $photo->id; ?></td>
                                        <td>
                                            <?php 
                                            $author = User::find_by_id($photo->add_by_id);
                                            echo "{$author->first_name} {$author->last_name}"; 
                                            ?>
                                        </td>
                                        <td><?php echo $photo->filename; ?></td>
                                        <td><?php echo $photo->title; ?></td>
                                        <td><?php echo $photo->size; ?></td>
                                        <td><a href="comment_photo.php?id=<?php echo $photo->id; ?>"><?php                                        
                                        $comments = Comment::find_all_comments($photo->id);                                       
                                        echo count($comments);                                     
                                        ?></a></td>
                                        <td><?php echo $photo->show_counter($photo->id); ?></td>
                                         
                                        
                                        <?php                                        endforeach; ?>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
                
                <div class="row col-md-12" align="center">
                
                <ul class="pagination">
                    
                    <?php 
                    
                    if($paginate->page_total() > 1)
                    {
                        if($paginate->has_previous())
                        {
                            echo "<li class='previous'><a href='my_photos.php?id={$user_id}&page={$paginate->previous()}'>Previous</a></li>";
                        }
                        
                        for ($i = 1; $i <= $paginate->page_total(); $i++)
                        {
                            if($i == $paginate->current_page)
                            {
                                echo "<li class='active'><a href='my_photos.php?id={$user_id}&page={$i}'>{$i}</a></li>";
                            }
                            else
                            {
                                echo "<li><a href='my_photos.php?id={$user_id}&page={$i}'>{$i}</a></li>";
                            }
                        }
                        
                        if($paginate->has_next())
                        {
                            echo "<li class='next'><a href='my_photos.php?id={$user_id}&page={$paginate->next()}'>Next</a></li>";
                        }
                
                        
                    }
                    
                    ?>
                    
                </ul>
                
            </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>