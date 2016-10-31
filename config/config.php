<?php

Config::set('site_name', 'BlaBla - Blog');
Config::set('languages', array('en', 'ru'));


Config::set('routes', array(
    'default' => '',
    'admin' => 'admin_',
));

Config::set('default_route', 'default');
Config::set('default_language', 'ru');
Config::set('default_controller', 'pages');
Config::set('default_action', 'index');

Config::set('db.host', 'localhost');
Config::set('db.user', 'mysql');
Config::set('db.password', 'mysql');
Config::set('db.db_name', '3blog');

Config::set('salt', 'kf895hskty9572flghn');
/**
 * Created by PhpStorm.
 * User: Alexander
 * Date: 07.12.2015
 * Time: 22:05
 */ 