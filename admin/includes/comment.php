<?php
/* @var $database Database*/


class Comment extends Db_object
{
    protected static $db_table = "comments";
    protected static $db_table_fields = ['photo_id', 'author', 'body'];
    public $id;
    public $photo_id;
    public $author;
    public $body;


    
    public static function find_all_comments($photo_id)
    {
        $sql = "SELECT * FROM " . self::$db_table . " WHERE photo_id = " . $photo_id . " ORDER BY photo_id ASC";
        
        return self::find_this_query($sql);
    }

    public function delete_comment($photo_id)
    {
        global $database;
        
        $id = $database->escape_string($this->id);
        
        $sql = "DELETE  FROM " . static::$db_table . " WHERE photo_id=$photo_id";
        
        $database->query($sql);
        
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
}
