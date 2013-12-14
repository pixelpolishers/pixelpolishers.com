<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace Api\Controller;

use \Hybrid_Auth;
use Zend\Mvc\Controller\AbstractActionController;

class AuthController extends AbstractActionController
{
    public function indexAction()
    {
        $config = $this->getServiceLocator()->get('Config');

        try {
            $hybridauth = new Hybrid_Auth($config['api_auth']);

            $result = $hybridauth->authenticate('LinkedIn');

            var_dump($result);
            exit;
        } catch (Exception $e) {
            switch ($e->getCode()) {
                case 0 : echo "Unspecified error.";
                    break;
                case 1 : echo "Hybridauth configuration error.";
                    break;
                case 2 : echo "Provider not properly configured.";
                    break;
                case 3 : echo "Unknown or disabled provider.";
                    break;
                case 4 : echo "Missing provider application credentials.";
                    break;
                case 5 : echo "Authentication failed. "
                    . "The user has canceled the authentication or the provider refused the connection.";
                    break;
                case 6 : echo "User profile request failed. Most likely the user is not connected "
                    . "to the provider and he should to authenticate again.";
                    $twitter->logout();
                    break;
                case 7 : echo "User not connected to the provider.";
                    $twitter->logout();
                    break;
                case 8 : echo "Provider does not support this feature.";
                    break;
            }

            // well, basically your should not display this to the end user, just give him a hint and move on..
            echo "<br /><br /><b>Original error message:</b> " . $e->getMessage();

            echo "<hr /><h3>Trace</h3> <pre>" . $e->getTraceAsString() . "</pre>";
        }
    }
}
