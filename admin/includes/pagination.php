<?php
/* 
 * Specific methods to using pagination
 */



class Pagination
{
    public $current_page;
    public $items_per_page;
    public $items_total_count;
    
    public function __construct($page, $items_per_page, $items_total_count)
    {
        $this->current_page = $page;
        $this->items_per_page = $items_per_page;
        $this->items_total_count = $items_total_count;
    }
    
    public function next()
    {
        return $this->current_page + 1;
    }
    
    public function previous()
    {
        return $this->current_page - 1;
    }
    
    public function page_total()
    {
        return ceil($this->items_total_count / $this->items_per_page);
    }
    
    public function has_previous()
    {
        return $this->previous() >= 1 ? true : false;
    }
    
    public function has_next()
    {
        return $this->next() <= $this->page_total() ? true : false;
    }
    
    public function offset()
    {
        return ($this->current_page - 1) * $this->items_per_page;
    }
    
    public function last_page()
    {
        return fmod($this->items_total_count, $this->items_per_page) == 1 ? $this->current_page - 1 : $this->current_page;
    }

    
}