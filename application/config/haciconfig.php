<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Admin & Site Theme
|--------------------------------------------------------------------------
|
| Can be overriden for admin theme with 
| $this->template->set_admin_theme('foo');
| 
| Or
|
| Can be overriden for admin theme with 
| $this->template->set_site_theme('foo');
|
|   Default Admin: 'adminlte'
|   Default Site : ''
|
*/
$config['hcconfig']['admin_theme'] = 'adminlte';
$config['hcconfig']['site_theme'] = 'ada';

$config['hcconfig']['title_admin_name'] = 'Haci App';
$config['hcconfig']['title_site_name'] = 'Haci App';

/*
|--------------------------------------------------------------------------
| Default Index
|--------------------------------------------------------------------------
|
| It will be redirect to admin or site when access domain.com
| admin for access admin OR
| site for access frontpage
|   Default  : admin
|
*/

$config['hcconfig']['default_site'] = 'admin';