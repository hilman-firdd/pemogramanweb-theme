<?php 
add_action( 'init', 'register_cpt_files' );

function register_cpt_files() {

    $labels = array( 
        'name' => _x( 'File', 'files' ),
        'singular_name' => _x( 'Files', 'files' ),
        'add_new' => _x( 'Add New', 'files' ),
        'add_new_item' => _x( 'Add New Files', 'files' ),
        'edit_item' => _x( 'Edit Files', 'files' ),
        'new_item' => _x( 'New Files', 'files' ),
        'view_item' => _x( 'View Files', 'files' ),
        'search_items' => _x( 'Search File', 'files' ),
        'not_found' => _x( 'No file found', 'files' ),
        'not_found_in_trash' => _x( 'No file found in Trash', 'files' ),
        'parent_item_colon' => _x( 'Parent Files:', 'files' ),
        'menu_name' => _x( 'File', 'files' ),
    );

    $args = array( 
        'labels' => $labels,
        'hierarchical' => true,
        
        'supports' => array( 'title' ),
        'taxonomies' => array( 'types' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        
        
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );

    register_post_type( 'files', $args );
}

function save_book_meta( $post_id, $post, $update ) {

    $slug = 'files';

    // If this isn't a 'files' post, don't update it.
    if ( $slug != $post->post_type ) {
        return;
    }
    if(get_post_meta( $post_id, 'tag', TRUE)) {
        $tags = implode(',',get_post_meta( $post_id, 'tag', TRUE));
        $data = explode( ',', $tags );
        wp_set_post_terms( $post_id, array_map('intval', $data), 'types' );
    } 
}
add_action( 'save_post', 'save_book_meta', 10, 3 );

 ?>