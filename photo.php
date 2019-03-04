<?php include("includes/header.php"); ?>

<?php


if(empty($_GET['id']))
{
    redirect("index.php");
}

$photo = Photo::find_by_id($_GET['id']);

$author = User::find_by_id($photo->add_by_id);

$comments = Comment::find_all_comments($_GET['id']);

if(isset($_POST['submit']))
{
$comment_read = new Comment();
$comment_read->photo_id = $_GET['id'];
$comment_read->author = $_POST['author'];
$comment_read->body = $_POST['body'];


$comment_read->create();

redirect("photo.php?id={$_GET['id']}");

}





?>






<body>

    

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Post Content Column -->
            <div class="col-lg-8">

                <!-- Blog Post -->

                <!-- Title -->
                <h1><?php echo $photo->title; ?></h1>

                <!-- Author -->
                <p class="lead">
                    by <a href="add_by.php?id=<?php echo $photo->add_by_id; ?>"><?php echo "{$author->first_name} {$author->last_name}"; ?></a>
                </p>

                <hr>

                <!-- Date/Time -->
                <p><span class="glyphicon glyphicon-time"></span> Posted on August 24, 2013 at 9:00 PM</p>

                <hr>

                <!-- Preview Image -->
                <img class="img-responsive" src="admin/<?php echo $photo->picture_path();  ?>" alt="">

                <hr>

                <!-- Post Content -->
                <p class="lead"><?php echo $photo->caption; ?></p>
                <p><?php echo $photo->alternate_text; ?></p>
                <p><?php echo $photo->description; ?></p>
                

                <hr>

                <!-- Blog Comments -->

                <!-- Comments Form -->
                <div class="well">
                    <form role="form" method="post">    
                    <h4>Your name:</h4>
                    <div class="form-group">
                            <input type="text" name="author" class="form-control">
                        </div>
                    <h4>Leave a Comment:</h4>
                    <form role="form">                       
                        <div class="form-group">
                            <textarea class="form-control" name="body" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->


                
                <?php foreach ($comments as $comment) : ?>
                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment->author; ?>
            
                        </h4>
                        <?php echo $comment->body; ?>
                            </div>
                        </div>
                        <!-- End Nested Comment -->
                        <?php endforeach; ?>

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <div class="col-md-4">

                <!-- Blog Search Well -->
                <div class="well">
                    <h4>Blog Search</h4>
                    <div class="input-group">
                        <input type="text" class="form-control">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button">
                                <span class="glyphicon glyphicon-search"></span>
                        </button>
                        </span>
                    </div>
                    <!-- /.input-group -->
                </div>

                <!-- Blog Categories Well -->
                <div class="well">
                    <h4>Blog Categories</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-6">
                            <ul class="list-unstyled">
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                                <li><a href="#">Category Name</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>

                <!-- Side Widget Well -->
                <div class="well">
                    <h4>Side Widget Well</h4>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
                </div>

            </div>

        </div>
        <!-- /.row -->

       

        
    </div>
    

</body>

</html>
<?php include("includes/footer.php"); ?>