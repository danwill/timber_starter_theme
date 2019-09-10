<?php

namespace Mechanic\Config;

class PostSettings
{

    public static function register()
    {
        add_filter('post_type_labels_post', [get_called_class(), 'configurePostLabels']);
        add_filter('manage_post_posts_columns', [get_called_class(), 'configureColumns']);
    }

    public static function configurePostLabels($labels)
    {
        # Labels
        $labels->name = 'Articles';
        $labels->singular_name = 'Article';
        $labels->add_new = 'Add Article';
        $labels->add_new_item = 'Add Article';
        $labels->edit_item = 'Edit Article';
        $labels->new_item = 'New Article';
        $labels->view_item = 'View Article';
        $labels->view_items = 'View Articles';
        $labels->search_items = 'Search Articles';
        $labels->not_found = 'No articles found.';
        $labels->not_found_in_trash = 'No articles found in Trash.';
        $labels->parent_item_colon = 'Parent articles'; // Not for "post"
        $labels->archives = 'Articles Archives';
        $labels->attributes = 'Articles Attributes';
        $labels->insert_into_item = 'Insert into articles';
        $labels->uploaded_to_this_item = 'Uploaded to this articles';
        $labels->featured_image = 'Hero Image';
        $labels->set_featured_image = 'Set hero image';
        $labels->remove_featured_image = 'Remove hero image';
        $labels->use_featured_image = 'Use as hero image';
        $labels->filter_items_list = 'Filter article list';
        $labels->items_list_navigation = 'Articles list navigation';
        $labels->items_list = 'Articles list';

        # Menu
        $labels->menu_name = 'Articles';
        $labels->all_items = 'All Articles';
        $labels->name_admin_bar = 'Articles';

        return $labels;
    }

    // Edit columns for post listing page
    // @see https://www.smashingmagazine.com/2017/12/customizing-admin-columns-wordpress/
    public static function configureColumns($columns)
    {
        $columns = [
            'cb' => $columns['cb'],
            'title' => $columns['title'],
            'categories' => $columns['categories'],
            'tags' => $columns['tags'],
            'date' => $columns['date'],
        ];
        return $columns;
    }
}
