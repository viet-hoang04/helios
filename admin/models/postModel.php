<?php
function post_all($page = 'index')
{
    if ($page == 'index') {
        $sql = "SELECT db_post.*, db_topic.name as nametopic FROM db_post 
            JOIN db_topic 
            ON db_post.topic_id = db_topic.id 
            WHERE db_post.status !=0 AND db_post.type='post' 
            ORDER BY db_post.id DESC";
    } else {
        $sql = "SELECT db_post.*, db_topic.name as nametopic FROM db_post 
            JOIN db_topic 
            ON db_post.topic_id = db_topic.id 
            WHERE db_post.status =0 AND db_post.type='post' 
            ORDER BY db_post.id DESC";
    }
    return pdo_query_all($sql);
}
function post_rowid($id)
{
    $sql = "SELECT * FROM db_post WHERE id=?";
    return pdo_query_one($sql, $id);
}
function post_slug_exists($slug, $id = null)
{
    if ($id == null) {
        $sql = "SELECT * FROM db_post WHERE slug=?";
        return pdo_query_one($sql, $slug);
    } else {
        $sql = "SELECT * FROM db_post WHERE slug=? AND id=!?";
        return pdo_query_one($sql, $slug, $id);
    }
}
function post_insert($topic_id, $title, $slug, $detail, $img, $type, $status)
{
    $sql = "INSERT INTO db_post (topic_id,title,slug,detail,img,type,status) VALUES (?,?,?,?,?,?,?)";
    return pdo_execute($sql, $topic_id, $title, $slug, $detail, $img, $type, $status);
}
function post_update($topic_id, $title, $slug, $detail, $img, $type, $status, $id)
{
    $sql = "UPDATE db_post SET topic_id=?,title=?,slug=?,detail=?,img=?,type=?,status=? WHERE id=?";
    return pdo_execute($sql, $topic_id, $title, $slug, $detail, $img, $type, $status, $id);
}
function post_update_status($status, $id)
{
    $sql = "UPDATE db_post SET status=? WHERE id=?";
    return pdo_execute($sql, $status, $id);
}
function post_delete($id)
{
    $sql = "DELETE FROM db_post WHERE id=?";
    return pdo_execute($sql, $id);
}
