<?php
/* @var $database Database*/
/* 
 * Specific methods to operating users interface
 */



class User extends Db_object
{
    protected static $db_table = "users";
    protected static $db_table_fields = ['username', 'password', 'first_name', 'last_name', 'description',  'user_image'];
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
    public $description;
    public $user_image;
    public $upload_directory = "images";
    public $image_placeholder = "http://placehold.it/400x400&texy=image";
     
    public $filename;
    public $tmp_path;

    
    public function image_path_and_placeholder()
    {
        return empty($this->user_image) ? $this->image_placeholder : $this->upload_directory . DS . $this->user_image;
    }
    
    public function picture_path()
    {
        return $this->upload_directory . DS . $this->user_image;
    }

    public static function check_username($username)
    {
        global $database;
        
        $sql = "SELECT * FROM " . static::$db_table . " WHERE username ='{$username}'";
        
        $result = $database->query($sql);
        
        return mysqli_num_rows($result) > 0 ? true : false; 
    }

    public static function verify_user($username)
    {
       global $database;

       $username = $database->escape_string($username);
       
      
       
       $sql = "SELECT * FROM " . static::$db_table . " WHERE username ='{$username}' LIMIT 1";
       
       $the_result_array = self::find_this_query($sql);
        
       return !empty($the_result_array) ? array_shift($the_result_array) : false; 
    }



    
}
