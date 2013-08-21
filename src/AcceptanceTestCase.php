<?php

namespace KevBaldwyn\Testing;

use WebDriver;
use WebDriverCapabilityType;

class AcceptanceTestCase extends \PHPUnit_Framework_TestCase {
    
    /** 
     * @var WebDriverSession
     */
    protected $session;
    
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
        $imgData = $this->session->takeScreenshot();
        if(!file_exists($this->screenshotPath)) {
            mkdir($this->screenshotPath);
        }
        file_put_contents($this->screenshotPath . date('Y-m-d.H.i.s') . '-'.$name.'.png', $imgData);
    }
    
    public function setUp() {
        parent::setUp();
        $this->session = new WebDriver('http://localhost:4444/wd/hub', 
                                        array(WebDriverCapabilityType::BROWSER_NAME => 'firefox'));
    }

    public function tearDown() {
                            
        $status = $this->getStatus();
        if (in_array($status, $this->failStatus)) {
            $this->takeScreenshot();
        }
        
        $this->session->close();
        unset($this->session);
        parent::tearDown();
    }
    
}
?>