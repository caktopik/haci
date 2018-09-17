<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Adminlte Library Class
 * 
 * @package         CodeIgniter
 * @subpackage      Libraries
 * @author			Taufik Arief Widodo
 */

class Adminlte
{
    private $_layout = array();
    private $_layout['adminlte'] = array();
    private $_layout['adminlte']['skin'] = 'skin-blue'; // Choose the skin file that you want and then add the appropriate class to the body tag to change the template's appearance.
    private $_layout['adminlte']['bg-control-sidebar'] = 'control-sidebar-dark'; // choose background for control sidebar
    private $_layout['adminlte']['fixed'] = ''; // use the class .fixed to get a fixed header and sidebar
    private $_layout['adminlte']['collapsed_sidebar'] = ''; // use the class .sidebar-collapse to have a collapsed sidebar upon loading
    private $_layout['adminlte']['boxed_layout'] = ''; // use the class .layout-boxed to get boxed layout that strecthes only to 1250px
    private $_layout['adminlte']['top_navigation'] = ''; // use the class .layout-top-nav to remove the sidebar and have your links at the top navbar
    
    public function _button($class = NULL, $title = 'Button Name', $style = NULL)
    {
        if(empty($class) && empty($style))
        {
            echo '<button class="btn btn-default" data-toggle="control-sidebar">'. $title .'</button>';
        }
        elseif(empty($class))
        {
            echo '<button class="btn btn-default" style="'. $style .'" data-toggle="control-sidebar">'. $title .'</button>';
        }
        else
        {
            echo '<button class="btn '. $class .'" data-toggle="control-sidebar">'. $title .'</button>';
        }
    }

    public function _info_box($infobox = array())
    {
        // $infobox = array();
        $infobox['ib_style'] = '';
        $infobox['ib_class'] = 'info-box';
        $infobox['ib_icon'] = 'info-box-icon';
        $infobox['ib_content'] = array('info-box-text'=>'','info-box-number'=>'');
        $infobox['ib_progress'] = array('show'=> FALSE, 'width'=> 0, 'description'=> '');

    }
}