<?php
/**
 * The template for displaying all single service post
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package NewCo_Helsinki
 */

get_header();
?>



 <!-- Header image with horizontal swirl -->
 <div class="container">
            <img class="wideImage" src="<?php the_field( 'header_image' ); ?>" alt="Placeholder">
            <div class="wavemotif-loader waveEngel wavePerusUpsidedown"></div>
            <div class="pageTitleText">
                <h1><?php the_title(); ?></h1>
                <p><?php echo get_bloginfo('title'); ?> &#187; <?php $cat = get_the_category(); echo $cat[0]->cat_name; ?> &#187; <?php the_title(); ?></p>
            </div>
        </div>
<?php if ( have_rows( 'single_service_page_content' ) ): ?>
	<?php while ( have_rows( 'single_service_page_content' ) ) : the_row(); ?>
		<?php if ( get_row_layout() == 'heading_text_layout' ) : ?>
		<!-- Yritysinfo ajanvaraus section -->
        <div class="contentText">
        <?php if ( $title = get_sub_field('title') ): ?>
	<h1><?php echo $title; ?></h1>
<?php endif; ?>
<?php if ( $description = get_sub_field('description') ): ?>
	<p><?php echo $description; ?></p>
<?php endif; ?>
            <br>

            <?php
                    $link = get_sub_field('link_for_more');
                    if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self'; ?>
    <div class="seeAllButton">
	<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
    </div>
<?php endif; ?>

        </div>



		<?php elseif ( get_row_layout() == 'timetable_container' ) : ?>
<div class="wavemotif-loader waveUIGREY waveVarina"></div>

    <div class="timestableContainer">
    <?php if ( $title = get_sub_field('title') ): ?>
        <h4><?php echo $title; ?></h4>
    <?php endif; ?>
        <div class="timestable">

            <div class="imgContainer">
                <img src="<?php the_sub_field('image'); ?>" alt="placeholder" width="80%">
            </div>

            <div class="timesContainer">
            <?php if ( $time = get_sub_field('time') ): ?>
                <h4><?php echo $time; ?></h4>
            <?php endif; ?>
            <?php if ( $description = get_sub_field('description') ): ?>
                <p><?php echo $description; ?></p>
            <?php endif; ?>
                <br>
                <?php if ( $time = get_sub_field('time2') ): ?>
                    <h4><?php echo $time; ?></h4>
                <?php endif; ?>
                <?php if ( $description = get_sub_field('description2') ): ?>
                    <p><?php echo $description; ?></p>
                <?php endif; ?>
            </div>
        </div>
    </div>
<div class="wavemotif-loader waveUIGREY waveVarina Upsidedown"></div>





		<?php elseif ( get_row_layout() == 'yritysinfon' ) : ?>
		
            <div class="infonJälkeen">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h3><?php echo $title; ?></h3>
            <?php endif; ?>

            <?php if ( $description = get_sub_field('description') ): ?>
                <p><?php echo $description; ?></p>
            <?php endif; ?>
        </div>




		<?php elseif ( get_row_layout() == 'wide_image_with_text_box_on_the_left' ) : ?>
            <div class="container">
            <!-- Wide image with Text box on the left -->
            <img class="wideImage" src="<?php the_sub_field('image'); ?>" alt="Placeholder">
            <div class="overlayImageLeft">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h1><?php echo $title; ?></h1>
            <?php endif; ?>
            <?php if ( $description = get_sub_field('description') ): ?>
                <p><?php echo $description; ?></p>
            <?php endif; ?>

            <?php
                $link = get_sub_field('link__button');
                if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
    <div class="seeAllButton">                    
	<a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
    </div>
<?php endif; ?>


                
            </div>
        </div>



		<?php elseif ( get_row_layout() == 'starting_a_company_info' ) : ?>
        <div class="englishSection">
        <?php if ( $title = get_sub_field('title') ): ?>
            <h3><?php echo $title; ?></h3>
            <br>
        <?php endif; ?>
			<?php if ( have_rows( 'add_language_content' ) ): ?>
				<?php while ( have_rows( 'add_language_content' ) ) : the_row(); ?>
					<?php if ( get_row_layout() == 'languages' ) : ?>
						<?php if ( $title = get_sub_field('title') ): ?>
                            <h4><?php echo $title; ?></h4>
                        <?php endif; ?>
						<?php if ( $description = get_sub_field('description') ): ?>
                            <p><?php echo $description; ?></p>
                        <?php endif; ?>                        
						<?php if ( have_rows( 'links' ) ) : ?>
							<?php while ( have_rows( 'links' ) ) : the_row(); ?>

                            <?php
                            $link = get_sub_field('link');
                            if( $link ):
                                $link_url = $link['url'];
                                $link_title = $link['title'];
                                $link_target = $link['target'] ? $link['target'] : '_self';
                                ?>
<a class="dropbtn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?><img class="cardArrow" src="<?php echo get_stylesheet_directory_uri()?>/Icons/keyboard_arrow_right-24px.svg" alt="placeholder icon"></a>
<?php endif; ?>
<br>
							<?php endwhile; ?>
						<?php else : ?>
							<?php // no rows found ?>
						<?php endif; ?>
					<?php endif; ?>
                    <br>
            <br>
				<?php endwhile; ?>            
			<?php else: ?>            
				<?php // no layouts found ?>
			<?php endif; ?>
            
        </div>
		<?php endif; ?>
	<?php endwhile; ?>
<?php else: ?>
	<?php // no layouts found ?>
<?php endif; ?>



<?php
get_footer();