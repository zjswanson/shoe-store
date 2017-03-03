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

        function updateProperty($property, $value)
        {
            $GLOBALS['DB']->exec("UPDATE stores SET {$property} = '{$value}' WHERE  id = {$this->getId()};");
            $this->$property = $value;
        }

        function delete()
        {
            $GLOBALS['DB']->exec("DELETE FROM stores WHERE id = {$this->getId()};");
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

        static function find($search_id)
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM stores WHERE id = {$search_id};");
            $query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Store", array('name', 'target_market', 'id'));
            $found_store = $query->fetch();
            return $found_store;
        }
    }
?>
