<?php

namespace Tokenly\BitcoinAddressLib;

use BitWasp\Bitcoin\Key\Deterministic\HierarchicalKeyFactory;
use BitWasp\Buffertools\Buffer;
use Exception;

/*
* BitcoinAddressGenerator
*/
class BitcoinAddressGenerator
{

    protected $master_key = null;

    ////////////////////////////////////////////////////////////////////////

    public function __construct($platform_master_seed) {
        if (!strlen($platform_master_seed)) { throw new Exception("No platform master seed provided", 1); }
        $this->platform_master_seed = $platform_master_seed;
    }

    public function publicAddress($token, $identifier=0) {
        $master_key = $this->newMasterKey($this->deriveMasterSeed($token));
        $child_extended_key = $master_key->deriveChild($identifier);
        return $child_extended_key->getPublicKey()->getAddress()->getAddress();
    }

    public function privateKey($token, $identifier=0) {
        $master_key = $this->newMasterKey($this->deriveMasterSeed($token));
        $child_extended_key = $master_key->deriveChild($identifier);
        return $child_extended_key->getPrivateKey();
    }

    public function WIFPrivateKey($token, $identifier=0) {
        return $this->privateKey($token, $identifier)->toWif();
    }

    public function newMasterKey($seed_hex_string) {
        return HierarchicalKeyFactory::fromEntropy(new Buffer(hex2bin($seed_hex_string)));
    }

    ////////////////////////////////////////////////////////////////////////

    protected function deriveMasterSeed($token) {
        return hash('sha512', $token.$this->platform_master_seed);
    }
}

