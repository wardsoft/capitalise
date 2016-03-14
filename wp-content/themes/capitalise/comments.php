<?php
/**
 * Comments Template.
 * The template for displaying comments
 * 
 * @package PlugFramework
 * @subpackage Artcore
 */
 
if ( post_password_required() ) {
    return;
}
?>

<?php if ( have_comments() ) : ?>
    
<div class="row comments">
	<div class="col-sm-12 comment-head">
		<h5>
          <?php printf( _n( '%1$s Comment', '%1$s Comments', get_comments_number(), 'artcore' ), number_format_i18n( get_comments_number() )); ?>
       </h5>
	</div>
	<div class="col-sm-12">
	    <div class="navigation">
            <div class="alignleft"><?php previous_comments_link() ?></div>
            <div class="alignright"><?php next_comments_link() ?></div>
        </div>
        
		<ul class="comment-list">
			<?php
                wp_list_comments( array(
                    'style'       => 'ul',
                    'short_ping'  => true,
                    'avatar_size' => 70,
                ) );
            ?>
		</ul>
		
		<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
            <p class="no-comments"><?php _e( 'Comments are closed.', 'artcore' ); ?></p>
        <?php endif; ?>
		
	</div>
</div>
<hr>

<?php endif; // have_comments() ?>

<?php if ( comments_open() ) : ?>
    
<div class="row comment-respond">
	<div class="col-sm-12">
	    
	<?php
	
        $args = array(
          'id_form'           => 'commentform',
          'id_submit'         => 'submit',
          'title_reply'       => __( 'Submit a comment', 'artcore' ),
          'title_reply_to'    => __( 'Submit a comment to %s', 'artcore' ),
          'cancel_reply_link' => __( 'Cancel Reply', 'artcore' ),
          'label_submit'      => __( 'Submit Comment', 'artcore' ),
          'class_submit' => 'btn btn-accent',
        
         'comment_field' => '<div class="row"><fieldset class="col-sm-12">'.
            '<label for="comment">' . __( 'Comment', 'artcore' ) . '</label>'.
            '<textarea id="comment" name="comment" rows="4" aria-required="true">'.'</textarea></fieldset></div>',
        
          'must_log_in' => '<p class="must-log-in">' .
            sprintf(
              __( 'You must be <a href="%s">logged in</a> to post a comment.', 'artcore' ),
              wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
            ) . '</p>',
        
          'logged_in_as' => '<p class="logged-in-as">' .
            sprintf(
            __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'artcore' ),
              admin_url( 'profile.php' ),
              $user_identity,
              wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
            ) . '</p>',
        
          'comment_notes_before' => '<p>'. __( 'Your email address will not be published. Required fields are marked *', 'artcore' ) . '</p>',
        
          'comment_notes_after' => '',
        
          'fields' => apply_filters( 'comment_form_default_fields', array(
        
            'author' =>
              '<div class="row"><fieldset class="col-sm-6 col-md-4">' .
              '<label for="author">' . __( 'Name', 'artcore' ) .
              ' <span class="required">*</span></label> ' .
              '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
              '" size="30" /></fieldset>',
        
            'email' =>
              '<fieldset class="col-sm-6 col-md-4">'.
              '<label for="email">' . __( 'Email', 'artcore' ) .
              ' <span class="required">*</span></label>' .
              '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
              '" size="30" /></fieldset>',
        
            'url' =>
              '<fieldset class="col-sm-6 col-md-4">
              <label for="url">' .
              __( 'Website', 'artcore' ) . '</label>' .
              '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
              '" size="30" /></fieldset></div>'
            )
          ),
        );
    
        comment_form( $args );    
    ?>
    
    </div> <!-- /.col-sm-12 -->
	
</div> <!-- /.comment-respond -->

<?php endif; ?>   