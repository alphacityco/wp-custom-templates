<?php
/**
 * Template Name: Blog/Noticias
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package _s
 */

get_header(); 
$urlFeaturred = wp_get_attachment_url( get_post_thumbnail_id($post->ID, 'thumbnail') );
?>
<style type="text/css">
	.proyec-container-top {
		background-image: url(<?php echo $urlFeaturred; ?>); 
		background-size: 110%; 
		background-repeat: no-repeat;
		background-position: 48.8879% 24.444%;		
	}
	.sep-top-md {
		padding-top: 1em; 
	}
	#secondary {
		display:none;
	}
</style>
<?php
  // set up or arguments for our custom query
  $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;
  $query_args = array(
    'post_type' => 'post',
    'category_name' => 'proyectos',
    'posts_per_page' => 3,
    'paged' => $paged
  );
  // create a new instance of WP_Query
  $the_query = new WP_Query( $query_args );
?>
<main>
	<div class="proyec-container-top">
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<div class="proyec-container-title-top"><h4><?php the_title(); ?></h4></div>
		<?php endwhile; else: endif; ?>
	</div>
	<div class="container content-proyects">
		<div class="row">
			<div class="col-md-9 contenido">
				<?php if ( $the_query->have_posts() ) : while ( $the_query->have_posts() ) : $the_query->the_post(); // run the loop ?>
				  <div class="row proyect-cat">
						<?php the_tags('','',''); ?> 
					</div>
					<div class="row">
						<div class="col-md-9">
							<a href="<?php the_permalink(); ?>"><h3><?php the_title(); ?></h3></a>
							<small><?php //the_date(); ?></small>
						</div>	
						<div class="col-md-3 post-info sep-top-md">
							<a href="<?php the_permalink(); ?>"><?php ottavio_social_share(); ?></a>
						</div>					
					</div>
					<div class="row exceprt-proyect">
						<div class="col-md-4">
							<?php echo get_the_post_thumbnail($post_id, 'playervid', array('class' => 'alignleft')); ?>
						</div>
						<div class="col-md-8">
							<?php the_excerpt(); ?>
						</div>
					</div>
					<hr>
				<?php endwhile; ?>
			</div>
			<?php if ( $sidebar_position != 'hide' ) : ?>
				<aside id="sidebar" class="col-md-3 sep-top-lg sidebar <?php if ( $sidebar_position == 'left' ) : ?>col-md-pull-9<?php endif; ?>" role="complementary">
					<!-- start sidebar-->
					<?php get_sidebar('video-sidebar'); ?>
					<!-- end sidebar-->
				</aside>
			<?php endif; ?>
		</div>
	</div>
	<div class="container">
		<?php if ($the_query->max_num_pages > 1) { // check if the max number of pages is greater than 1  ?>
		<!--
		  <nav class="prev-next-posts">
		    <div class="prev-posts-link">
		      <?php echo get_next_posts_link( 'Más proyectos', $the_query->max_num_pages ); // display older posts link ?>
		    </div>
		    <div class="next-posts-link">
		      <?php echo get_previous_posts_link( 'Menos proyectos' ); // display newer posts link ?>
		    </div>
		  </nav>
		 -->
		 <div class="row foter-proyect">
		 	<div class="col-md-9">
			 	<div class="col-md-6 nav-left">
			 		<?php echo get_previous_posts_link( 'Menos proyectos' ); // display newer posts link ?>
			 	</div>
			 	<div class="col-md-6 text-right nav-right">
			 		<?php echo get_next_posts_link( 'Más proyectos', $the_query->max_num_pages ); // display older posts link ?>
			 	</div>
			 </div>
			 <div class="col-md-3">
			 </div>
		 </div>
		<?php } ?>

		<?php else: ?>
		  <article>
		    <h1>Disculpe...</h1>
		    <p><?php _e('Disculpe, no hay contenidos para mostrar'); ?></p>
		  </article>
		<?php endif; ?>
	</div>
</main>
<?php get_footer(); ?>