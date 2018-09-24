<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Admin & Site Theme
|--------------------------------------------------------------------------
|
| Can be overriden for admin theme with 
| $this->template->_set_admin_theme('foo');
| 
| Or
|
| Can be overriden for admin theme with 
| $this->template->_set_site_theme('foo');
|
|   Default Admin: 'adminlte'
|   Default Site : 'madedesign'
|
*/
$config['myconfig']['admin_theme'] = 'adminlte'; // static, will be store database for dynamic
$config['myconfig']['site_theme'] = 'madedesign'; // static, will be store database for dynamic

// $config['myconfig']['title_admin_name'] = 'Haci App'; // static, will be store database for dynamic
// $config['myconfig']['title_site_name'] = 'Haci App'; // static, will be store database for dynamic

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

$config['myconfig']['default_site'] = 'admin';
$config['myconfig']['assets_path'] = array('asset_admin'=>'assets/admin', 'asset_site'=>'assets/site');
$config['myconfig']['layout_path'] = array('layout_admin'=> APPPATH .'view/admin/','layout_site'=> APPPATH.'view/site/');
