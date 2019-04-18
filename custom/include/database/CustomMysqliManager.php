<?php

//   Created at : 27th Nov 2017 
//   Author     : Akash D.
//   Description: DB_COnfig_encryption
//   Organization : Simpleworks Business pvt. Ltd.
   


// change sugar configuration to 'db_manager' => 'CustomMysqliManager'
//use SuiteCRM\custom\blowfish\Blowfish;

require_once 'include/database/MysqliManager.php';
require_once 'custom/include/encryption/EnvCrypt.php';
require_once 'custom/blowfish/Blowfish.php';

class CustomMysqliManager extends MysqliManager {

    public function connect(array $configOptions = null, $dieOnError = false)
    {
        global $sugar_config;

        $key = Blowfish::getKey();

        if (is_null($configOptions)) {
            $configOptions = $sugar_config['dbconfig'];
        }


        if($configOptions['use_encryption']){

            $configOptions['db_password'] = EnvCrypt::decrypt($configOptions['db_password'],$key); 
            //$encodedPassword = EnvCrypt::decrypt($configOptions['db_password']);

        } else {

            $encodedPassword = EnvCrypt::encrypt($configOptions['db_password'],$key);
            //$configOptions['db_password'] = EnvCrypt::encrypt($configOptions['db_password'],$key);

            echo "Please check simplecrm log for the encrypted password"; 

            $GLOBALS['log']->security("
                    ********** IMPORTANT ENCRYPTION INSTRUCTIONS - START **********

                    Your database password is currently NOT encrypted. Please follow the two steps below to set up the encrypted password:

                    STEP 1: Change value of variable \$sugar_config['dbconfig']['db_password'] = '".$encodedPassword."'; on config.php
                    STEP 2: Append \$sugar_config['dbconfig']['use_encryption'] = true; to file config_override.php

                    ********** IMPORTANT ENCRYPTION INSTRUCTIONS - END **********");
            exit;        
        }


        return parent::connect($configOptions, $dieOnError);
    }

}
