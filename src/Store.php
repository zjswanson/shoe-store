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

        function getName()
        {
            return $this->name;
        }
        function setName($new_name)
        {
            $this->name = $new_name;
        }

        function getTargetMarket()
        {
            return $this->target_market;
        }
        function setTargetMarket($new_target_market)
        {
            $this->target_market = $new_target_market;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {

        }

        static function getAll()
        {

        }

        static function deleteAll()
        {
            
        }
    }
?>
