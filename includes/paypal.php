<?php 

//url aquispe
define('URL_SITIO', 'https://jersk.ts/conferencias');

require 'paypal/autoload.php';

$apiContext = new \PayPal\Rest\ApiContext(
    new \PayPal\Auth\OAuthTokenCredential(
        'AZIooTX53wBZtyw6vPbx2-vME_lULqJViYPczH4iCt2cbJ60mEqefVvd53mym9X8Vwqn-AEYZPimTsrU',     // ClientID
        'EJfoHgRPskzpt8GZbNYWEVdqnU0rn2Lu6JiFrAZb2zGFAkCUeBMVOzVnl4igbUBchcmF2818zwPqxviI'      // ClientSecret
    )
);

