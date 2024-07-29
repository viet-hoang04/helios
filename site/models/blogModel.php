<?php
function post_list_home()
{
    $sql = "SELECT * FROM db_post WHERE type='post' AND status =1 ORDER BY id DESC LIMIT 3";
    return pdo_query_all($sql);
}

function post_site_all($first, $limit)
{
    $sql = "SELECT *
                FROM db_post 
                WHERE type = 'post' AND status = 1
                ORDER BY id DESC LIMIT $first, $limit";
    return pdo_query_all($sql);
}
function count_all_posts()
{
    $sql = "SELECT COUNT(*) as total FROM db_post WHERE type = 'post' AND status = 1";
    $result = pdo_query_one($sql);
    return $result['total'];
}

function post_rowslug($slug)
{
    $sql = "SELECT * FROM db_post WHERE slug=?";
    return pdo_query_one($sql, $slug);
}
function post_insert_comment($post_id, $user_id, $fullname, $email, $detail, $created_at)
{
    $sql = "INSERT INTO db_post_comment (post_id,user_id,fullname,email,detail,created_at) VALUES (?,?,?,?,?,?)";
    return pdo_execute($sql, $post_id, $user_id, $fullname, $email, $detail, $created_at);
}
function post_list_comment($post_id)
{
    $sql = "SELECT * FROM db_post_comment WHERE post_id=? ORDER BY id DESC LIMIT 5";
    return pdo_query_all($sql, $post_id);
}
function post_topic_all($topic_slug, $first, $limit)
{
    $sql = "SELECT p.*
        FROM db_post p
        JOIN db_topic t ON p.topic_id = t.id
        WHERE t.slug = ? AND p.type = 'post' AND p.status = 1
        ORDER BY p.id DESC LIMIT $first, $limit";

    return pdo_query_all($sql, $topic_slug);
}

function count_posts_by_category($topic_slug)
{
    $sql = "SELECT COUNT(*) as total
        FROM db_post p
        JOIN db_topic t ON p.topic_id = t.id
        WHERE t.slug = ? AND p.type = 'post' AND p.status = 1";

    $result = pdo_query_one($sql, $topic_slug);
    return $result['total'];
}


function topic_all()
{
    $sql = "SELECT * FROM db_topic WHERE status=1 AND id!=1";
    return pdo_query_all($sql);
}
function topic_by_id($topic_id)
{
    $sql = "SELECT * FROM db_topic WHERE id=?";
    return pdo_query_one($sql, $topic_id);
}
function topic_rowslug($slug)
{
    $sql = "SELECT * FROM db_topic WHERE slug=?";
    return pdo_query_one($sql, $slug);
}
