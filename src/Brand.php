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
    }
?>
