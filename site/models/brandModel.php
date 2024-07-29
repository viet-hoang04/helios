<?php
function brand_list()
{
    $sql = "SELECT * FROM db_brand WHERE status=1 ORDER BY orders ASC";
    return pdo_query_all($sql);
}
