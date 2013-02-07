<?php

namespace KevBaldwyn\Testing;

use WebDriver;

class AcceptanceTestCase extends \PHPUnit_Framework_TestCase {
    
    /** 
     * @var WebDriverSession
     */
    protected $_session;
    
    /**
     * @var path to the location of where the screen shots will be stored (relative to the location phpunit script is called)
     */
    protected $screenshotPath = 'screenshots/';
    
  
    /**
     * some fail status for creating screen shots on
     */
	protected $failStatus = array(\PHPUnit_Runner_BaseTestRunner::STATUS_ERROR,
								  \PHPUnit_Runner_BaseTestRunner::STATUS_FAILURE);
    
    /**
     * take a screen shot
     */
    protected function takeScreenshot($name = 'screenshot') {
	    $imgData = base64_decode($this->_session->screenshot());
	    mkdir($this->screenshotPath);
        file_put_contents($this->screenshotPath . date('Y-m-d.H.i.s') . '-'.$name.'.png', $imgData);
    }
    
    public function setUp() {
        parent::setUp();
        $web_driver = new WebDriver\WebDriver();
        $this->_session = $web_driver->session();
    }

    public function tearDown() {
							
		$status = $this->getStatus();
		if (in_array($status, $this->failStatus)) {
		    $this->takeScreenshot();
		}
        
        $this->_session->close();
        unset($this->_session);
        parent::tearDown();
    }
    
}
?>