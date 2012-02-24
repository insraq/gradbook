<?php

    function nav($active = -1)
    {
        $item = array(
            '首页' => '',
            '修改资料' => 'user/profile',
            '08 OCamp' => 'home/ocamp',
            '歌词帖' => 'widget/lyrics',
            '登出' => 'user/logout'
        );

        $nav = '<ul class="nav nav-tabs">';

        $i = 0;
        foreach ($item as $k => $v)
        {
            
            $nav .= ($i == $active) ? '<li class="active">' : '<li>';
            $nav .= '<a href="' . site_url($v) . '">' . $k . '</a></li>';
            $i++;
        }

        $nav .= '</ul>';

        return $nav;
    }