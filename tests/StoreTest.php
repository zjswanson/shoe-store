<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once 'src/Store.php';

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        function test_getters()
        {
            // Arrange
            $id = 1;
            $name = 'ShoEmporium';
            $target_market = "discount";
            $test_store = new Store ($name,$target_market,$id);
            // Act
            $result = array($test_store->getName(), $test_store->getTargetMarket(), $test_store->getId());
            $expected_result = array($name,$target_market,$id);
            // Assert
            $this->assertEquals($result, $expected_result);
        }

        function test_setters()
        {
            // Arrange
            $id = 1;
            $name = 'ShoEmporium';
            $target_market = "discount";
            $test_store = new Store ($name,$target_market,$id);
            $id = 1;
            $name2 = 'Fancy Feet';
            $target_market2 = "luxury";
            // Act
            $test_store->setName($name2);
            $test_store->setName($target_market2);
            $result = array($test_store->getName(), $test_store->getTargetMarket(), $test_store->getId());
            $expected_result = array($name2,$target_market2,$id);
            // Assert
            $this->assertEquals($result, $expected_result);
        }
    }
?>
