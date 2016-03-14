<?php 

    $blog_layout = get_theme_mod( 'ptf_blog_layout', 'classic-layout' );
?>
    
<?php if ( $blog_layout == 'classic-layout' || is_single() ): ?>
        
    <div id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post' ); ?>>
        
        <?php if ( has_post_thumbnail() ) : ?>
            
            <?php if ( is_single() ) : ?>
                
                 <div class="post-thumb">                   
                      <?php the_post_thumbnail( 'ptf-blog-classic-thumb' ); ?>                    
                </div>
                
            <?php else : ?>           
            
                <div class="post-thumb">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_post_thumbnail( 'ptf-blog-classic-thumb' ); ?>
                    </a>
                </div>
                
            <?php endif; ?>
            
        <?php endif; ?>
        
         <div class="post-content clearfix">
            <div class="post-date">
                <span class="day"><?php the_time('j'); ?></span>
                <span class="month"><?php echo substr( get_the_time('F'), 0, 3 ); ?></span>
            </div>
            <div class="right">
            
        <?php if ( is_single() ) : ?>
                                
            <div class="post-header">                    
                <h3 class="post-title"><?php the_title(); ?></h3>
                <span class="post-meta"><?php the_category(', ') ?>, <?php the_time( get_option( 'date_format' ) ); ?></span>
            </div>  
                          
            <?php the_content(); ?>
                    
        <?php else : ?>
                                
            <div class="post-header">                    
                <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                <span class="post-meta"><?php the_category(', ') ?>, <?php the_time( get_option( 'date_format' ) ); ?></span>
            </div>
                                                   
            <?php if ( strlen( get_the_excerpt()) > 0 ) : ?>
                                            
                <?php the_excerpt(); ?>                       
                <p><a href="<?php the_permalink(); ?>" class="read-more"><?php _e( 'Continue Reading', 'artcore' ); ?></a></p>
                                        
            <?php endif; ?> 
                               
        <?php endif; ?>
                
            </div>
        </div>
        
    </div> <!-- /. blog-post -->
       
<?php endif; ?>
    
<?php if ( $blog_layout == 'masonry-layout' && !is_single() ) : ?>
        
    <div id="post-<?php the_ID(); ?>" <?php post_class( 'blog-post col-md-4 col-sm-6' ); ?>>
        
        <h5 class="blog-title">
            <a href="<?php the_permalink(); ?>">
                 
                <?php if ( has_post_thumbnail() ) : ?>
                <span class="blog-thumb">
                    <span class="hover"></span> 
                <?php the_post_thumbnail( 'ptf-blog-grid-thumb' ); ?> 
                </span>
                <?php endif; ?> 
                
                <span class="blog-title-inner"><?php the_title(); ?></span> 
            </a>
        </h5>
        
        <div class="entry-content">
        <span class="blog-meta"><?php the_category(', ') ?>, <?php the_time('j F Y'); ?></span>
        <?php if ( strlen( get_the_excerpt()) > 0 ) : ?>
                                            
                <?php the_excerpt(); ?>
                                    
                <p><a href="<?php the_permalink(); ?>" class="read-more"><?php _e( 'Continue Reading', 'artcore' ); ?></a></p>
                                        
        <?php endif; ?> 
        </div>
        
    </div> <!-- /.blog-post -->
    
<?php endif; ?>