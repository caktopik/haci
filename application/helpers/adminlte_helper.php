<?php defined('BASEPATH') OR exit('No direct script access allowed');

    function _button($class = NULL, $title = 'Button Name', $style = NULL)
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

    function _info_box($parameter = array())
    {
        // $parameter['ib_class'] = $parameter['ib_class'];
        // $parameter['ib_icon'] = $parameter['ib_icon'];
        // $parameter['ib_content'] = array('info_box_text'=>'','info_box_number'=>'');
        // $parameter['ib_progress'] = array('show'=> FALSE, 'width'=> 0, 'description'=> '');
        // $parameter['ib_background'] = array('location'=>'half','color'=>'bg-aqua');
        if ($parameter['ib_background']['location'] == 'half')
        {
            $infobox_html = '<div class="info-box '.$parameter['ib_class'].'">';
            $infobox_html .= '<span class="info-box-icon '.$parameter['ib_background']['color'].'"><i class="fa '.$parameter['ib_icon'].'"></i></span>';
            $infobox_html .= '<div class="info-box-content">';
            $infobox_html .= '<span class="info-box-text">'.$parameter['ib_content']['info_box_text'].'</span>';
            $infobox_html .= '<span class="info-box-number">'.$parameter['ib_content']['info_box_number'].'</span>';
            $infobox_html .= '</div><!-- /.info-box-content -->';
            $infobox_html .= '</div><!-- /.info-box -->';
        }
        elseif ($parameter['ib_background']['location'] == 'full')
        {
            $infobox_html = '<div class="info-box '.$parameter['ib_class'].' '.$parameter['ib_background']['color'].'">';
            $infobox_html .= '<span class="info-box-icon"><i class="fa fa-comments-o"></i></span>';
            $infobox_html .= '<div class="info-box-content">';
            $infobox_html .= '<span class="info-box-text">'.$parameter['ib_content']['info_box_text'].'</span>';
            $infobox_html .= '<span class="info-box-number">'.$parameter['ib_content']['info_box_number'].'</span>';
            if($infobox['ib_progress']['show'])
            {
                $infobox_html .= '<!-- The progress section is optional -->';
                $infobox_html .= '<div class="progress">';
                $infobox_html .= '<div class="progress-bar" style="width: '.$parameter['ib_progress']['width'].'%"></div>';
                $infobox_html .= '</div>';
                $infobox_html .= '<span class="progress-description">';
                $infobox_html .= $parameter['ib_progress']['description'];
                $infobox_html .= '</span>';
            }
            $infobox_html .= '</div><!-- /.info-box-content -->';
            $infobox_html .= '</div><!-- /.info-box -->';
        }
        else
        {
            $infobox_html = 'Something Wrong!';
        }
        return $infobox_html;
    }

    function _small_box($parameter = array())
    {
        // $parameter['sb_background'] = 'bg-aqua';
        // $parameter['sb_icon'] = 'fa-shopping-cart';
        // $parameter['sb_number'] = '150';
        // $parameter['sb_text'] = 'New Orders';
        // $parameter['sb_number'] = '150';
        // $parameter['sb_link'] = '#';
        // $parameter['sb_more'] = 'More info';
        $smallbox_html = '<div class="small-box bg-aqua">';
        $smallbox_html .= '<div class="inner">';
        $smallbox_html .= '<h3>'.$parameter['sb_number'].'</h3>';
        $smallbox_html .= '<p>'.$parameter['sb_text'].'</p>';
        $smallbox_html .= '</div>';
        $smallbox_html .= '<div class="icon"><i class="fa '.$parameter['sb_icon'].'"></i></div>';
        $smallbox_html .= '<a href="'.$parameter['sb_link'].'" class="small-box-footer">'.$parameter['sb_more'].'<i class="fa fa-arrow-circle-right"></i></a>';
        $smallbox_html .= '</div>';

        return $smallbox_html;
    }