<?php
/**
 * Print page title
 * 
 * @package Warta
 */

if( !function_exists('warta_page_title') ) :
/**
 * Print page title
 * 
 * @param string $primary   Title
 * @param string $secondary Subtitle
 * @param boolean $one_line TRUE if want to display 1 line and false if 2 lines
 */
function warta_page_title( $primary, $secondary, $one_line = false ) {
?> 

    <div id="title">
        <div class="image-light"></div>
        <div class="container">
            <div class="title-container">
                
                <?php if($one_line) : ?>
                
                    <h3>
                        <?php if( !empty($secondary) ) : ?>
                            <span class="secondary"><?php echo $secondary ?></span>
                        <?php endif ?>
                            
                        <?php if( !empty($primary) ) : ?>
                            <span class="primary"><?php echo $primary ?></span>
                        <?php endif ?>
                    </h3>
                
                <?php else : ?>
                
                    <?php if( !empty($primary) ) : ?>
                        <h3 class="primary"><?php echo $primary ?></h3>
                    <?php endif ?>

                    <?php if( !empty($secondary) ) : ?>
                        <p class="secondary"><?php echo $secondary ?></p>
                    <?php endif ?>
                        
                <?php endif ?>
                    
            </div>
        </div>
    </div>

    <?php
}
endif; // warta_page_title

