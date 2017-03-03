<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once 'src/Brand.php';

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class BrandTest extends PHPUnit_Framework_TestCase
    {
        function test_getters()
        {
            // Arrange
            $id = 1;
            $name = 'Nikus';
            $market_segment = "upscale athletic";
            $test_brand = new Brand ($name,$market_segment,$id);
            // Act
            $result = array($test_brand->getName(), $test_brand->getMarketSegment(), $test_brand->getId());
            $expected_result = array($name,$market_segment,$id);
            // Assert
            $this->assertEquals($expected_result, $result);
        }

        function test_setters()
        {
            // Arrange
            $id = 1;
            $name = 'Nikus';
            $market_segment = "athletic";
            $test_brand = new Brand ($name,$market_segment,$id);

            $name2 = 'Reeblic';
            $market_segment2 = "value athletic";
            // Act
            $test_brand->setName($name2);
            $test_brand->setMarketSegment($market_segment2);

            $result = array($test_brand->getName(), $test_brand->getMarketSegment(), $test_brand->getId());
            $expected_result = array($name2,$market_segment2,$id);

            // Assert
            $this->assertEquals($expected_result, $result);
        }
    }


?>
