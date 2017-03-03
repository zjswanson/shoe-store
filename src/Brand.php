<?php

    class Brand
    {
        private $name;
        private $market_segment;
        private $id;

        function __construct($name, $market_segment, $id=null)
        {
            $this->name = $name;
            $this->market_segment = $market_segment;
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

        function getMarketSegment()
        {
            return $this->market_segment;
        }
        function setMarketSegment($new_market_segment)
        {
            $this->market_segment = $new_market_segment;
        }

        function getId()
        {
            return $this->id;
        }

        function save()
        {
            $GLOBALS['DB']->exec("INSERT INTO brands (name, market_segment) VALUES ('{$this->getName()}', '{$this->getMarketSegment()}');");
            $this->id = $GLOBALS['DB']->lastInsertId();
        }

        function addStore($store_id)
        {
            $GLOBALS['DB']->exec("INSERT INTO stores_brands (store_id, brand_id) VALUES ({$store_id}, {$this->getId()});");
        }

        function getStores()
        {
            $query = $GLOBALS['DB']->query("SELECT stores.* FROM
                stores JOIN stores_brands ON (stores.id = stores_brands.store_id)
                JOIN brands ON (stores_brands.brand_id = brands.id)
                WHERE brands.id = {$this->getId()};");
            $found_stores = $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Store", array('name', 'target_market', 'id'));
            return $found_stores;
        }

        static function getAll()
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM brands;");
            $found_brands = $query->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Brand", array('name', 'market_segment', 'id'));
            return $found_brands;
        }

        static function deleteAll()
        {
            $GLOBALS['DB']->exec("DELETE FROM brands;");
        }

        static function find($search_id)
        {
            $query = $GLOBALS['DB']->query("SELECT * FROM brands WHERE id = {$search_id};");
            $query->setFetchMode(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Brand", array('name', 'target_market', 'id'));
            $found_brand = $query->fetch();
            return $found_brand;
        }
    }
?>
