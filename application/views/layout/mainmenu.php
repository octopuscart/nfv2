<?php
$menuArrayMain = [
    array("title" => "Home", "link" => site_url("/"), "submenu" => [
            array("title" => "About Us", "link" => site_url("Shop/aboutus"), "submenu" => []),
            array("title" => "FAQ's", "link" => site_url("Shop/faqs"), "submenu" => []),
            array("title" => "Terms of Service", "link" => site_url("Shop/term_of_service"), "submenu" => []),
            array("title" => "Privacy Policy", "link" => site_url("Shop/privacy_policy"), "submenu" => []),
            array("title" => "Schedule", "link" => site_url("Shop/schedule"), "submenu" => []),
            array("title" => "Contact Us", "link" => site_url("Shop/contactus"), "submenu" => []),
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
            array("title" => "3 Piece Suit","link" =>  site_url("Product/productList?category=0&item_type=13"), "submenu" => []),
            array("title" => "Pant", "link" => site_url("Product/productList?category=0&item_type=2"), "submenu" => []),
            array("title" => "Jacket", "link" => site_url("Product/productList?category=0&item_type=5"), "submenu" => []),
            array("title" => "Waistcoat", "link" => site_url("Product/productList?category=0&item_type=3"), "submenu" => []),
            array("title" => "Sports Jacket", "link" => site_url("Product/productList?category=0&item_type=12"), "submenu" => []),
            array("title" => "Overcoat", "link" => site_url("Product/productList?category=0&item_type=15"), "submenu" => []),
        ]),
    array("title" => "About Us", "link" => site_url("Shop/aboutus"), "submenu" => []),
    array("title" => "Schedule", "link" => site_url("Shop/schedule"), "submenu" => []),
    array("title" => "Contact Us", "link" => site_url("Shop/contactus"), "submenu" => []),
    array("title" => "Offers", "link" => site_url("Product/productListOffers"."?category=0&item_type=1&sorting=On+Sale"), "submenu" => []),
    array("title" => "Guide", "link" => site_url("Shop/guide"), "submenu" => []),
];
?>




