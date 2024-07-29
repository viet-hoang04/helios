<?php
function slider_all($page)
{

    $sql = "SELECT * FROM db_slider WHERE position=? AND status=1";
    return pdo_query_all($sql, $page);
}
function banner_all($page)
{
    $sql = "SELECT * FROM db_banner WHERE position=? AND status=1 ORDER BY orders";
    return pdo_query_all($sql, $page);
}
