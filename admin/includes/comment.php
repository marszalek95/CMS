<?php
/* @var $database Database*/
/* 
 * Specific methods to operating comments
 */


class Comment extends Db_object
{
    protected static $db_table = "comments";
    protected static $db_table_fields = ['photo_id', 'user_id', 'author', 'body', 'status', 'date'];
    public $id;
    public $photo_id;
    public $user_id;
    public $author;
    public $body;
    public $status;
    public $date;


    public static function find_all_comments($photo_id)
    {
        $sql = "SELECT * FROM " . self::$db_table . " WHERE photo_id = " . $photo_id . " ORDER BY photo_id ASC";
        
        return self::find_this_query($sql);
    }
    
    public static function find_all_comments_pagination($photo_id, $items_per_page, $offset)
    {
        $sql = "SELECT * FROM " . self::$db_table . " WHERE photo_id = " . $photo_id . " ORDER BY photo_id ASC LIMIT {$items_per_page} OFFSET {$offset}";
        
        return self::find_this_query($sql);
    }
    
    public static function find_new_comments($user_id)
    {
        $sql = "SELECT * FROM " . self::$db_table . " WHERE status = 0 && user_id = {$user_id}";
        
        return self::find_this_query($sql);
    }
    
    public function updade_status($id)
    {
        global $database;
        $sql = "UPDATE " . static::$db_table . " SET status = 1 WHERE id=$id";
        $database->query($sql);
        
        return true;
    }

    public function delete_comment($photo_id)
    {
        global $database;
        $sql = "DELETE FROM " . static::$db_table . " WHERE photo_id=$photo_id";
        $database->query($sql);
        
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
}
