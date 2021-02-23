<?php
function get_sidebar_title($title)
{
    if (empty($title)) {
        return $title;
    }
    $words = preg_split('/\s+/', $title);
    $count = count($words);

    $out = '<div class="sidebar-title-box">';
    if ($count === 2) {
        $out .= '<p class="sidebar-wrapper-inner-subtitle">' . $words[0] . '</p>';
        $out .= '<p class="sidebar-wrapper-inner-title">' . $words[1] . '</p>';
    } else {
        $out .= '<p class="sidebar-wrapper-inner-subtitle">' . $title . '</p>';
    }
    $out .= '</div>';

    return $out;
}

function get_mobile_insights_title($title)
{
    if (empty($title)) {
        return $title;
    }
    $words = preg_split('/\s+/', $title);
    $count = count($words);

    $out = '<div class="title-mobile-box">';
    if ($count === 2) {
        $out .= '<p class="title-mobile-box--main-subtitle">' . $words[0] . '</p>';
        $out .= '<p class="title-mobile-box--main-title">' . $words[1] . '</p>';
    } else {
        $out .= '<p class="title-mobile-box--main-subtitle">' . $title . '</p>';
    }
    $out .= '</div>';

    return $out;
}
