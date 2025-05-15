<?php

class Sitemap extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // We load the url helper to be able to use the base_url() function
        $this->load->helper('url');

        $this->load->model('SitemapModel');

        // Array of some articles for demonstration purposes
    }

    /**
     * Generate a sitemap index file
     * More information about sitemap indexes: http://www.sitemaps.org/protocol.html#index
     */
    public function index() {
        $this->SitemapModel->add(base_url(), NULL, 'monthly', 1);
        $this->SitemapModel->add(base_url('about-us'), NULL, 'monthly', 0.9);
        $this->SitemapModel->add(base_url('appointment'), NULL, 'monthly', 0.9);
        $this->SitemapModel->add(base_url('measurements-guide'), NULL, 'monthly', 0.9);
        $this->SitemapModel->add(base_url('lookbook'), NULL, 'monthly', 0.9);
        $this->SitemapModel->add(base_url('contact'), NULL, 'monthly', 0.9);
        $this->SitemapModel->add(base_url('offers'), NULL, 'monthly', 0.9);
        $this->SitemapModel->add(base_url('privacy-policy'), NULL, 'monthly', 0.9);
        $this->SitemapModel->add(base_url('faqs'), NULL, 'monthly', 0.9);
        $this->SitemapModel->add(base_url('terms-condition'), NULL, 'monthly', 0.9);

        $this->SitemapModel->output();
    }

    /**
     * Generate a sitemap both based on static urls and an array of urls
     */
    public function general() {
        $sitemap = [
            array('title' => 'ABOUT US', 'url' => base_url('Shop/aboutus'), 'suburl' => array()),
            array('title' => 'DESING NOW', 'url' => base_url('Product/ProductList/1/0'), 'suburl' => array(
                    array('title' => 'Shirts', 'url' => base_url('Product/ProductList/1/0')),
                    array('title' => 'Suits', 'url' => base_url('Product/ProductList/2/0')),
                    array('title' => 'Jackets', 'url' => base_url('Product/ProductList/4/0')),
                    array('title' => 'Pants', 'url' => base_url('Product/ProductList/3/0')),
                    array('title' => 'Tuxedo Suits', 'url' => base_url('Product/ProductList/5/0')),
                )),
            array('title' => 'Terms of Service', 'url' => base_url('term-of-service'), 'suburl' => array()),
            array('title' => 'Privacy Policy', 'url' => base_url('privacy-policy'), 'suburl' => array()),
            array('title' => "FAQ's", 'url' => base_url('Shop/faqs'), 'suburl' => array()),
            array('title' => "Contact Information", 'url' => base_url('Shop/contactus'), 'suburl' => array()),
            array('title' => "Offers - Shirt", 'url' => base_url('Product/productListOffers?category=0&item_type=1&sorting=On+Sale'), 'suburl' => array()),
            array('title' => "Tour Schedule", 'url' => base_url('Shop/schedule'), 'suburl' => array()),
        ];
        $blog = [];

        $data['sitemap'] = $sitemap;
        $this->load->view('Pages/sitemap', $data);
    }

    /**
     * Generate a sitemap only on an array of urls
     */
    public function articles() {

        $this->SitemapModel->output();
    }

}
