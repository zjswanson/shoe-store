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
            $GLOBALS['DB']->exec("INSERT INTO stores (name, target_market) VALUES ('{$this->getName()}', '{$this->getTargetMarket()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        static function getAll()
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM stores;");
            $found_stores = $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Store", array('name', 'target_market', 'id'));
            return $found_stores;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores;");
        }
    }
?>
