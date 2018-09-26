<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Admin & public Theme
|--------------------------------------------------------------------------
|
| Can be overriden for admin theme with 
| $this->template->_set_admin_theme('foo');
| 
| Or
|
| Can be overriden for admin theme with 
| $this->template->_set_public_theme('foo');
|
|   Default Admin: 'adminlte'
|   Default public : 'madedesign'
|
*/
$config['myconfig']['admin_theme'] = 'adminlte'; // static, will be store database for dynamic
$config['myconfig']['public_theme'] = 'madedesign'; // static, will be store database for dynamic

// $config['myconfig']['title_admin_name'] = 'Haci App'; // static, will be store database for dynamic
// $config['myconfig']['title_public_name'] = 'Haci App'; // static, will be store database for dynamic

/*
|--------------------------------------------------------------------------
| Default Index
|--------------------------------------------------------------------------
|
| It will be redirect to admin or public when access domain.com
| admin for access admin OR
| public for access frontpage
|   Default  : admin
|
*/

$config['myconfig']['default_site'] = 'admin';
$config['myconfig']['assets_folder'] = 'assets';
$config['myconfig']['assets_path'] = array('asset_admin'=>$config['myconfig']['assets_folder'].'/admin', 'asset_public'=>$config['myconfig']['assets_folder'].'/public');
$config['myconfig']['layout_path'] = array('layout_admin'=> APPPATH .'view/admin/','layout_public'=> APPPATH.'view/public/');
