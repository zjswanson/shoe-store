<?php

    class Store
    {
        private $name;
        private $target_market;
        private $id;

        function __construct($name, $target_market, $id=null)
        {
            $this->name = $name;
            $this->target_market = $target_market;
            $this->id = $id;
        }

        
    }
?>
