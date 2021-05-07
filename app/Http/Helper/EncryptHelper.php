<?php
  
  function encryptValue($value){
    $cipher = @mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
    $key256 = env('CRYPTO_KEY', '');
    $iv = env('CRYPTO_IV', '');
    
    @mcrypt_generic_init($cipher, $key256, $iv);
    $cipherText256 = @mcrypt_generic($cipher, $value);
    @mcrypt_generic_deinit($cipher);
    $encrypted = bin2hex($cipherText256);
    return $encrypted;
  }
 
  function decryptValue($value){
    $cipher = @mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', MCRYPT_MODE_CBC, '');
    $key256 = env('CRYPTO_KEY', '');
    $iv = env('CRYPTO_IV','');

    $limbo = hex2bin($value);
    @mcrypt_generic_init($cipher, $key256, $iv);
    $decrypted = @mdecrypt_generic($cipher, $limbo);
    return trim($decrypted);
  }
 
  