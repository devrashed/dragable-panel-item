<div class="tmph-contents-wrapper">
    <div class="tmph-members">
        <?php
        // Shortcode attributes
        $member_count = isset( $attributes['member_count'] ) ? $attributes['member_count'] : '';
        $img_position = isset( $attributes['img_position'] ) ? $attributes['img_position'] : '';
        $show_button  = isset( $attributes['show_button'] ) ? $attributes['show_button'] : '';

        // Query
        $team_members = new WP_Query( array(
            'post_type' => 'team_members',
            'posts_per_page'=> $member_count,
        ) );
        
        // Post loop
        if( $team_members->have_posts() ) {
            while ( $team_members->have_posts() ) {
                $team_members->the_post();	
                $term_obj_list = get_the_terms( get_the_id(), 'member_type' );
                $terms_string = join(', ', wp_list_pluck($term_obj_list, 'name'));
                ?>
                <div class="tmph-single-member">
                    <?php
                        if ( $img_position == 'top' ) {
                            ?>
                            <a href="<?php the_permalink()?>">
                                <?php the_post_thumbnail('thumbnail', ['class' => 'tmph-member-img'])?>
                                <h4 class="tmph-member-name"><?php echo the_title()?></h4>
                            </a>
                            <p class="tmph-member-designation"><?php _e( $terms_string, 'team-member-plugin-hasan' )?></p>
                            <?php
                        } else {
                            ?>
                            <a href="<?php the_permalink()?>">
                                <h4 class="tmph-member-name"><?php echo the_title()?></h4>
                            </a>
                            <p class="tmph-member-designation"><?php _e( $terms_string, 'team-member-plugin-hasan' )?></p>
                            <a href="<?php the_permalink()?>">
                                <?php the_post_thumbnail('thumbnail', ['class' => 'tmph-member-img'])?>
                            </a>
                            <?php
                        }
                    ?>
                </div>
                <?php
            }
        }
        ?>
    </div>

    <!-- Conditionally show/hide button -->
    <?php
    if ( $show_button == 1 || $show_button == 'true' ) {
        ?>
        <div class="tmph-see-all-btn-wrapper">
            <a href="<?php echo site_url() . '/team_members'?>" class="tmph-see-all-btn"><?php _e( 'See All', 'team-member-plugin-hasan' )?></a>
        </div>
        <?php
    }
    ?>
</div>