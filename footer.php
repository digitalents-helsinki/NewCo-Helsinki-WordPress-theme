<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NewCo_Helsinki
 */

?>





<?php wp_footer(); ?>
<div style="bottom: 0px;" class="wavemotif-loader waveUIGREY wavePerus"></div>
        <div class="mapcontainer">
            <div class="mapTextOverlay">
                <h2>Miten löydät perille</h2>
                <p>ewrhenvwerv wneru ehkrfbwejhrf eb erihw ei</p>
                <h4>Liikenneyhteydet</h4>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. </p>
                <p>Aspernatur fugit odio dolor reiciendis, consectetur cumque in minus ea velit</p>
                <p>esse ratione non possimus vitae eligendi numquam culpa repellendus libero quo.</p>
            </div>
            <div class="map">
                <<iframe width="auto" height="auto" frameborder="0" style="border:0"
src="https://www.google.com/maps/embed/v1/place?q=place_id:ChIJn5Tf-c0LkkYRpLgZa2E7IbE&key=..." allowfullscreen></iframe>
            </div>
        </div>
<!-- footer -->

<footer class="footer">
            <div class="wavemotif-loader waveKupari wavePerus"></div>
            <div class="footerText">
                <div class="footerbox">
                    <img class="helsinkiLogoFooter" src="<?php the_field('logo', 'options'); ?>" alt="HelsinkiLogo">
					<?php if ( $company_name = get_field('company_name', 'options') ): ?>
						<p class="bold"><?php echo $company_name; ?></p>
					<?php endif; ?>
					<?php if ( $description = get_field('description', 'options') ): ?>
						<span><?php echo $description; ?></span>
					<?php endif; ?>
				</div>				



<!------ menu u footeru ---->
			<?php
				$menuObject = wp_get_nav_menu_object('footer-menu-1');
				if (get_field("footer_menu", $menuObject) !== null) {
					$footerMenu = get_field("footer_menu", $menuObject);
					foreach ($footerMenu as $menu) {
						echo "<div class='footerBox'>";
						echo "<h4>" . $menu['section_title'] . "</h4>";

						foreach ($menu['links'] as $link) {
							//var_dump($link['link']);
							echo "<span><a style='font-size: 0.9rem' href='" . $link['link']['url'] . "'>" . $link['link']['title'] . "</a></span><br />";
						}

						echo "</div>";
					}
				}
			?>
        
                <div class="footerBox">
                    <h4>Seuraa meitä</h4>
                    <img class="svgIcon" src="<?php echo get_template_directory_uri(); ?>/Icons/facebook.svg" alt="Facebook Icon">
                    <!-- Credit for facebook.svg to "FreePik" -->
                    <img class="svgIcon" src="<?php echo get_template_directory_uri(); ?>/Icons/instagram.svg" alt="instagram Icon">
                    <!-- Credit for instagram.svg to "FreePik" -->
                    <img class="svgIcon" src="<?php echo get_template_directory_uri(); ?>/Icons/twitter.svg" alt="twitter Icon">
                    <!-- Credit for twitter.svg to "FreePik" -->
                </div>
            </div>
            <hr>
            <div class="copyRight">
			<?php if ( $copyright = get_field('copyright', 'options') ): ?>
				<?php echo $copyright; ?>
			<?php endif; ?>
                <?php
				$link = get_field('sivuston_kayttoehdot', 'options');
				if( $link ):
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<a href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>
				<?php
				$link = get_field('anna_palautetta', 'options');
				if( $link ):
					$link_url = $link['url'];
					$link_title = $link['title'];
					$link_target = $link['target'] ? $link['target'] : '_self';
					?>
					<a style="float:right" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
				<?php endif; ?>                
            </div>
    </div>

    </footer>
	</div><!-- #page -->
	</div> <!----end of wrapper -->

</body>
</html>
