<?php 
abstract class ServiceProvider{
    public $db = null;
    function __construct()
    {
        $this->db = new Database();
    }
    abstract public function boot();
}
?>