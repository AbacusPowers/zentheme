<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 11/12/15
 * Time: 12:27 AM
 */
// adding the function to the Wordpress init
add_action( 'init', 'zentheme_register_post_types');
function zentheme_register_post_types()
{
    //projects (portfolio items)
    register_post_type('project',
        // If you get stuck, need some more detail, or are looking to go deeper, read the documentation here: https://codex.wordpress.org/Function_Reference/register_post_type */
        array(
            'labels' => array(
                'name' => __('Projects', 'zenerator'), /* The group title. It shows in the main dashboard menu, alongside "Posts", "Media", "Pages", etc. */
                'singular_name' => __('Project', 'zenerator'), /* The individual label. Usually the singular form. Displayed in the admin bar, under "+ New" */
                'all_items' => __('All Projects', 'zenerator'), /* The 'all items' label. Displayed under the group name in the dashboard. */
                'add_new' => __('Add New', 'zenerator'), /* The 'add new' menu item. Displayed under the 'all items' label and at the top of the page in the 'all items' view. */
                'add_new_item' => __('Add New Project', 'zenerator'), /*  */
                'edit_item' => __('Edit project', 'zenerator'), /* The header of the page when editing a post. */
                'new_item' => __('New project', 'zenerator'), /* The header of the 'Add new' page. Displays when adding a new post. */
                'view_item' => __('View project', 'zenerator'), /* View display title */
                'search_items' => __('Search Projects', 'zenerator'), /* Search label for dashboard pages */
                'not_found' => __('Nothing found in the Database.', 'zenerator'), /* This displays if there are no entries yet */
                'not_found_in_trash' => __('Nothing found in Trash', 'zenerator'), /* This displays if there is nothing in the trash */
                'parent_item_colon' => 'Parent Projects:' /* Parent label for hierarchical post types */
            ), /* end of arrays */
            'description' => __('Projects for the portfolio', 'zenerator'), /* A description of your post type */
            'public' => true, /* If set to 'false', this will hide this post type from the public */
            'publicly_queryable' => true, /* Sets whether the post type can be queried. Automatically false, if 'public' is false. */
            'exclude_from_search' => false, /* Want to hide this post type from searches on your site? */
            'show_ui' => true, /* If set to 'false', the dashboard UI won't be created. All management (creating/editing/deleting) would need to be done through code. */
            'menu_position' => 5, /* This controls the order in the dashboard menu. 5 - below Posts, 10 - below Media, 15 - below Links, 20 - below Pages, 25 - below comments, 60 - below first separator, 65 - below Plugins, 70 - below Users, 75 - below Tools, 80 - below Settings, 100 - below second separator */
            'menu_icon' => 'dashicons-format-video', /* Which icon should we use? Checkout your options here: https://developer.wordpress.org/resource/dashicons/#editor-code */
            'rewrite' => array('slug' => 'project'), /* Will automatically inherit the post type label unless specified. */
            'has_archive' => 'projects', /* If 'false', no archive will exist. If a string is given, it will set the slug of the archive page.  */
            'capability_type' => 'post', /* This is related to user permissions and capabilities. Use 'post' or 'page' unless you are building custom capabilities. */
            'hierarchical' => false, /* Can a post have a parent post? If so, use 'true'. */
            'supports' => array('title', 'editor', 'thumbnail', 'page-attributes', 'excerpt', 'revisions', 'sticky') /* This sets which features are available to this post type. See https://codex.wordpress.org/Function_Reference/register_post_type#supports */
        ) /* end of options */
    ); /* end of register post type */
}

add_action( 'cmb2_admin_init', 'zenerator_metaboxes' );
/**
 * Define the metabox and field configurations.
 */
function zenerator_metaboxes() {

    // Start with an underscore to hide fields from custom fields list
    $prefix = '_zenerator_';

    /**
     * Initiate the metabox
     */
    $cmb = new_cmb2_box( array(
        'id'            => 'project_attributes',
        'title'         => __( 'Project Attributes', 'zenerator' ),
        'object_types'  => array( 'project', ), // Post type
        'context'       => 'normal',
        'priority'      => 'high',
        'show_names'    => true, // Show field names on the left
        // 'cmb_styles' => false, // false to disable the CMB stylesheet
        // 'closed'     => true, // Keep the metabox closed by default
    ) );

    $cmb->add_field( array(
        'name'       => __( 'URL', 'zenerator' ),
        'desc'       => __( 'Features of the project', 'zenerator' ),
        'id'         => $prefix . 'url',
        'type'       => 'text_url',
    ) );
    $cmb->add_field( array(
        'name'       => __( 'Features', 'zenerator' ),
        'desc'       => __( 'Features of the project', 'zenerator' ),
        'id'         => $prefix . 'features',
        'type'       => 'text',
        'repeatable' => true
    ) );
    $cmb->add_field( array(
        'name'    => 'Languages and Frameworks',
        'desc'    => 'Any languages or frameworks used on the project',
        'id'      => $prefix . 'languages',
        'type'    => 'multicheck',
        'options' => array(
            'PHP'       => 'PHP',
            'JavaScript'=> 'JavaScript',
            'HTML5'     => 'HTML5',
            'CSS3'      => 'CSS3',
            'jQuery'    => 'jQuery',
            'Symfony2'  => 'Symfony2',
            'WordPress' => 'WordPress',
            'Compass'   => 'Compass',
            'SASS'      => 'SASS',
            'Susy'      => 'Susy',
            'Velocity'  => 'Velocity',
            'Bootstrap' => 'Bootstrap',
            'Twig'      => 'Twig',
            'Git'       => 'Git',
            'Grunt.js'  => 'Grunt.js',
            'Gulp.js'   => 'Gulp.js',
            'Composer'  => 'Composer',
            'Bower'     => 'Bower',
            'YAML'      => 'YAML',
            'Node.js'   => 'Node.js',
            'NPM'       => 'NPM (Node Package Manager)'
        )
    ) );
    $cmb->add_field( array(
        'name' => 'Other Images',
        'desc' => 'All images in addition to the featured image',
        'id'   => $prefix . 'other_images',
        'type' => 'file_list',
         'preview_size' => array( 100, 100 ), // Default: array( 50, 50 )
        // Optional, override default text strings
        'options' => array(
            'file_text' => 'Image', // default: "File:"
        ),
    ) );
}