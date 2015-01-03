<?php

namespace Tokenly\BitcoinAddressLib;

use BitWasp\BitcoinLib\BIP32;
use BitWasp\BitcoinLib\BitcoinLib;
use Exception;

/*
* BitcoinKeyUtils
*/
class BitcoinKeyUtils
{

    ////////////////////////////////////////////////////////////////////////

    public static function publicKeyFromWIF($wif, $verify_address=null) {
        $is_valid = BitcoinLib::validate_WIF($wif);
        if (!$is_valid) { throw new Exception("Invalid WIF", 1); }

        $private_key_details = BitcoinLib::WIF_to_private_key($wif);
        $private_key = $private_key_details['key'];

        return self::publicKeyFromPrivateKey($private_key, $verify_address);
    }

    public static function publicKeyFromPrivateKey($private_key, $verify_address=null) {
        $address_version = '00';

        // convert long-form private key
        if (substr($private_key, 0, 4) == 'xprv') {
            $key_details = BIP32::import($private_key);
            $private_key = $key_details['key'];
        }

        $compressed_public_key = BitcoinLib::private_key_to_public_key($private_key, true);

        if ($verify_address !== null) {
            $address = BitcoinLib::public_key_to_address($compressed_public_key, $address_version);
            if ($verify_address !== $address) { throw new Exception("Address verification failed.  Found address $address.  Expected address $verify_address", 1); }
        }

        return $compressed_public_key;
    }

    public static function WIFFromPrivateKey($private_key) {
        $key_details = BIP32::import($private_key);
        $wif = BitcoinLib::private_key_to_WIF($key_details['key'], true, $key_details['version']);
        if (!BitcoinLib::validate_WIF($wif)) { throw new Exception("Failed to validate WIF", 1); }
        return $wif;
    }


    public static function addressFromWIF($wif) {
        $is_valid = BitcoinLib::validate_WIF($wif);
        if (!$is_valid) { throw new Exception("Invalid WIF", 1); }

        $private_key_details = BitcoinLib::WIF_to_private_key($wif);
        $private_key = $private_key_details['key'];

        $address_version = '00';
        $compressed_public_key = BitcoinLib::private_key_to_public_key($private_key, true);
        return BitcoinLib::public_key_to_address($compressed_public_key, $address_version);
    }

    ////////////////////////////////////////////////////////////////////////

}

