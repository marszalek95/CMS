<?php include("includes/header.php"); ?>
<?php if(!$session->is_signed_in()) {redirect("login.php");} ?>


<?php

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$items_per_page = 4;

$items_total_count = User::count_records();

$paginate = new Pagination($page, $items_per_page, $items_total_count);

$last_page = $paginate->last_page();

$users = User::find_all_pagination($items_per_page, $paginate->offset());


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
                        
                        <a href="add_user.php" class="btn btn-primary">Add User</a>
                        
                        <div class="col-md-12">
                            <table class="table table-hover col-md-12">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Photo</th>
                                        <th>Username</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                     <?php foreach ($users as $user) :  ?>
                                    
                                    <tr>
                                        <td><?php echo $user->id; ?></td>
                                        <td><img class="user-image" src="<?php echo $user->image_path_and_placeholder(); ?>" alt=""> </td>
                                        <td><?php echo $user->username; ?>                                        
                                            <div class="pictures_link">
                                                <a href="delete_user.php?id=<?php echo $user->id . "&lastpage=" . $last_page; ?>">Delete</a>
                                                <a href="edit_user.php?id=<?php echo $user->id; ?>">Edit</a>
                                            </div>
                                        </td>
                                        <td><?php echo $user->first_name; ?></td>
                                        <td><?php echo $user->last_name; ?></td>
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
                            echo "<li class='previous'><a href='users.php?page={$paginate->previous()}'>Previous</a></li>";
                        }
                        
                        for ($i = 1; $i <= $paginate->page_total(); $i++)
                        {
                            if($i == $paginate->current_page)
                            {
                                echo "<li class='active'><a href='users.php?age={$i}'>{$i}</a></li>";
                            }
                            else
                            {
                                echo "<li><a href='users.php?page={$i}'>{$i}</a></li>";
                            }
                        }
                        
                        if($paginate->has_next())
                        {
                            echo "<li class='next'><a href='users.php?page={$paginate->next()}'>Next</a></li>";
                        }
                
                        
                    }
                    
                    ?>
                    
                </ul>
                
            </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

  <?php include("includes/footer.php"); ?>; ?>