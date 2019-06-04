<?php if(is_single()) : ?>
	<div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <div class="blog-meta">
            <div class="post-meta">
                <span><i class="fa fa-user"></i><?php the_author(); ?></span>
                <span><i class="fa fa-calendar"></i><?php the_time(get_option( 'date_format' )); ?></span>
                <span><i class="fa fa-tags"></i><?php the_category( ', '); ?></span>
            </div>
        </div>

		<?php if(has_post_thumbnail()) : ?>
            <div class="image pdb40">
                <?php the_post_thumbnail( 'full'); ?>
            </div>
        <?php endif; ?>
        <p>
            <?php the_content(); ?>
        </p>
        <?php
            wp_link_pages( array(
                'before'      => '<div class="page-links">' . esc_html__( 'Pages:', 'kalkulat' ),
                'after'       => '</div>',
                'link_before' => '<span class="page-number">',
                'link_after'  => '</span>',
            ) );
        ?>
        <div class="mt50"></div>
        <hr class="kal-separator" />
        <div class="tag-and-share">
       	    <?php if(has_tag()) : ?>
				<div class="tag-list">
					<?php the_tags('',' '); ?>
				</div>
			<?php endif; ?>
            <?php if(function_exists('kalkulate_post_share')) : ?>
            <div class="social-share">
                <span><?php print esc_html__('Share This Article :', 'kalkulat') ?></span>
                <ul>
                    <li><?php kalkulate_post_share(); ?></li>
                </ul>
            </div>
            <?php endif; ?>
        </div>
    </div>

<?php else: ?>
    <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
        <?php if(has_post_thumbnail()) : ?>
            <div class="image">
                <?php the_post_thumbnail( 'full'); ?>
            </div>
        <?php endif; ?>
        <div class="blog-text">
            <h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <div class="post-meta">
                <span><i class="fa fa-user"></i><?php the_author(); ?></span>
                <span><i class="fa fa-calendar"></i><?php the_time(get_option( 'date_format' )); ?></span>
                <?php if(get_comments_number() > 0) : ?>
                <span><i class="fa fa-comments-o"></i><?php print get_comments_number(); ?></span>
                <?php endif; ?>
            </div>
            <p><?php the_content(); ?></p>
            <a class="btn-readmore" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Read More', 'kalkulat' ); ?></a>
        </div>
    </div>
<?php endif;  ?>