<?php

use Tokenly\BitcoinAddressLib\BitcoinKeyUtils;
use \Exception;
use \PHPUnit_Framework_Assert as PHPUnit;

/*
* 
*/
class UtilsTest extends \PHPUnit_Framework_TestCase
{


    public function testUtils() {
        PHPUnit::assertEquals('03f05b88087b2392611d0eb388f11543b02b21d12c18aba21699e73e97a61fee15',  BitcoinKeyUtils::publicKeyFromWIF('L2KB5RqtHwLKrNaVuxQCiNs549vbp4oy7FTF2zs2GChLXXnXyMee'));
        PHPUnit::assertEquals('1NjZ3zsBySHtCWX3NtPFfmUXEwx7XeG82H',  BitcoinKeyUtils::addressFromWIF('L2KB5RqtHwLKrNaVuxQCiNs549vbp4oy7FTF2zs2GChLXXnXyMee'));
    }


}
