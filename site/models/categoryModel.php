<?php
function category_list($parent_id)
{
    $sql = "SELECT * FROM db_category WHERE parent_id=? AND status=1 ORDER BY orders ASC";
    return pdo_query_all($sql, $parent_id);
}
function category_rowslug($slug)
{
    $sql = "SELECT * FROM db_category WHERE slug=?";
    return pdo_query_one($sql, $slug);
}
function category_listcatid($parent_id)
{
    $arr = array();
    $arr[] = $parent_id;
    $list1 = category_list($parent_id);
    if (count($list1)) {
        foreach ($list1 as $r1) {
            $arr[] = $r1['id'];
            $list2 = category_list($r1['id']);
            if (count($list2)) {
                foreach ($list2 as $r2) {
                    $arr[] = $r2['id'];
                    $list3 = category_list($r2['id']);
                    if (count($list3)) {
                        foreach ($list3 as $r3) {
                            $arr[] = $r3['id'];
                        }
                    }
                }
            }
        }
    }
    return $arr;
}
