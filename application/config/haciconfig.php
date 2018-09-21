<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// $classname = 'MY_Hacicore';
spl_autoload_register(function ($classname)
{
    if(strpos($classname,'CI_') == 0)
    {
        if (is_readable(APPPATH . 'core/' . $classname . '.php'))
        {
         require_once(APPPATH . 'core/' . $classname . '.php');
        }
    }
});
// function __autoload($classname)
// {
//     if(strpos($classname,'CI_') == 0)
//     {
//         $file = APPPATH.'core/'.$classname.'.php';
//         if(file_exists($file))
//         {
//             @include_once($file);
//         }
//     }
// }

/*
|--------------------------------------------------------------------------
| Set Modules Location
|--------------------------------------------------------------------------
|
*/
$config['modules_locations'] = array(
    APPPATH.'modules/' => '../modules/',
);

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

$config['hcconfig']['assets'] = 'assets';
$config['hcconfig']['assets_admin'] = $config['hcconfig']['assets'] . '/admin';
$config['hcconfig']['assets_site'] = $config['hcconfig']['assets'] . '/site';