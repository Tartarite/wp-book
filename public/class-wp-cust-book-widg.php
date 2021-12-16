<?php

class Wpb_Category_Widget extends WP_Widget {

    public function __construct() {

        $widget_options = array(
            'classname'   => 'wpb-category-widget',
            'description' => __( 'Custom widget to display the books of selected category.', 'wp-book' ),
        );
        parent::__construct( 'wpb_category', __( 'Book Category', 'wp-book'), $widget_options );

    }

    function widget( $args, $instance ) {
	    extract( $args );

	    $title 		  = apply_filters( 'widget_title', $instance[ 'title' ] );
	    $taxonomy 	= $instance[ 'taxonomy' ];

	    $args = array(
		    'taxonomy'	=> $taxonomy
	    );

	    $cats = get_categories( $args );
	    ?>
  		<?php echo $before_widget; ?>
  	  <?php if ( $title ) { echo $before_title . $title . $after_title; } ?>
  		<ol>
    		<?php foreach( $cats as $cat ) { ?>
    		<li><a href="<?php echo get_term_link( $cat->slug, $taxonomy ); ?>" title="<?php sprintf( __( "View all posts in %s" ), $cat->name ); ?>"><?php echo $cat->name; ?></a></li>
    		<?php } ?>
  		</ol>
    	<?php echo $after_widget; ?>
	     <?php
    }

    // WP_Widget::form
    function form( $instance ) {

	    $title 		= esc_attr( $instance['title'] );
	    $taxonomy	= esc_attr( $instance['taxonomy'] );
	    ?>
	    <p>
	      <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title:'); ?></label>
	      <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
	    </p>
	    <p>
		    <label for="<?php echo $this->get_field_id('taxonomy'); ?>"><?php _e('Choose the category to display'); ?></label>
		    <select name="<?php echo $this->get_field_name('taxonomy'); ?>" id="<?php echo $this->get_field_id('taxonomy'); ?>" class="widefat"/>
			    <?php
			    $taxonomies = get_taxonomies(array('name' => 'book-category' ), 'names');
			    foreach ($taxonomies as $option) {
				    echo '<option id="' . $option . '"', $taxonomy == $option ? ' selected="selected"' : '', '>', $option, '</option>';
			    }
			    ?>
		    </select>
	    </p>
	    <?php
}

    function update($new_instance, $old_instance) {
	    $instance = $old_instance;
	    $instance['title']    = strip_tags($new_instance['title']);
	    $instance['taxonomy'] = $new_instance['taxonomy'];
	    return $instance;
    }
}
