<!-- Header image with upsidedown wave -->
<div class="container">
    <img class="wideImage" src="<?php echo esc_url(get_field('header_image')); ?>" alt="Placeholder">
    <div class="wavemotif-loader waveKupari wavePerusUpsidedown"></div>
    <div class="pageTitleText">
        <h1><?php the_title(); ?></h1>
        <p><?php echo get_bloginfo('title'); ?> &#187; <?php the_title(); ?></p>
    </div>
</div>
<?php if ( have_rows( 'tietoa_meista_content' ) ): ?>
	<?php while ( have_rows( 'tietoa_meista_content' ) ) : the_row(); ?>
		<?php if ( get_row_layout() == 'heading_text_&_buttons' ) : ?>
        <div class="contentText">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h1><?php echo esc_html($title); ?></h1>
            <?php endif; ?>
			<?php if ( $description = get_sub_field('description') ): ?>
                <p><?php echo esc_html($description); ?></p>
            <?php endif; ?>
			<?php if ( have_rows( 'buttons' ) ) : ?>
				<?php while ( have_rows( 'buttons' ) ) : the_row(); ?>
                <div class="filterButtons">
					<?php $link = get_sub_field( 'link' ); ?>
					<?php if ( $link ) { ?>
						<span class="filterButton"><a href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?></a></span>
					<?php } ?>                
				<?php endwhile; ?>
                </div>
                
			<?php else : ?>
				<?php // no rows found ?>
                
			<?php endif; ?>
            </div>
            </div>
		<?php elseif ( get_row_layout() == 'statistics_box' ) : ?>
        <div class="wavemotif-loader waveUIGREY waveTyrsky"></div>
        <div class="statisticbox">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h4 class="statisticTitle"><?php echo esc_html($title); ?></h4>
            <?php endif; ?>
            <div class="Statistics">
			<?php if ( have_rows( 'statistics' ) ) : ?>
            
				<?php while ( have_rows( 'statistics' ) ) : the_row(); ?>
                <div class="statistic">
                <?php if ( $number = get_sub_field('number') ): ?>
                    <h3><?php echo esc_html($number); ?></h3>
                <?php endif; ?>
                <?php if ( $text = get_sub_field('text') ): ?>
                    <p><?php echo esc_html($text); ?></p>
                <?php endif; ?>
                </div>
				<?php endwhile; ?>
                
			<?php else : ?>
				<?php // no rows found ?>
			<?php endif; ?>
            </div>
        </div>
        <div class="wavemotif-loader waveUIGREY waveTyrsky Upsidedown"></div>
        <?php elseif ( get_row_layout() == 'quote_carousel' ) : ?>
        <div class="quoteCarousel">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h3><?php echo esc_html($title); ?></h3>
            <?php endif; ?>
            <div class="slider">
                <?php if ( have_rows( 'quote_carousel_message' ) ) : ?>
                    <?php while ( have_rows( 'quote_carousel_message' ) ) : the_row(); ?>
                    <div class="quoteMessage">
                        <?php the_sub_field( 'message' ); ?>
                    </div> 
                    <?php endwhile; ?>
            </div>
			<?php else : ?>
				<?php // no rows found ?>
            <?php endif; ?>
        </div>
        <?php elseif ( get_row_layout() == 'news' ) : ?>
        <div class="wavemotif-loader waveUIGREY waveSyke"></div>
        <div class="newsContainer">
            <?php if ( $news_section_title = get_sub_field('news_section_title') ): ?>
                <h4 class="guideTitle"><?php echo esc_html($news_section_title); ?></h4>
            <?php endif; ?>
            
            <h5>load recent news here</h5>


            
            <?php
            $link = get_sub_field('link_to_all_news');
            if( $link ):
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?><div class="seeAllButton">
                <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                </div><?php endif; ?>
        </div>
        <div class="wavemotif-loader waveUIGREY waveSykeUpsidedown"></div>
		<?php elseif ( get_row_layout() == 'text_box_with_square_image_right' ) : ?>
            <div class="container">
            <img class="squareImageRight" src="<?php echo esc_url(get_sub_field('image')); ?>"
                alt="Placeholder">
            <div class="overlayImageLeft">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h1><?php echo esc_html($title); ?></h1>
            <?php endif; ?>
            <?php if ( $description = get_sub_field('description') ): ?>
                <p><?php echo esc_html($description); ?></p>
            <?php endif; ?>
            <?php
                $link = get_sub_field('link');
                if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?><div class="eventsButton">
                    <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    </div><?php endif; ?>                 
            </div>
        </div>

		<?php elseif ( get_row_layout() == 'wide_image_with_text_box_on_the_right' ) : ?>
        <!-- Wide image with Text box on the right -->
        <div class="container">
            <img class="wideImage" src="<?php echo esc_url(get_sub_field('image')); ?>" alt="Placeholder">
            <div class="overlayImageRight">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h1><?php echo esc_html($title); ?></h1>
            <?php endif; ?>
            <?php if ( $description = get_sub_field('description') ): ?>
                <p><?php echo esc_html($description); ?></p>
            <?php endif; ?>
            <?php
            $link = get_sub_field('link');
            if( $link ):
                $link_url = $link['url'];
                $link_title = $link['title'];
                $link_target = $link['target'] ? $link['target'] : '_self';
                ?><div class="eventsButton">
                <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                </div><?php endif; ?>
            </div>
        </div>		
		<?php endif; ?>
	<?php endwhile; ?>
<?php else: ?>
	<?php // no layouts found ?>
<?php endif; ?>

