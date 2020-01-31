<?php
$menuArrayMain = [
    array("title" => "Home", "link" => "", "submenu" => [
            array("title" => "About Us", "link" => "", "submenu" => []),
            array("title" => "FAQ's", "link" => "", "submenu" => []),
            array("title" => "Terms of Service", "link" => "", "submenu" => []),
            array("title" => "Privacy Policy", "link" => "", "submenu" => []),
            array("title" => "Schedule", "link" => "", "submenu" => []),
            array("title" => "Contact Us", "link" => "", "submenu" => []),
        ]),
    array("title" => "Customize Now", "link" => "", "submenu" => [
            array("title" => "Shirt", "link" => site_url("Product/productList?category=0&item_type=1"), "submenu" => []),
            array("title" => "Tuxedo", "link" => "", "submenu" => [
                    array("title" => "Shirt", "link" => site_url("Product/productList?category=0&item_type=7")),
                    array("title" => "Pant", "link" => site_url("Product/productList?category=0&item_type=8")),
                    array("title" => "Jacket", "link" => site_url("Product/productList?category=0&item_type=14")),
                    array("title" => "Suit", "link" => site_url("Product/productList?category=0&item_type=10")),
                ]),
            array("title" => "Suit", "link" => site_url("Product/productList?category=0&item_type=11"), "submenu" => []),
            array("title" => "3 Piece Suit", "link" => "", "submenu" => []),
            array("title" => "Pant", "link" => site_url("Product/productList?category=0&item_type=2"), "submenu" => []),
            array("title" => "Jacket", "link" => site_url("Product/productList?category=0&item_type=5"), "submenu" => []),
            array("title" => "Waistcoat", "link" => site_url("Product/productList?category=0&item_type=3"), "submenu" => []),
            array("title" => "Sports Jacket", "link" => site_url("Product/productList?category=0&item_type=12"), "submenu" => []),
            array("title" => "Overcoat", "link" => site_url("Product/productList?category=0&item_type=15"), "submenu" => []),
        ]),
    array("title" => "About Us", "link" => "", "submenu" => []),
    array("title" => "Schedule", "link" => "", "submenu" => []),
    array("title" => "Contact Us", "link" => "", "submenu" => []),
    array("title" => "Offers", "link" => "", "submenu" => []),
    array("title" => "Guide", "link" => "", "submenu" => []),
];
?>




