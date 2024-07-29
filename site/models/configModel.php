<?php

//Lấy config
function load_config()
{
    $sql = "SELECT * FROM db_config WHERE id=1";
    return pdo_query_one($sql);
}


//Lấy ra menu
//Menu ở header
function load_menu($position, $limit = null)
{
    if ($limit) {
        $sql = "SELECT * FROM db_menu WHERE position=? AND parent_id=0 AND status =1 LIMIT $limit";
        return pdo_query_all($sql, $position);
    } else {
        $sql = "SELECT * FROM db_menu WHERE position=? AND parent_id=0 AND status =1";
        return pdo_query_all($sql, $position);
    }
}

//mega menu
function menu_list_parentid($parentid, $position = 'megamenu')
{
    if ($position == 'megamenu') {
        $sql = "SELECT * FROM db_menu WHERE parent_id=? AND status=1 AND position=? ORDER BY orders";
        return pdo_query_all($sql, $parentid, $position);
    } else if ($position == 'footermenu') {
        $sql = "SELECT * FROM db_menu WHERE parent_id=? AND status=1 AND position=? ORDER BY orders";
        return pdo_query_all($sql, $parentid, $position);
    }
}

//footer menu