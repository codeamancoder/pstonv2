<?php
/**
 * Deprecated features
 */

if(!class_exists('Warta_Deprecated_Features')) :
class Warta_Deprecated_Features {
        var     $edit_links_custom_sidebar_content      = '',
                $edit_links_template_home               = '';
        
        /**
         * TEMPLETE HOMEPAGE
         * =================
         */
        
        function theme_options__homepage($sections) {
                $sections[]     = array( 'type' => 'divide' );
                
                require dirname(__FILE__) . '/options/homepage.php';
                require dirname(__FILE__) . '/options/carousel.php';

                return $sections;
        }
        
        function admin_notice__homepage() {
?>
                <div class="error">
                        <p><?php _e( 'Warning! Template homepage will be removed soon. Please use page builder instead.', 'warta' ); 
                                echo '<br>' . $this->edit_links_template_home ?>
                        </p>
                </div>
<?php
        }
        
        function register_sidebar__homepage() {
                $friskamax_warta = get_option('friskamax_warta');
                
                register_sidebar( array(
                        'name'          => __( 'Top Section - Homepage', 'warta' ),
                        'description'   => __( 'Appears above main section of homepage.', 'warta' ),
                        'id'            => 'home-top-section',
                        'before_widget' => '<section id="%1$s" class="col-md-12 widget %2$s">',
                        'after_widget'  => '</section>',
                        'before_title'  => '<header class="clearfix"><h4 class="widget-title">',
                        'after_title'   => '</h4></header>',
                ) );

                register_sidebar( array(
                        'name'          => __( 'Main Section - Homepage', 'warta' ),
                        'description'   => __( 'Appears in the main section of homepage (below breaking news and carousel small if any).', 'warta' ),
                        'id'            => 'home-main-section',
                        'before_widget' => '<section id="%1$s" class="col-md-12 widget %2$s">',
                        'after_widget'  => '</section>',
                        'before_title'  => '<header class="clearfix"><h4 class="widget-title">',
                        'after_title'   => '</h4></header>',
                ) );

                register_sidebar( array(
                        'name'          => __( 'Bottom Section - Homepage', 'warta' ),
                        'description'   => __( 'Appears below main section and sidebar section of homepage.', 'warta' ),
                        'id'            => 'home-bottom-section',
                        'before_widget' => '<section id="%1$s" class="col-md-12 widget %2$s">',
                        'after_widget'  => '</section>',
                        'before_title'  => '<header class="clearfix"><h4 class="widget-title">',
                        'after_title'   => '</h4></header>',
                ) );
               
                if( isset( $friskamax_warta['homepage_specific_widget']['sidebar'] ) && $friskamax_warta['homepage_specific_widget']['sidebar'] == 1 ) {
                        register_sidebar( array(
                                'name'          => __( "Sidebar Section - Homepage", 'warta' ),
                                'id'            => 'home-sidebar-section',
                                'description'   => __( 'Appears in the sidebar section (next to main section) of homepage. Replaces "Sidebar Section - Default".', 'warta' ),
                                'before_widget' => '<section id="%1$s" class="col-sm-6 col-md-12 widget %2$s">',
                                'after_widget'  => '</section>',
                                'before_title'  => '<header class="clearfix"><h4 class="widget-title">',
                                'after_title'   => '</h4></header>',
                        ) );
                }
                
                if( isset( $friskamax_warta['homepage_specific_widget']['footer'] ) && $friskamax_warta['homepage_specific_widget']['footer'] == 1 ) {
                        register_sidebar( array(
                                'name'          => __( "Footer Section - Homepage", 'warta' ),
                                'id'            => 'home-footer-section',
                                'before_widget' => $friskamax_warta['homepage_footer_layout'] == 1 
                                                ? '<section id="%1$s" class="col-md-2 col-sm-4 %2$s">'
                                                : '<section id="%1$s" class="col-md-3 col-sm-6 %2$s">',
                                'description'   => __( 'Appears in the footer section of homepage. Replaces "Footer Section - Default".', 'warta' ),
                                'after_widget'  => '</section>',
                                'before_title'  => '<div class="title"><h4 class="widget-title">',
                                'after_title'   => '</h4></div>',
                        ) );
                }
        }
            
        function template_homepage() {
                $args = array( 
                        'meta_key'      => '_wp_page_template',
                        'meta_value'    => 'template-homepage.php',
                        'post_type'     => 'page',
                );
                
                // Update homepage template location
                $the_query = new WP_Query( $args );
                if ( $the_query->have_posts() ) {
                        while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                update_post_meta(get_the_ID(), '_wp_page_template', 'deprecated/template-homepage.php');
                        }
                } 
                wp_reset_postdata();

                // Move theme option sections and add admin notice
                $args['meta_value'] = 'deprecated/template-homepage.php';
                $the_query = new WP_Query( $args );
                if ( $the_query->have_posts() ) {
                        while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                $this->edit_links_template_home .= '<a href="' . get_edit_post_link() . '">' . get_the_title() . '</a>, ';
                        }
                        $this->edit_links_template_home = trim($this->edit_links_template_home, ', ');
                        
                        add_filter( 'redux/options/friskamax_warta/sections', array($this, 'theme_options__homepage') );
                        add_action( 'admin_notices', array($this, 'admin_notice__homepage') );
                        add_action( 'widgets_init', array($this, 'register_sidebar__homepage') );
                } 
                wp_reset_postdata();
        }
        
        /**
         * CUSTOM SIDEBAR CONTENT
         * ======================
         */
        
        function admin_notice__custom_sidebar_content() {
?>
                <div class="error">
                        <p>
<?php                           _e( 'Warning! Custom Sidebar Content will be removed soon. Please use page builder instead.', 'warta' ); 
                                echo '<br>' . $this->edit_links_custom_sidebar_content;
?>                        
                        </p>
                </div>
<?php    
        }
        
        function metabox_custom_sidebar_content_init() {
                new Warta_Custom_Sidebar_Meta_Box();
        }
        
        function metabox_custom_sidebar_content() {                
                $the_query = new WP_Query( array( 
                        'post_type'     => 'page',
                        'meta_query' => array(
                                array(
                                    'key' => 'friskamax_custom_sidebar',
                                    'value'   => array(''),
                                    'compare' => 'NOT IN'
                                )
                        )
                ) );
                if ( $the_query->have_posts() ) {
                        while ( $the_query->have_posts() ) {
                                $the_query->the_post();
                                $this->edit_links_custom_sidebar_content .= '<a href="' . get_edit_post_link() . '">' . get_the_title() . '</a>, ';
                        }
                        $this->edit_links_custom_sidebar_content = trim($this->edit_links_custom_sidebar_content, ', ');                        
                        add_action( 'admin_notices', array($this, 'admin_notice__custom_sidebar_content') );
                        
                        if ( is_admin() ) {
                                add_action( 'load-post.php', array($this, 'metabox_custom_sidebar_content_init') );
                                add_action( 'load-post-new.php', array($this, 'metabox_custom_sidebar_content_init') );
                        }
                } 
                wp_reset_postdata();
        }
        
        /**
         * INIT
         * ====
         */
        
        function __construct() {          
                require dirname(__FILE__) . '/template-tags/carousel.php';
                require dirname(__FILE__) . '/meta-boxes/custom-sidebar.php';
                
                $this->template_homepage();
                $this->metabox_custom_sidebar_content();
        }
}
new Warta_Deprecated_Features;
endif; // Warta_Deprecated_Features