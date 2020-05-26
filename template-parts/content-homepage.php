
<?php if ( have_rows( 'front_page_content' ) ): ?>
	<?php while ( have_rows( 'front_page_content' ) ) : the_row(); ?>
		<?php if ( get_row_layout() == 'header_image_with_diagonal_swirl' ) : ?>
            <div class="container">
            <img class="wideImage" src="<?php the_sub_field('image_background'); ?>" alt="Placeholder">
            <img src="<?php echo get_stylesheet_directory_uri()?>/Images/Blue overlay.png" class="diagonal-overlay">
            <div style="bottom: 0px;" class="diagonal-overlay-mobile wavemotif-loader waveKupari wavePerus"></div>
                <div class="HeaderText">
                    <?php if ( $title = get_sub_field('title') ): ?>
                        <h1><?php echo $title; ?></h1>
                    <?php endif; ?>
                    <?php if ( $description = get_sub_field('description') ): ?>
                        <p><?php echo $description; ?></p>
                    <?php endif; ?>                    
                </div>
            </div>
			<?php // warning: layout 'header_image_with_diagonal_swirl' has no sub fields ?>
		<?php elseif ( get_row_layout() == 'content_cards' ) : ?>
    <div class="contentText">
        <?php if ( $title = get_sub_field('title') ): ?>
            <h1><?php echo $title; ?></h1>
        <?php endif; ?>
        <?php if ( $description = get_sub_field('description') ): ?>
        <p><?php echo $description; ?></p>
        <?php endif; ?>
    </div>
    <?php if ( have_rows( 'single_card' ) ): ?>
        <div class="contentCards">
			<?php while ( have_rows( 'single_card' ) ) : the_row(); ?>
					<?php if ( get_row_layout() == 'card_layout' ) : ?>
                        <div class="Card">
                        <img class="cardIcon" src="<?php the_sub_field('card_icon'); ?>" alt="placeholder icon">
                        <?php if ( $card_title = get_sub_field('card_title') ): ?>
                            <p><?php echo $card_title; ?></p>
                        <?php endif; ?>
                        <hr>
                        <?php if ( $card_description = get_sub_field('card_description') ): ?>
                            <p><?php echo $card_description; ?></p>
                        <?php endif; ?>
                        <div class="readMore">
                        <?php
                            $link = get_sub_field('card_read_more_link');
                            if( $link ):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <a class="dropbtn" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?>
                            <img class="cardArrow" src="<?php echo get_stylesheet_directory_uri()?>/Icons/keyboard_arrow_right-24px.svg" alt="placeholder icon"></a>
                        <?php endif; ?>                      
                        </div>
                        </div>
					
					<?php endif; ?>
			<?php endwhile; ?>
        </div>
	<?php else: ?>
				<?php // no layouts found ?>
	<?php endif; ?>
    
    <div class="seeAllButton">
    <?php
        $link = get_sub_field('all_services_link');
        if( $link ):
            $link_url = $link['url'];
            $link_title = $link['title'];
            $link_target = $link['target'] ? $link['target'] : '_self';
            ?>
            <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
    <?php endif; ?>
    </div>
    <!--- end of section !-->
			<?php // warning: layout 'content_cards' has no sub fields ?>
		<?php elseif ( get_row_layout() == 'wide_image_with_text_box_on_the_right' ) : ?>
            <!-- Wide image with Text box on the right -->
            <div class="container">
                <img class="wideImage" src="<?php the_sub_field('background'); ?>" alt="Placeholder">
                <div class="overlayImageRight">
                    <?php if ( $title = get_sub_field('title') ): ?>
                        <h1><?php echo $title; ?></h1>
                    <?php endif; ?>
                    <?php if ( $description = get_sub_field('description') ): ?>
                        <p><?php echo $description; ?></p>
                    <?php endif; ?>
                    <div class="eventsButton"><?php
                        $link = get_sub_field('link_for_more');
                        if( $link ):
                            $link_url = $link['url'];
                            $link_title = $link['title'];
                            $link_target = $link['target'] ? $link['target'] : '_self';
                            ?>
                            <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
			<?php // warning: layout 'wide_image_with_text_box_on_the_right' has no sub fields ?>
		<?php elseif ( get_row_layout() == 'square_image_with_text_box_on_the_left' ) : ?>
        <!-- Square image with Text box on the left -->
        <div class="container">
            <img class="squareImageRight" src="<?php the_sub_field('background'); ?>" alt="Placeholder">
            <div class="overlayImageLeft">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h1><?php echo $title; ?></h1>
            <?php endif; ?>
            <?php if ( $description = get_sub_field('description') ): ?>
                <p><?php echo $description; ?></p>
            <?php endif; ?>
                <div class="eventsButton"><?php
                    $link = get_sub_field('link_for_more');
                    if( $link ):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
			<?php // warning: layout 'square_image_with_text_box_on_the_left' has no sub fields ?>

