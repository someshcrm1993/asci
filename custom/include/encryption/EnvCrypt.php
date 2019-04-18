<?php


//   Created at : 27th Nov 2017 
//   Author     : Akash D.
//   Description: DB_COnfig_encryption
//   Organization : Simpleworks Business pvt. Ltd.
   


//use SuiteCRM\custom\blowfish\Blowfish;

class EnvCrypt
{

    // Function for Encryption the pwd

    public static function encrypt($data,$key)
    {
        $key_size =  strlen($key);  

            // create a random IV to use with CBC encoding
            $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);
            $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);

            // creates a cipher text compatible with AES (Rijndael block size = 128)
            // to keep the text confidential 
            // only suitable for encoded input that never ends with value 00h
            // (because of default zero padding)
            $ciphertext = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key,$data, MCRYPT_MODE_CBC, $iv);

            // prepend the IV for it to be available for decryption
            $ciphertext = $iv . $ciphertext;

            // encode the resulting cipher text so it can be represented by a string
            $ciphertext_base64 = base64_encode($ciphertext);            

            return $ciphertext_base64;  
    }

// Function for Decryption the pwd

    public static function decrypt($data,$key)
    {

        $ciphertext_dec = base64_decode($data);
        $iv_size = mcrypt_get_iv_size(MCRYPT_RIJNDAEL_128, MCRYPT_MODE_CBC);

        // retrieves the IV, iv_size should be created using mcrypt_get_iv_size()
        $iv_dec = substr($ciphertext_dec, 0, $iv_size);
        
        // retrieves the cipher text (everything except the $iv_size in the front)
        $ciphertext_dec = substr($ciphertext_dec, $iv_size);

        // may remove 00h valued characters from end of plain text
        $plaintext_dec = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key,$ciphertext_dec, MCRYPT_MODE_CBC, $iv_dec);

        return trim($plaintext_dec);
    }
}
