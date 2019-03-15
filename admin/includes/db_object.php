<?php

class Db_object
{
    
    public $errors = array();
    public $upload_errors_array = array(
        UPLOAD_ERR_OK => "There is no error",
        UPLOAD_ERR_INI_SIZE => "The uploaded file exceeds the upload_max_filezize directory",
        UPLOAD_ERR_FORM_SIZE => "The uploaded file exceeds the max_file_size directory",
        UPLOAD_ERR_PARTIAL => "The uploaded file was only partially uploaded",
        UPLOAD_ERR_NO_FILE => "No file was uploaded",
        UPLOAD_ERR_NO_TMP_DIR => "Missing a temporary folder",
        UPLOAD_ERR_CANT_WRITE => "Failed to write file to disk",
        UPLOAD_ERR_EXTENSION => "A PHP extemsion stopped the file upload"
    );
    
    
    
    public static function find_all()
    {
        return static::find_this_query("SELECT * FROM " . static::$db_table . "");
    }
    
    public static function find_all_pagination($items_per_page, $offset)
    {
        $sql = "SELECT * FROM " . static::$db_table . " LIMIT {$items_per_page} OFFSET {$offset}";
        
        return static::find_this_query($sql);
    }
    
    public static function find_by_id($id)
    {

        $the_result_array = static::find_this_query("SELECT * FROM " . static::$db_table . " WHERE id=$id");
        
        return !empty($the_result_array) ? array_shift($the_result_array) : false;
    }
    
    public static function find_this_query($sql)
    {
        global $database;
        $result_set = $database->query($sql);
        $the_object_array = array();
        
         while($row = mysqli_fetch_array($result_set))
        {
            $the_object_array[] = static::instantation($row);
        }
        return $the_object_array;
    }
    
    public static function instantation($the_record)
    {
        $calling_class = get_called_class();
        $the_object = new $calling_class;
        
        foreach ($the_record as $the_attribute => $value)
        {
            if($the_object->has_the_attribute($the_attribute))
            {
                $the_object->$the_attribute = $value;
            }
        }     
        return $the_object;
    }
    
    private function has_the_attribute($the_attribute)
    {
        $object_properties = get_object_vars($this);
        return array_key_exists($the_attribute, $object_properties);
    }
        
    protected function properties()
    {
        $properties = array();
        
        foreach (static::$db_table_fields as $db_field)
        {
            if(property_exists($this, $db_field))
            {
                $properties[$db_field] = $this->$db_field;
            }
        }
        return $properties;
    }

    protected function clean_properties()
    {
        global $database;
        
        $clean_properties = array();
        
        foreach ($this->properties() as $key => $value)
        {
            $clean_properties[$key] = $database->escape_string($value);
        }
        return $clean_properties;
    }
    
    public function save()
    {
        return isset($this->id) ? $this->update() : $this->create(); 
    }

    public function create()
    {
        global $database;
        
        $properties = $this->properties();
        
        $sql = "INSERT INTO " . static::$db_table . " (" . implode(",", array_keys($properties)) . ") 
                VALUES ('" . implode("','", array_values($properties)) . "')";
               
        
        if($database->query($sql))
        {
            $this->id = $database->the_insert_id();
            return true;
        }
        else
        {
            return false;
        }
    }
    
    public function update()
    {
        global $database;
        
        $properties = $this->properties();
        $properties_pairs = array();
        
        $id = $database->escape_string($this->id);
        
        foreach ($properties as $key => $value)
        {
            $properties_pairs[] = "{$key}='{$value}'";
        }
        
        $sql = "UPDATE " . static::$db_table . " SET " . implode(", ", $properties_pairs) . " WHERE id=$id";
        
        $database->query($sql);
        
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;            
    }
    
    public function delete()
    {
        global $database;
        
        $id = $database->escape_string($this->id);
        
        $sql = "DELETE  FROM " . static::$db_table . " WHERE id=$id";
        
        $database->query($sql);
        
        return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }
    
    
    /* Photo functions */
    
        public function set_file($file)
    {
        if(empty($file) || !$file || !is_array($file))
        {
            $this->errors[] = "There was no file uploaded here!";
            return false;
        }
        elseif($file['error'] != 0)
        {
            $this->errors[] = $this->upload_errors_array[$file['error']];
            return false;
        }
        else
        {
            $this->filename = basename($file['name']);
            $this->tmp_path = $file['tmp_name'];
            $this->type = $file['type'];
            $this->size = $file['size'];
        }
    }
    
    public function picture_path()
    {
        return $this->upload_directory . DS . $this->filename;
    }
    
    public function upload_photo()
    {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->upload_directory . DS . $this->filename;
            
            
            
            if(empty($this->filename || $this->tmp_path))
            {
                $this->errors[] = "The file was not avialable";
                return false;
            }
            
            if(file_exists($target_path))
            {
                $this->errors[] = "The fie {$this->filename} already exists";
                return false;
            }
            if(empty($this->errors))
            {
                if(move_uploaded_file($this->tmp_path, $target_path))
                {
                    unset($this->tmp_path);
                    return true;
                }
            }      
            else
            {
                $this->errors[] = "The file directory propably does not have permisions";
                return false;
            }
    }
    
    public function delete_photo()
    {
            $target_path = SITE_ROOT . DS . 'admin' . DS . $this->picture_path();
            return unlink($target_path) ? true : false;
    }
    
    public function save_all()
    {
        if($this->upload_photo() && $this->create())
        {
            return true;
        }
    }
    
    public function delete_all()
    {
        if($this->delete() && $this->delete_photo())
        {
            return true;
        }
    }
    
    public static function count_records()
    {
        global $database;
        
        $sql = "SELECT * FROM " . static::$db_table;
        $result_set = $database->query($sql);
        return mysqli_num_rows($result_set);
        
    }
    
    
    
}

?>