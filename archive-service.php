<?php
get_header();
the_cam_portal_breadcrumbs();
?>

<div class="container">
        <div class="row">
                <div class="col-lg-12">
                        <div class="form-row service-filter">

                                <div class="col-md-6">
                                        <div class="form-group">
                                                <label for="exampleFormControlSelect1">ស្វែងរកសេវាតាមវិស័យ</label>
                                                <select class="form-control" id="exampleFormControlSelect1" onchange="location = this.value;">
                                                        <option value="#">សូមជ្រើសរើស</option>
                                                
                                                <?php 
                                                $terms = get_terms( array(
                                                        'taxonomy' => 'sector',
                                                        'hide_empty' => false,
                                                ) );
                                                
                                                $queried_object = get_queried_object();
                                                
                                                
                                                foreach ( $terms as $term ) {

                                                        $args = array(
                                                                'post_type' => 'service',
                                                                'post_status'=>'publish',
                                                                'tax_query' => array(
                                                                        array(
                                                                                'taxonomy' => 'sector',
                                                                                'field'    => 'slug',
                                                                                'terms'    => array( $term->slug ),
                                                                        )
                                                                ),
                                                        );
                                                        $query = new WP_Query( $args );

                                                        $home_url = esc_url( home_url( 'sector/'.$term->slug ) );
                                                        $active = ( $queried_object->slug == $term->slug ) ? "selected" : "";

                                                        echo '<option ' . $active . ' value=" ' . $home_url . ' ">' . $term->name . ' ('. $query->post_count .')</option>';
                                                }
                                                
                                                
                                                ?>
                                                
                                                
                                                
                                                        
                                                </select>
                                        </div>
                                </div>
                                <div class="col-md-6">
                                        <div class="form-group">
                                                <label for="exampleFormControlSelect2">ស្វែងរកសេវាតាមក្រុម</label>
                                                <select class="form-control" id="exampleFormControlSelect2" onchange="location = this.value;">
                                                        <option value="#">សូមជ្រើសរើស</option>
                                                <?php 
                                                $terms = get_terms( array(
                                                        'taxonomy' => 'service_group',
                                                        'hide_empty' => false,
                                                ) );

                                                foreach ( $terms as $term ) {


                                                        $args = array(
                                                                'post_type' => 'service',
                                                                'post_status'=>'publish',
                                                                'tax_query' => array(
                                                                        array(
                                                                                'taxonomy' => 'service_group',
                                                                                'field'    => 'slug',
                                                                                'terms'    => array( $term->slug ),
                                                                        )
                                                                ),
                                                        );
                                                        
                                                        $query = new WP_Query( $args );
                                                        $home_url = esc_url( home_url( 'service_group/'.$term->slug ) ); 
                                                        $active = ( $queried_object->slug == $term->slug ) ? "selected" : "";

                                                        echo '<option ' . $active . ' value=" ' . $home_url . ' ">' . $term->name . ' ('. $query->post_count .')</option>';
                                                }
                                                
                                                
                                                ?>
                                                </select>
                                        </div>
                                </div>
                        </div>



                        <div class="b-2">

		        <?php if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) :
                                the_post();
                        ?>
                                <div class="b-item-wrap">
                                        <div class="b-item">
                                                <div class="b-title-wrap">
                                                        <div class="b-title margin-bottom-15"><a href="<?php the_permalink(); ?>"><span style="color: #ccc;font-size: 14px;" class="oi oi-chevron-right"></span> <?php the_title(); ?></a></div>
                                                        <div class="b-cat">
                                                        <?php 
                                                        if ( get_the_terms ( $post->ID, 'sector' ) ) {
                                                                $term_obj_list = get_the_terms ( $post->ID, 'sector' );
                                                                $terms_string = join ( ', ', wp_list_pluck ( $term_obj_list, 'name' ) );
                                                                printf( '<span class="oi oi-paperclip"></span><span>%s</span>', $terms_string );
                                                        }
                                                        ?>
                                                                <?php if ( get_post_meta( $post->ID, 'cam_portal_service_form', true ) ) { ?>
                                                                        <a href="<?php echo get_post_meta( $post->ID, 'cam_portal_service_form', true ); ?>"><span class="oi oi-cloud-download"></span><?php echo __( 'ទម្រង់បែបបទ' ); ?></a>
                                                                <?php } ?>
                                                                <?php if ( get_post_meta( $post->ID, 'cam_portal_service_pro_form', true ) ) { ?>
                                                                        <a href="<?php echo get_post_meta( $post->ID, 'cam_portal_service_pro_form', true ); ?>"><span class="oi oi-eye"></span><?php echo __( 'និតិវិធី' ); ?></a>
                                                                <?php } ?>
                                                                
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        <?php

			endwhile;
			cam_portal_paginations();

		endif;
		?>

			</div>
		</div>
			
                <div class="col-lg-4 widget-area">
                        <?php// dynamic_sidebar( 'sidebar-2' ); ?>
                </div>
        </div><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
