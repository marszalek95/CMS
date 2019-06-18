<?php include("includes/header.php"); ?>


<?php

$page = !empty($_GET['page']) ? (int)$_GET['page'] : 1;

$items_per_page = 4;

$items_total_count = Photo::count_records();

$paginate = new Pagination($page, $items_per_page, $items_total_count);

$photos = Photo::find_all_pagination($items_per_page, $paginate->offset());

Counter::count_visits(); 

?>

        
            <!-- Blog Entries Column -->
            <div class="col-md-12">

            <?php foreach ($photos as $photo): ?>
                                
                    <div class="col-sm-6 col-md-3">
                        
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
                            echo "<li class='previous'><a href='index.php?page={$paginate->previous()}'>Previous</a></li>";
                        }
                        
                        for ($i = 1; $i <= $paginate->page_total(); $i++)
                        {
                            if($i == $paginate->current_page)
                            {
                                echo "<li class='active'><a href='index.php?page={$i}'>{$i}</a></li>";
                            }
                            else
                            {
                                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";
                            }
                        }
                        
                        if($paginate->has_next())
                        {
                            echo "<li class='next'><a href='index.php?page={$paginate->next()}'>Next</a></li>";
                        }
                                     
                    }
                    
                    ?>
                    
                </ul>
                
            </div>


        <?php include("includes/footer.php"); ?>
