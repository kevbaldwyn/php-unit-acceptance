<?php

class AcceptanceTest extends \KevBaldwyn\Testing\AcceptanceTestCase {
	
	public function setUp() {
		/**
		 Screenshots will be taken on error, or you can manually take a screen shot by calling
		 $this->takeScreenshot([optional file name]);
		 
		 this protected $screenshot variable is inherited from \KevBaldwyn\Testing\AcceptanceTestCase 
		 here we are using it's default value "screenshots/", but appending the directory that this script lives in
		 we could set it to an absoulte path or other relative path in the class declaration, 
		 however take care as this variable if set relative will be relative to where phpunit is running
		 */
		$this->screenshotPath = __DIR__ . '/' . $this->screenshotPath;
		
		/**
		 be sure to set up the parent whcih initiates the WebDriver
		 */
		parent::setUp();
	}
	
	
	/**
	 * a simple test to test a link on a page goes to the correct page
	 * @see https://github.com/facebook/php-webdriver/ for more details of the WebDriver API
	 */
    public function test_homepage_goes_to_blog() {
        $this->session->open('http://framework.debian.vmlocal/');
        
        $this->session->element(
            'id', 
            'testLink'
        )->click();
        
        $this->assertSame(
            'http://framework.debian.vmlocal/blog/', 
            $this->session->url()
        );
    }
	
}
?>