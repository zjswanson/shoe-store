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

        function addBrand($brand_id)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$this->getId()}, {$brand_id});");
        }

        function getBrands()
        {
            $query = $GLOBALS['DB']->query("SELECT brands.* FROM
                stores JOIN stores_brands ON (stores.id = stores_brands.store_id)
                JOIN brands ON (stores_brands.brand_id = brands.id)
                WHERE stores.id = {$this->getId()};");
            $found_brands = $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Brand", array('name', 'market_segment', 'id'));
            return $found_brands;
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
            $GLOBALS['DB']->exec("DELETE FROM stores_brands;");
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
