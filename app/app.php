<?php
    date_default_timezone_set('America/Los_Angeles');

    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Store.php";
    require_once __DIR__."/../src/Brand.php";

    $app = new Silex\Application();

    $app['debug'] = true;


    $server = 'mysql:host=localhost:8889;dbname=shoes';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->register(new Silex\Provider\TwigServiceProvider(), array(
        'twig.path' => __DIR__.'/../views'
    ));

    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();


    // Landing page.
    $app->get("/", function() use ($app) {
        return $app['twig']->render('landing.html.twig');
    });

    // Store List: see list of stores, add stores, delete all stores, nav to specific stores, brand list
    $app->get("/store_list", function() use ($app) {

        return $app['twig']->render('store_list.html.twig', array('stores' => Store::getAll()));
    });


    // Brand List: see list of brands, add brands, delete all brands, nav to specific stores, store list


    // Specific Store: see list of store's brands, add brand to store, nav to specific brand , store list, brand list

    // Specific Brand: see list of brand's stores, add store to brand, nav to specific store , store list, store list

    // This route is here to auto populate data and relationships for UI testing.
    $app->get("/populate_values", function() use ($app) {
        $name = 'ShoEmporium';
        $target_market = "discount";
        $test_store = new Store ($name,$target_market);
        $test_store->save();

        $name2 = 'Fancy Feet';
        $target_market2 = "luxury";
        $test_store2 = new Store ($name2,$target_market2);
        $test_store2->save();

        $name3 = 'Foots McBoots';
        $target_market3 = "family";
        $test_store3 = new Store ($name3,$target_market3);
        $test_store3->save();

        $name4 = 'Twinkle Toe';
        $target_market4 = "dance and performance";
        $test_store4 = new Store ($name4,$target_market4);
        $test_store4->save();

        $name = 'Nikus';
        $market_segment = "upscale athletic";
        $test_brand = new Brand ($name,$market_segment);
        $test_brand->save();

        $name2 = 'Reeblic';
        $market_segment2 = "value athletic";
        $test_brand2 = new Brand ($name2,$market_segment2);
        $test_brand2->save();

        $name3 = 'Ardiduss';
        $market_segment3 = "soccer and breakdancing";
        $test_brand3 = new Brand ($name3,$market_segment3);
        $test_brand3->save();

        $name4 = 'Mr. Spat';
        $market_segment4 = "formal";
        $test_brand4 = new Brand ($name4,$market_segment4);
        $test_brand4->save();

        $test_store->addBrand($test_brand->getId());
        $test_store->addBrand($test_brand2->getId());

        $test_store2->addBrand($test_brand2->getId());
        $test_store2->addBrand($test_brand3->getId());

        $test_store3->addBrand($test_brand3->getId());
        $test_store3->addBrand($test_brand4->getId());

        $test_store4->addBrand($test_brand->getId());
        $test_store4->addBrand($test_brand4->getId());

        return $app->redirect("/");
    });



    return $app;
?>
