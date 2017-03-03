<?php
    /**
    * @backupGlobals disabled
    * @backupStaticAttributes disabled
    */
    require_once 'src/Store.php';
    require_once 'src/Brand.php';

    $server = 'mysql:host=localhost:8889;dbname=shoes_test';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    class StoreTest extends PHPUnit_Framework_TestCase
    {
        protected function tearDown()
        {
            Store::deleteAll();
            Brand::deleteAll();
        }

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
            $this->assertEquals($expected_result, $result);
        }

        function test_setters()
        {
            // Arrange
            $id = 1;
            $name = 'ShoEmporium';
            $target_market = "discount";
            $test_store = new Store ($name,$target_market,$id);

            $name2 = 'Fancy Feet';
            $target_market2 = "luxury";
            // Act
            $test_store->setName($name2);
            $test_store->setTargetMarket($target_market2);

            $result = array($test_store->getName(), $test_store->getTargetMarket(), $test_store->getId());
            $expected_result = array($name2,$target_market2,$id);

            // Assert
            $this->assertEquals($expected_result, $result);
        }

        function test_save()
        {
            // Arrange
            $name = 'ShoEmporium';
            $target_market = "discount";
            $test_store = new Store ($name,$target_market);

            // Act
            $test_store->save();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store],$result);
        }

        function test_getAll()
        {
            // Arrange
            $name = 'ShoEmporium';
            $target_market = "discount";
            $test_store = new Store ($name,$target_market);
            $test_store->save();

            $name2 = 'Fancy Feet';
            $target_market2 = "luxury";
            $test_store2 = new Store ($name2,$target_market2);
            $test_store2->save();

            // Act
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store, $test_store2],$result);
        }

        function test_find()
        {
            // Arrange
            $name = 'ShoEmporium';
            $target_market = "discount";
            $test_store = new Store ($name,$target_market);
            $test_store->save();

            $name2 = 'Fancy Feet';
            $target_market2 = "luxury";
            $test_store2 = new Store ($name2,$target_market2);
            $test_store2->save();

            // Act
            $result = Store::find($test_store2->getId());

            //Assert
            $this->assertEquals($test_store2,$result);
        }
        function test_delete()
        {
            // Arrange
            $name = 'ShoEmporium';
            $target_market = "discount";
            $test_store = new Store ($name,$target_market);
            $test_store->save();

            $name2 = 'Fancy Feet';
            $target_market2 = "luxury";
            $test_store2 = new Store ($name2,$target_market2);
            $test_store2->save();

            // Act
            $test_store->delete();
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store2],$result);
        }

        function test_updateProperty()
        {
            // Arrange
            $name = 'ShoEmporium';
            $target_market = "discount";
            $test_store = new Store ($name,$target_market);
            $test_store->save();

            $name2 = 'Fancy Feet';
            $target_market2 = "luxury";

            // Act
            $test_store->updateProperty("name",$name2);
            $test_store->updateProperty("target_market",$target_market2);
            $result = Store::getAll();

            //Assert
            $this->assertEquals([$test_store],$result);
        }

        function test_addBrand()
        {
            // Arrange
            $brand_name = 'Nikus';
            $market_segment = "upscale athletic";
            $test_brand = new Brand ($brand_name,$market_segment);
            $test_brand->save();

            $name = 'ShoEmporium';
            $target_market = "discount";
            $test_store = new Store ($name,$target_market);
            $test_store->save();

            //Act
            $test_store->addBrand($test_brand->getId());
            $result = $test_store->getBrands();

            //Assert
            $this->assertEquals([$test_brand],$result);
        }

        function test_getBrands()
        {
            // Arrange
            $brand_name = 'Nikus';
            $market_segment = "upscale athletic";
            $test_brand = new Brand ($brand_name,$market_segment);
            $test_brand->save();

            $brand_name2 = 'Reeblic';
            $market_segment2 = "value athletic";
            $test_brand2 = new Brand ($brand_name2,$market_segment2);
            $test_brand2->save();

            $name = 'ShoEmporium';
            $target_market = "discount";
            $test_store = new Store ($name,$target_market);
            $test_store->save();
            $test_store->addBrand($test_brand->getId());
            $test_store->addBrand($test_brand2->getId());

            //Act
            $result = $test_store->getBrands();

            //Assert
            $this->assertEquals([$test_brand, $test_brand2],$result);
        }
    }
?>
