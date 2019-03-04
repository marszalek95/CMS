<?php
/* @var $database Database*/


class User extends Db_object
{
    protected static $db_table = "users";
    protected static $db_table_fields = ['username', 'password', 'first_name', 'last_name', 'user_image'];
    public $id;
    public $username;
    public $password;
    public $first_name;
    public $last_name;
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

    public static function verify_user($username, $password)
    {
       global $database;

       $username = $database->escape_string($username);
       $password = $database->escape_string($password);
      
       
       $sql = "SELECT * FROM " . static::$db_table . " WHERE username ='{$username}' AND password ='{$password}' LIMIT 1";
       
       $the_result_array = self::find_this_query($sql);
        
       return !empty($the_result_array) ? array_shift($the_result_array) : false; 
    }



    
}
