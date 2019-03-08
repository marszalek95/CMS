<?php



class Photo extends Db_object
{
    protected static $db_table = "photos";
    protected static $db_table_fields = ['add_by_id', 'title', 'caption', 'description', 'filename', 'alternate_text', 'type', 'size', 'views'];
    public $id;
    public $add_by_id;
    public $title;
    public $caption;
    public $description;
    public $filename;
    public $alternate_text;
    public $type;
    public $size;
    public $views;

    public $tmp_path;
    public $upload_directory = "images";

    
    public static function photos_pagination($items_per_page, $offset)
    {
        $sql = "SELECT * FROM " . static::$db_table . " LIMIT {$items_per_page} OFFSET {$offset}";
        
        return static::find_this_query($sql);
    }
    
    public static function count_records_by_user($user_id)
    {
        global $database;
        
        $sql = "SELECT * FROM " . static::$db_table . " WHERE add_by_id = " . $user_id . " ORDER BY add_by_id ASC";
        $result_set = $database->query($sql);
        return mysqli_num_rows($result_set);
        
    }
    
    public static function photos_added_by_user($user_id, $items_per_page, $offset)
    {
        $sql = "SELECT * FROM " . self::$db_table . " WHERE add_by_id = " . $user_id . " ORDER BY add_by_id ASC LIMIT {$items_per_page} OFFSET {$offset}";
        
        return self::find_this_query($sql);

    }
    
    public static function count_photo_views($id) 
    {
        global $database;
        $database->query("UPDATE " . static::$db_table . " SET views = views + 1 WHERE id=$id");
        return true;
    }
    
    public function show_counter($id)
    {
        global $database;
        
        $result = $database->query("SELECT views FROM " . static::$db_table . " WHERE id=$id");
        if ($result->num_rows > 0) 
        {
            while($row = $result->fetch_assoc()) 
            {
                return $visits = $row["views"];
            }
        } 
        else 
        {
            echo "no results";
        }
    }
    
    
    }






















?>