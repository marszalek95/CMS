<?php

class Counter
{
    
    public static function count_visits() 
    {
        global $database;
        $database->query("UPDATE counter SET counter = counter + 1");
    }
    
    public static function show_counter()
    {
        global $database;
        
        $result = $database->query("SELECT counter FROM counter");
        if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            return $visits = $row["counter"];
        }
        } 
        else 
        {
            echo "no results";
        }
        
        
    }
}

?>