<?php

namespace Tokenly\BitcoinAddressLib;

use BitWasp\Bitcoin\Key\PrivateKeyFactory;
use Exception;

/*
* BitcoinKeyUtils
*/
class BitcoinKeyUtils
{

    ////////////////////////////////////////////////////////////////////////

    public static function publicKeyFromWIF($wif, $verify_address=null) {
        $private_key_instance = PrivateKeyFactory::fromWif($wif);
        $public_key_instance = $private_key_instance->getPublicKey();
        return $public_key_instance->getHex();
    }

    public static function addressFromWIF($wif) {
        $private_key_instance = PrivateKeyFactory::fromWif($wif);
        $address_instance = $private_key_instance->getAddress();
        return $address_instance->getAddress();
    }

    public static function publicKeyFromPrivateKey($private_key_instance) {
        return $private_key_instance->getPublicKey();
    }

    public static function WIFFromPrivateKey($private_key) {
        return $private_key->toWif();
    }



    ////////////////////////////////////////////////////////////////////////

}

