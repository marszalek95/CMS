

<?php

$author = User::find_by_id($photo->add_by_id);

?>

<!-- Side Widget Well -->
<div class="well">
    <h3>About author</h3>
    <img class="author-photo" src="admin/<?php echo $author->picture_path();  ?>" alt="">
    <h4><?php echo "{$author->first_name} {$author->last_name}"; ?></h4>
    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore, perspiciatis adipisci accusamus laudantium odit aliquam repellat tempore quos aspernatur vero.</p>
    <p><a href="add_by.php?id=<?php echo $author->id; ?>">See my photos.</a></p>
</div>

</div>