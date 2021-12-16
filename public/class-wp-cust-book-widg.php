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
		    'post_type' => 'book',
        'tax_query' => array(
          array(
            'taxonomy' => 'book-category',
            'field'    => 'slug',
            'terms'    => $taxonomy,
          ),
        ),
	    	);

	    ?>
  		<?php echo $before_widget; ?>
  	  <?php if ( $title ) { echo $before_title . $title . $after_title; } ?>
  		<ol>
		  <?php
          $title_query = new Wp_Query( $args );
          while( $title_query->have_posts()){
            $title_query->the_post();
            echo '<li><a href="' . get_permalink( get_the_id() ) . '">' . get_the_title() . '</a></li>';
          }
        ?>
  		</ol>
    	<?php echo $after_widget; ?>
	     <?php
    }

    // WP_Widget::form
    function form( $instance ) {

		if( isset( $instance[ 'title' ]) ) {
			$title 		= esc_attr( $instance['title'] );
		  } else {
			$title = '';
		  }
			if( isset( $instance[ 'taxonomy' ]) ) {
			$taxonomy	= esc_attr( $instance['taxonomy'] );
		  } else {
			$taxonomy = '';
		  }
	    ?>
	    <p>
	      <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
	      <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" />
	    </p>
	    <p>
		    <label for="<?php echo $this->get_field_id( 'taxonomy' ); ?>"><?php _e( 'Choose the category to display' ); ?></label>
		    <select name="<?php echo $this->get_field_name( 'taxonomy' ); ?>" id="<?php echo $this->get_field_id( 'taxonomy' ); ?>" class="widefat"/>
			    <?php
			    $taxonomies = get_terms( array( 'taxonomy' => 'book-category', 'hide_empty' => false ) );
				if( !empty( $taxonomies ) ) {
				  foreach( $taxonomies as $category ) {
					if( $category->taxonomy == 'book-category' ) {
					  echo '<option id="' . $category->name . '" value="' . $category->name . '"', $taxonomy == $category->name ? ' selected="selected"' : '', '>', $category->name, '</option>';
					}
				  }
				}
			    ?>
		    </select>
	    </p>
	    <?php
}

    function update($new_instance, $old_instance) {
	    $instance = $old_instance;
	    $instance[ 'title' ]    = strip_tags($new_instance[ 'title' ]);
	    $instance[ 'taxonomy' ] = $new_instance[ 'taxonomy' ];
	    return $instance;
    }
}
