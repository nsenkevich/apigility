<?php

/**
 * This is the config file for ZfrCors. Just drop this file into your config/autoload folder (don't
 * forget to remove the .dist extension from the file), and configure it as you want
 */

return array(
    'zfr_cors' => array(
         /**
          * Set the list of allowed origins domain with protocol.
          */
          'allowed_origins' => array('http://www.php-snips.com', 'http://php-snips.com'),

         /**
          * Set the list of HTTP verbs.
          */
          'allowed_methods' => array('GET', 'POST', 'PUT', 'DELETE', 'OPTIONS'),

         /**
          * Set the list of headers. This is returned in the preflight request to indicate
          * which HTTP headers can be used when making the actual request
          */
          'allowed_headers' => array(
              'X-Origin', 'Access-Control-Allow-Origin',
              'X-Access-Token', 'Origin', 'X-Requested-With', 
              'Content-Type', 'Accept', 'Cache-Control', 'Authorization'
              ),

         /**
          * Set the max age of the preflight request in seconds. A non-zero max age means
          * that the preflight will be cached during this amount of time
          */
          'max_age' => 360,

         /**
          * Set the list of exposed headers. This is a whitelist that authorize the browser
          * to access to some headers using the getResponseHeader() JavaScript method. Please
          * note that this feature is buggy and some browsers do not implement it correctly
          */
         // 'exposed_headers' => array(),

         /**
          * Standard CORS requests do not send or set any cookies by default. For this to work,
          * the client must set the XMLHttpRequest's "withCredentials" property to "true". For
          * this to work, you must set this option to true so that the server can serve
          * the proper response header.
          */
          'allowed_credentials' => true,
    ),
);
