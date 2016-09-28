<?php

use Tokenly\BitcoinAddressLib\BitcoinAddressGenerator;
use Tokenly\BitcoinAddressLib\BitcoinKeyUtils;
use \PHPUnit_Framework_Assert as PHPUnit;

/*
* 
*/
class AddressGeneratorTest extends \PHPUnit_Framework_TestCase
{


    public function testGenerator() {
        $generator = $this->getGenerator();
        PHPUnit::assertEquals('1C4udvmiyZzCm1ZRrScexrMaNKqivyPXkU', $generator->publicAddress('mytoken1'));
        PHPUnit::assertEquals('df9f75b1ba89d793fd578f76a25ba6b6365427e7e32eb191718eb002cfbb5ca9', $generator->privateKey('mytoken1')->getHex());
        PHPUnit::assertEquals('L4iQRBZz1XuqvE6qyfQZAn6AtiudyT9dnQTvnHU5n3TQ9G45sPJ3', $generator->WIFPrivateKey('mytoken1'));
        $extended_private_key = $generator->newMasterKey(md5('myseed'))->toExtendedPrivateKey();
        PHPUnit::assertEquals("xprv9s21ZrQH143K3BG8ruCqZYYjEisNstdzzBoqGXg2L8swRxApZhrwvWwhh3WC92oxXc3PnFRvUryKsWxo634robPbQ42ua3pRJVshYXL2pEm", $extended_private_key);
    }


    protected function getGenerator() {
        return new BitcoinAddressGenerator('testseed123');
    }
}
