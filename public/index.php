<?php

/**
 * Dhiraagu Bulk SMS Gateway PHP SDK Demo
 *
 * @package  Laravel
 * @author   Arushad Ahmed <arushad@javaabu.com>
 */

/*
|--------------------------------------------------------------------------
| Register The Auto Loader
|--------------------------------------------------------------------------
|
| Composer provides a convenient, automatically generated class loader for
| our application. We just need to utilize it! We'll simply require it
| into the script here so that we don't have to worry about manual
| loading any of our classes later on. It feels great to relax.
|
*/

require __DIR__.'/../vendor/autoload.php';

/*
|--------------------------------------------------------------------------
| Get the app instance
|--------------------------------------------------------------------------
|
| We need our app instance
|
*/

$app = new \Dash8x\DhiraaguSmsDemo\App($_POST);


/*
|--------------------------------------------------------------------------
| Load the view
|--------------------------------------------------------------------------
|
| Render the demo form
|
*/

require __DIR__.'/../src/views/form.php';

