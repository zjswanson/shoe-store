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
    }
?>
