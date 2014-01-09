<?php
/**
 * User: diegofonseca
 * Date: 09/01/14
 * Time: 13:37
 */
$configuration = array(
    'db' => array(
        'dbname' => 'db_name',
        'user' => 'root',
        'password' => 'password',
        'host' => '127.0.0.1',
        'driver' => 'pdo_mysql'
    ),
    'annotation' => true,
    'getter_setter' => false,
    'entities'  =>  array('name' => 'Entities', 'path'  => __DIR__."/data/Entities"),
    'proxies'   =>  array('name' => 'Proxies',  'path'  => __DIR__."/data/Proxies"),
    'message' => '<strong>Entities generated with successful.</strong>',
    'display_error' => "On"
);
