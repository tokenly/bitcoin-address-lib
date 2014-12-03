<?php

use Tokenly\BitcoinAddressLib\BitcoinAddressGenerator;
use Tokenly\BitcoinAddressLib\BitcoinKeyUtils;
use \Exception;
use \PHPUnit_Framework_Assert as PHPUnit;

/*
* 
*/
class AddressGeneratorTest extends \PHPUnit_Framework_TestCase
{


    public function testGenerator() {
        $generator = $this->getGenerator();
        PHPUnit::assertEquals('1C4udvmiyZzCm1ZRrScexrMaNKqivyPXkU', $generator->publicAddress('mytoken1'));
        PHPUnit::assertEquals('xprv9vcFJtcDuPUmRd2hj7CqjyFSAuYzrn7aeb97k5rjEPYjLhQZrC9pAVm95nHHAMZAEQ23gfRhk8rYHeZYdx1TVvugYfbLKC941XSsifzE2Ta', $generator->privateKey('mytoken1'));
        PHPUnit::assertEquals('L4iQRBZz1XuqvE6qyfQZAn6AtiudyT9dnQTvnHU5n3TQ9G45sPJ3', $generator->WIFPrivateKey('mytoken1'));
        PHPUnit::assertEquals(["xprv9s21ZrQH143K3BG8ruCqZYYjEisNstdzzBoqGXg2L8swRxApZhrwvWwhh3WC92oxXc3PnFRvUryKsWxo634robPbQ42ua3pRJVshYXL2pEm","m"], $generator->newMasterKey(md5('myseed')));
    }


    protected function getGenerator() {
        return new BitcoinAddressGenerator('testseed123');
    }
}
