<?php
/**
 * SmartCall Restful API (v3) HTTP Client.
 *
 * @author    Jacques Marneweck <jacques@siberia.co.za>
 * @copyright 2017 Jacques Marneweck.  All rights strictly reserved.
 * @license   MIT
 */
require_once __DIR__.'/../vendor/autoload.php';

\VCR\VCR::configure()
    ->enableRequestMatchers(['method', 'url', 'host'])
    ->setStorage('json');
\VCR\VCR::turnOn();
