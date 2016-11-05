<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Warta
 */
global $friskamax_warta, $friskamax_warta_var;

$friskamax_warta_var['page']      = 'singular';
$friskamax_warta_var['html_id']   = 'blog-detail';

get_header(); 

warta_page_title( 
        get_post_format() == 'aside' ? '': get_the_title(), 
        get_the_category_list( _x( ' / ', 'Used between category list items.', 'warta' ) )
); 

?>
</header>

<div id="content">
        <div class="container">
                <div class="row">
                        <main id="main-content" class="col-md-8" role="main">
                                <div class="row"><?php dynamic_sidebar('singular-before-content-section'); ?></div>
<?php                           while ( have_posts() ) : 
                                        the_post(); 

                                        // Content
                                        get_template_part( 'content', 'single' ); 

                                        // Share buttons
                                        if( isset( $friskamax_warta['singular_share_buttons'] ) && !!$friskamax_warta['singular_share_buttons'] ) : ?>
                                                <section class="clearfix" 
                                                         data-share-buttons
                                                         data-permalink="<?php the_permalink() ?>"
                                                         data-title="<?php the_title() ?>">
                                                </section>
<?php                                   endif;

                                        // Post tags
                                        if( $friskamax_warta['singular_post_meta']['tags'] && get_the_tags() ) : ?>
                                                <section class="post-tags clearfix">
<?php                                                   if( isset( $friskamax_warta['singular_tag_text'] ) && !!$friskamax_warta['singular_tag_text'] ) {
                                                                echo "<h5>{$friskamax_warta['singular_tag_text']}</h5>";
                                                        }
                                                        the_tags('<ul class="tags"><li>', '</li><li>', '</li></ul>') ?>
                                                </section>
<?php                                   endif; 

                                        // Prev/next post navigation
                                        warta_post_nav();

                                        // Author
                                        if( isset( $friskamax_warta['singular_author_info'] ) && !!$friskamax_warta['singular_author_info'] ) : ?>
                                                <section class="widget author">                                                                
                                                        <!--widget title-->
<?php                                                   if(isset($friskamax_warta['singular_author_info_title']) && !!$friskamax_warta['singular_author_info_title']) : ?>
                                                                <header class="clearfix"><h4><?php echo strip_tags( $friskamax_warta['singular_author_info_title'] ) ?></h4></header>
<?php                                                   endif ?>

                                                        <!--avatar-->
                                                        <a href ="<?php echo esc_url( get_author_posts_url( get_the_author_meta('ID') ) ) ?>" 
                                                           class="avatar" 
                                                           title="<?php echo esc_attr( sprintf( __('View all posts by %s', 'warta'), get_the_author() ) ) ?>"
                                                        >
<?php                                                           echo get_avatar( get_the_author_meta( 'ID' ), 75 ) ?>
                                                                <div class="image-light"></div>
                                                        </a>

                                                        <!--Author's Name-->
                                                        <span class="name"><?php echo get_the_author_link() ?></span>
                                                        <br>

                                                        <!--Author's Bio-->
                                                        <p><?php echo get_the_author_meta('description') ?></p>

                                                        <!--Author's social media links-->
                                                        <ul class="social clearfix">
<?php                                                           foreach ($friskamax_warta_var['social_media'] as $key => $value) : 
                                                                        $url = get_the_author_meta( "friskamax_{$key}" ); 
                                                                        if( !empty($url) ) : ?>
                                                                                <li>
                                                                                        <a href="<?php echo esc_url( get_the_author_meta( "friskamax_{$key}" ) ) ?>" title="<?php echo $value ?>">
                                                                                                <i class="sc-sm sc-<?php echo $key ?>"></i>
                                                                                        </a>
                                                                                </li>
<?php                                                                   endif;  
                                                                endforeach; ?>
                                                        </ul>
                                                </section>
<?php                                   endif; ?>

                                        <div class="row"><?php dynamic_sidebar('singular-after-content-section'); ?></div>
<?php
                                        // Related posts
                                        if( isset( $friskamax_warta['singular_related'] ) && !!$friskamax_warta['singular_related'] ) { 
                                                warta_related_posts();
                                        }

                                        // If comments are open or we have at least one comment, load up the comment template
                                        if ( comments_open() || '0' != get_comments_number() ) :
                                                comments_template();
                                        endif; 
                                endwhile; ?>
                        </main>
                                
<?php                   get_sidebar(); ?>
                </div>
        </div>
</div><!--#content-->

<?php 
get_footer(); 