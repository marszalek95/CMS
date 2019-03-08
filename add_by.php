<?php include("includes/header.php"); ?>


<?php

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$user_id = $_GET['id'];

$items_per_page = 4;

$items_total_count = Photo::count_records_by_user($user_id);

$paginate = new Pagination($page, $items_per_page, $items_total_count);

$photos = Photo::photos_added_by_user($user_id, $items_per_page, $paginate->offset());

$author = User::find_by_id($user_id);

?>

        
            <div class="col-md-12">
            <!-- Blog Entries Column -->
            <div class="col-md-12">
                
                <h1>Photos added by <?php echo "{$author->first_name} {$author->last_name}"; ?></a></h1>
                
                <hr>
                
            <?php foreach ($photos as $photo): ?>
                
                
                    
                    <div class="col-xs-6 col-md-3">
                        
                        <a class="thumbnail" href="photo.php?id=<?php echo $photo->id; ?>">
                            
                            <img class="home_page_photo" src="admin/<?php echo $photo->picture_path(); ?>" alt="">
                            
                        </a>
                        
                    </div>
                    
                
                
                
                
                
            <?php                endforeach; ?>
                     
            </div>
        
            <div class="row col-md-12" align="center">
                
                <ul class="pagination">
                    
                    <?php 
                    
                    if($paginate->page_total() > 1)
                    {
                        if($paginate->has_previous())
                        {
                            echo "<li class='previous'><a href='add_by.php?id={$user_id}&page={$paginate->previous()}'>Previous</a></li>";
                        }
                        
                        for ($i = 1; $i <= $paginate->page_total(); $i++)
                        {
                            if($i == $paginate->current_page)
                            {
                                echo "<li class='active'><a href='add_by.php?id={$user_id}&page={$i}'>{$i}</a></li>";
                            }
                            else
                            {
                                echo "<li><a href='add_by.php?id={$user_id}&page={$i}'>{$i}</a></li>";
                            }
                        }
                        
                        if($paginate->has_next())
                        {
                            echo "<li class='next'><a href='add_by.php?id={$user_id}&page={$paginate->next()}'>Next</a></li>";
                        }
                
                        
                    }
                    
                    ?>
                    
                </ul>
                
            </div>
            </div>

<!--
             Blog Sidebar Widgets Column 
            <div class="col-md-4">

            
                 <?php //include("includes/sidebar.php"); ?>



        </div>-->
        <!-- /.row -->

        <?php include("includes/footer.php"); ?>
