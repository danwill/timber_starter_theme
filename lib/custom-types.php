<?php

/*
 *
 * Custom Post Types
 *
 * Notes:
 * * Use https://generatewp.com/post-type/ to generate custom post type properties
 * * Can remove standard post for a title by removing 'title' from ``supports`` argument array
 * ** If removing title and post is referenced elsewhere (e.g. Page Link), 
 *
 * 
 */

/*
$postTypeLabels = [

];

$postTypeArgs = [

];

register_post_type( 'postType', $postTypeArgs );

*/



/**
 * Example showing how to modify the listing view for a custom post type
 *
 * Replace project with project namespace (optional) and postname with name of custom post type (required)
 *
 * @link https://codex.wordpress.org/Plugin_API/Action_Reference/manage_$post_type_posts_custom_column
 */

/*
function project_postname_columns($columns) {
    $columns = array(
        'cb'        => '<input type="checkbox" />',
        'title'      => 'Name',
        'logo'     => 'Logo',
        'date'      => 'Date',
    );
    return $columns;
}

function project_postname_custom_columns($column)
{
    global $post;
    if($column == 'logo') {
        echo wp_get_attachment_image( get_field('logo', $post->ID), array(320,125) );
    }
}

add_action("manage_postname_posts_custom_column", "project_postname_custom_columns");
add_filter("manage_postname_posts_columns", "project_postname_columns");
*/