<?php

use Tokenly\BitcoinAddressLib\BitcoinAddressGenerator;
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

        $generator = $this->getGenerator();
        $private_key = $generator->privateKey('mytoken1');
        PHPUnit::assertEquals('034fba8396613ae90defdc45e2e924a4bda2e1b94d653d4d28111523cc57ccb8d7',  BitcoinKeyUtils::publicKeyFromPrivateKey($private_key, '1C4udvmiyZzCm1ZRrScexrMaNKqivyPXkU'));
        PHPUnit::assertEquals('L4iQRBZz1XuqvE6qyfQZAn6AtiudyT9dnQTvnHU5n3TQ9G45sPJ3',  BitcoinKeyUtils::WIFFromPrivateKey($private_key));

    }

    protected function getGenerator() {
        return new BitcoinAddressGenerator('testseed123');
    }

}