<?php elseif ( get_row_layout() == 'quote_carousel' ) : ?>
    <div class="quoteCarousel">
        <blockquote>
            <header><?php the_sub_field( 'quote_carousel_title' ); ?></header>
                <?php if ( have_rows( 'quote_carousel' ) ): ?>
                <div class="slider">
                    <?php while ( have_rows( 'quote_carousel' ) ) : the_row(); ?>
                        <?php if ( get_row_layout() == 'quote_carousel_layout' ) : ?>
                            <?php if ( $quote_text = get_sub_field('quote_text') ): ?>
                            <div>
                                        <p><?php echo $quote_text; ?></p>
                                    <?php endif; ?>
                                    <footer>
                                    <?php if ( $author_name = get_sub_field('author_name') ): ?>
                                        <cite><?php echo $author_name; ?></cite>
                                    <?php endif; ?>
                                    <?php if ( $authors_title = get_sub_field('authors_title') ): ?>
                                        <span><?php echo $authors_title; ?></span>
                                    <?php endif; ?>
                                    </footer>
                                    <img class="quoteImage" src="<?php the_sub_field('author_image'); ?>" alt="">
                            </div>                       
                        <?php endif; ?>                    
                    <?php endwhile; ?>
                </div>               
        </blockquote>
    </div>
			<?php else: ?>
				<?php // no layouts found ?>
			<?php endif; ?>



		<?php elseif ( get_row_layout() == 'email_subscriptionbox' ) : ?>
        <!-- Email subscriptionBox -->
        <div class="emailSubscription">
            <img class="squareImage60" src="Images/49531010-48dad180-f8b1-11e8-8d89-1e61320e1d82.png" alt="Placeholder">
            <div class="subscriptionBox">
                <h3>Tilaa uutiskirje</h3>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Debitis excepturi odit mollitia, aperiam,
                    expedita voluptatum hic sequi magnam reprehenderit eius nesciunt deserunt ab? Sit laboriosam a sint
                    quis qui sequi.</p>
                <p class="bold">Sähköpostiosoite</p>
                <form action="Submit">
                    <input type="text" name="email" id="emailInput">
                    <br>
                    <input name="_mc4wp_lists[]" type="checkbox" value="1324f6d5f6"> Yksinyrittäjät tiedotus englanti
                    <br>
                    <input name="_mc4wp_lists[]" type="checkbox" value="2b99f78ec3"> Maahanmuuttajat
                    <input type="submit" value="Subscribe"<div class="eventsButton"></div>
                </form>
            </div>
      
        
			<?php // warning: layout 'email_subscriptionbox' has no sub fields ?>
		<?php elseif ( get_row_layout() == 'square_image_with_text_box_on_the_right' ) : ?>
            <!-- Square image with Text box on the right-->
    <div class="container">
        <img class="squareImageLeft" src="<?php the_sub_field('background_image'); ?>" alt="Placeholder">
        <div class="overlayImageRight" style="background-color:<?php the_sub_field('text_background_color'); ?>;">
        <?php if ( $title = get_sub_field('title') ): ?>
            <h1><?php echo $title; ?></h1>
        <?php endif; ?>
        <?php if ( $description = get_sub_field('description') ): ?>
            <p><?php echo $description; ?></p>
        <?php endif; ?>
            <div class="eventsButton" style="background-color:<?php the_sub_field('button_background_color'); ?>"><?php
                                        $link = get_sub_field('link_for_more');
                                        if( $link ):
                                            $link_url = $link['url'];
                                            $link_title = $link['title'];
                                            $link_target = $link['target'] ? $link['target'] : '_self';
                                            ?>
                                            <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                        <?php endif; ?>
                                        </div>
        </div>
    </div>
			<?php // warning: layout 'square_image_with_text_box_on_the_right' has no sub fields ?>
		<?php elseif ( get_row_layout() == 'wide_image_with_text_box_on_the_left' ) : ?>
            <!-- Wide image with Text box on the left -->
    <div class="container">
        <img class="wideImage" src="<?php the_sub_field('background_image'); ?>" alt="Placeholder">
        <div class="overlayImageLeft" style="background-color:<?php the_sub_field('description_background_color'); ?>;">
        <?php if ( $title = get_sub_field('title') ): ?>
            <h1><?php echo $title; ?></h1>
        <?php endif; ?>
        <?php if ( $description = get_sub_field('description') ): ?>
            <p><?php echo $description; ?></p>
        <?php endif; ?>
            <div class="eventsButton" style="background-color:<?php the_sub_field('button_background'); ?>;"><?php
                    $link = get_sub_field('link_for_more');
                    if( $link ):
                        $link_url = $link['url'];
                        $link_title = $link['title'];
                        $link_target = $link['target'] ? $link['target'] : '_self';
                        ?>
                        <a style="background-color:<?php the_sub_field('link_color'); ?>;" class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    <?php endif; ?>
                    </div>
        </div>
    </div>
			<?php // warning: layout 'wide_image_with_text_box_on_the_left' has no sub fields ?>
		<?php elseif ( get_row_layout() == 'map' ) : ?>
            <!-- map -->
    <div style="bottom: 0px;" class="wavemotif-loader waveUIGREY wavePerus"></div>
    <div class="mapcontainer">
        <div class="mapTextOverlay">
        <?php if ( $title = get_sub_field('title') ): ?>
            <h2><?php echo $title; ?></h2>
        <?php endif; ?>
        <?php if ( $description = get_sub_field('description') ): ?>
            <p><?php echo $description; ?></p>
        <?php endif; ?>
        </div>
        <div class="map">
        <?php $map = get_sub_field( 'map' ); ?>
			<?php if ( $map ) { ?>
				<?php echo $map['address']; ?>
				<?php echo $map['lat']; ?>
				<?php echo $map['lng']; ?>
			<?php } ?>
        </div>
    </div>
			<?php // warning: layout 'map' has no sub fields ?>
		<?php endif; ?>
	<?php endwhile; ?>
<?php else: ?>
	<?php // no layouts found ?>
<?php endif; ?>
