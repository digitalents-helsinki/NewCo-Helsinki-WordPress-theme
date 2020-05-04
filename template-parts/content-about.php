<!-- Header image with no underlying picture -->
    <div class="container no-header-image">
        <div class="wavemotif-loader waveSuomenlinna wavePerusUpsidedown"></div>
        <div class="pageTitleText">
            <h1><?php the_title(); ?></h1>
            <p><?php echo get_bloginfo('title'); ?> &#187; <?php the_title(); ?></p>
        </div>
    </div>
<?php if ( have_rows( 'about_us_content' ) ): ?>
	<?php while ( have_rows( 'about_us_content' ) ) : the_row(); ?>
		<?php if ( get_row_layout() == 'heading_text_layout' ) : ?>
            <div class="contentText">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h1><?php echo esc_html($title); ?></h1>
            <?php endif; ?>
            <?php if ( $description = get_sub_field('description') ): ?>
                <p style="text-align: center;"><?php echo esc_html($description); ?></p>
            <?php endif; ?>
        </div>
		<?php elseif ( get_row_layout() == 'stuff_layout' ) : ?>
        <div class="wavemotif-loader waveUIGREY waveSyke"></div>
        <div>
        <h4 class="dividerTitle"><?php the_sub_field( 'title' ); ?></div>
        <div class="personelMain">
			<?php if ( have_rows( 'personnel_main' ) ) : ?>
                
				<?php while ( have_rows( 'personnel_main' ) ) : the_row(); ?>
                <div class="personel">
					<?php if ( get_sub_field( 'image' ) ) { ?>
						<img class="profilePicture" src="<?php the_sub_field( 'image' ); ?>" />
					<?php } ?>
                    <div class="personelText">
                    <ul class="personelInfo">
                        <?php if ( $fist_name_surname = get_sub_field('fist_name_surname') ): ?>
                            <li class="name"><?php echo esc_html($fist_name_surname); ?></li>
                        <?php endif; ?>
                        <?php if ( $title = get_sub_field('title') ): ?>
                            <li><?php echo esc_html($title); ?></li>
                        <?php endif; ?>
                        <?php if ( $phone_number = get_sub_field('phone_number') ): ?>
                            <li><?php echo esc_html($phone_number); ?></li>
                        <?php endif; ?>
                        <?php if ( $email = get_sub_field('email') ): ?>
                            <li><a class="inline" href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></li>
                        <?php endif; ?>
                    </ul>
                    </div>
                </div>
				<?php endwhile; ?>                
			<?php else : ?>
				<?php // no rows found ?>
			<?php endif; ?>            
            </div>
            <div class="wavemotif-loader waveUIGREY waveSykeUpsidedown"></div>
		<?php endif; ?>
	<?php endwhile; ?>    
<?php else: ?>
	<?php // no layouts found ?>
<?php endif; ?>






