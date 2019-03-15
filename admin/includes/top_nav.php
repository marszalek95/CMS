<?php

$user_session = User::find_by_id($session->user_id);
$new_comments = Comment::find_new_comments($session->user_id);
$comments_counter = count($new_comments);

?>


<div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="../index.php">Visit Home Page</a>
            </div>
            
            
            <!-- Top Menu Items -->
            <ul class="nav navbar-right top-nav">               
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell"></i> <b class="caret"></b></a>
                    <ul class="dropdown-menu alert-dropdown">
                                                             
                        <li>
                            <a href="new_comments.php">You have <?php echo $comments_counter; ?> new comments!</a>
                        </li>
                
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> 
                        <?php echo "{$user_session->first_name} {$user_session->last_name}"; ?>
                        <b class="caret"></b></a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="my_photos.php?id=<?php echo $session->user_id; ?>"><i class="fa fa-fw fa-user"></i> My photos</a>
                        </li>
                        <li>
                            <a href="edit_user.php?id=<?php echo $session->user_id; ?>"><i class="fa fa-fw fa-gear"></i> Profie settings</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="logout.php"><i class="fa fa-fw fa-power-off"></i> Log Out</a>
                        </li>
                    </ul>
                </li>
            </ul>
            

