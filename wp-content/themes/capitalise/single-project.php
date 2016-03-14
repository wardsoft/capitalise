<?php
/**
 * Project Single Template File.
 *
 * @package PlugFramework
 * @subpackage Artcore
 */
 
get_header(); ?>
<section class="project-single">
	<div class="container">
	    <?php
	     
	       if( have_posts() ) : while ( have_posts() ) : the_post();
           
               // Get all the metabox values
               $project_client = rwmb_meta('ptf_project_client');
               $project_date = rwmb_meta('ptf_project_date');
               $project_location = rwmb_meta('ptf_project_location');
               $project_share = rwmb_meta('ptf_project_share', true);
               $project_images = rwmb_meta('ptf_project_gallery', 'type=image'); 
               
               // Get each term associated with the post
               $project_terms = get_the_terms( $post -> id, "project-categories" );
               
	    ?>
		<div class="row">
			<div class="col-md-5 project-details">			    
				<h4 class="project-title"><?php the_title(); ?></h4>
				<div class="project-description">
					<?php the_content(); ?>
				</div>
				<div class="project-services">
				    
				    <?php if ( !empty( $project_client ) ) : ?>
				        
    					<div class="project-detail-item">
    						<div class="left">
    							<i class="fa fa-user"></i><strong><?php _e('Client:', 'artcore'); ?></strong>
    						</div>
    						<div class="right">
    							<?php echo esc_html( $project_client ); ?>
    						</div>
    					</div>
    					
					<?php endif; ?>
					
					<?php if ( !empty( $project_date ) ) : ?>
					    
                        <div class="project-detail-item">
                            <div class="left">
                                <i class="fa fa-calendar"></i><strong><?php _e('Date:', 'artcore'); ?></strong>
                            </div>
                            <div class="right">
                                <?php echo esc_html( $project_date ); ?>
                            </div>
                        </div>
                        
                    <?php endif; ?>
                    
                    <?php if ( !empty( $project_location ) ) : ?>
                        
                        <div class="project-detail-item">
                            <div class="left">
                                <i class="fa fa-map-marker"></i><strong><?php _e('Location:', 'artcore'); ?></strong>
                            </div>
                            <div class="right">
                                <?php echo esc_html( $project_location ); ?>
                            </div>
                        </div>
                        
                    <?php endif; ?>
					
					
					<?php if ( !empty( $project_terms ) ) : ?>
					    
    					<div class="project-detail-item">
    						<div class="left">
    							<i class="fa fa-folder-open-o"></i><strong><?php _e('Category:', 'artcore'); ?></strong>
    						</div>
    						<div class="right">
    							<?php echo strip_tags( get_the_term_list ( get_the_ID(), 'project-categories', '', ' / ' ) ); ?>
    						</div>
    					</div>
    					
					<?php endif; ?>
					
					<?php if ( $project_share ) : ?>
					    
					<div class="project-detail-item">
						<div class="left">
							<i class="fa fa-share-alt"></i><strong><?php _e('Share on:', 'artcore'); ?></strong>
						</div>
						<div class="right">						  
							<a onclick="window.open('https://www.facebook.com/sharer.php?s=100&amp;p[url]=<?php echo esc_attr(urlencode(get_permalink()));?>','sharer', 'toolbar=0,status=0,width=620,height=280');" title="<?php _e('Share on Facebook', 'artcore');?>" href="javascript:;"><?php _e( 'Facebook', 'artcore' ) ?></a>
							<a onclick="popUp=window.open('http://twitter.com/home?status=<?php echo esc_attr(urlencode(get_the_title())); ?> <?php echo esc_attr(urlencode(get_permalink())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;" title="<?php _e('Share on Twitter', 'artcore');?>"  href="javascript:;"><?php _e( 'Twitter', 'artcore' ) ?></a>
							<a title="<?php echo _e('Share on Google+', 'artcore' );?>"  href="javascript:;" onclick="popUp=window.open('https://plus.google.com/share?url=<?php echo esc_attr(urlencode(get_permalink())); ?>','sharer','scrollbars=yes,width=800,height=400');popUp.focus();return false;"><?php _e( 'Google Plus', 'artcore' ) ?></a>
						</div>
					</div>
					
					<?php endif; ?>
					
				</div>				
			</div>
			<div class="col-md-7">
				<div class="row">
				    <?php if ( !empty( $project_images )) : ?>
				        
    				    <?php $i = 0; ?>
        				<?php foreach ( $project_images as $project_image ) : ?>
    				    
                    		<?php if ( $i === 0 ) : ?>
                    		    
                				<?php $project_image_thumb = aq_resize( $project_image['full_url'] , 850, 500, true, true, true ); ?>
                				<div class="col-sm-12">
                					<div class="project-image-placeholder">
                						<img src="<?php echo esc_url( $project_image_thumb ); ?>" alt="<?php the_title_attribute(); ?>">
                					</div>
                				</div>
            
            				<?php else : ?>
            				    
                				<?php $project_image_thumb = aq_resize( $project_image['full_url'] , 550, 550, true, true, true ); ?>
                				<div class="col-sm-6">
                					<div class="project-image-placeholder">
                						<img src="<?php echo esc_url( $project_image_thumb ); ?>" alt="<?php the_title_attribute(); ?>">
                					</div>
                				</div>
                				
            				<?php endif; ?>
            					
            			<?php $i++; ?>
            			
    					<?php endforeach; ?>
    					
					<?php endif; ?>
										
				</div>
			</div>
			
		</div>
				
		<?php ptf_single_post_nav(); ?>
		
		<?php endwhile; endif; ?>
		
	</div>
</section>
<?php get_footer(); ?>