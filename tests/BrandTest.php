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
        protected function tearDown()
        {
            Brand::deleteAll();
            Store::deleteAll();
        }

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

        function test_save()
        {
            // Arrange
            $name = 'Nikus';
            $market_segment = "upscale athletic";
            $test_brand = new Brand ($name,$market_segment);

            // Act
            $test_brand->save();
            $result = Brand::getAll();

            // Assert
            $this->assertEquals([$test_brand], $result);
        }

        function test_getAll()
        {
            // Arrange
            $name = 'Nikus';
            $market_segment = "upscale athletic";
            $test_brand = new Brand ($name,$market_segment);
            $test_brand->save();

            $name2 = 'Reeblic';
            $market_segment2 = "value athletic";
            $test_brand2 = new Brand ($name2,$market_segment2);
            $test_brand2->save();

            // Act
            $result = Brand::getAll();

            // Assert
            $this->assertEquals([$test_brand, $test_brand2], $result);
        }

        function test_find()
        {
            // Arrange
            $name = 'Nikus';
            $market_segment = "upscale athletic";
            $test_brand = new Brand ($name,$market_segment);
            $test_brand->save();

            $name2 = 'Reeblic';
            $market_segment2 = "value athletic";
            $test_brand2 = new Brand ($name2,$market_segment2);
            $test_brand2->save();

            // Act
            $result = Brand::find($test_brand2->getId());

            // Assert
            $this->assertEquals($test_brand2, $result);
        }

        function test_addStore()
        {
            // Arrange
            $name = 'ShoEmporium';
            $target_market = "discount";
            $test_store = new Store ($name,$target_market);
            $test_store->save();

            $brand_name = 'Nikus';
            $market_segment = "upscale athletic";
            $test_brand = new Brand ($brand_name,$market_segment);
            $test_brand->save();

            //Act
            $test_brand->addStore($test_store->getId());
            $result = $test_brand->getStores();

            //Assert
            $this->assertEquals([$test_store],$result);
        }

        function test_getStores()
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

            $brand_name = 'Nikus';
            $market_segment = "upscale athletic";
            $test_brand = new Brand ($brand_name,$market_segment);
            $test_brand->save();

            //Act
            $test_brand->addStore($test_store->getId());
            $test_brand->addStore($test_store2->getId());
            $result = $test_brand->getStores();

            //Assert
            $this->assertEquals([$test_store, $test_store2],$result);
        }


    }


?>
