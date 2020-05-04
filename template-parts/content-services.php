        <!-- Header image with horizontal swirl -->
        <div class="container">
            <img class="wideImage" src="<?php the_field( 'header_image' ); ?>" alt="Placeholder">
            <div class="wavemotif-loader waveEngel wavePerusUpsidedown"></div>
            <div class="pageTitleText">
                <h1><?php the_title(); ?></h1>
                <p><?php echo get_bloginfo('title'); ?> &#187; <?php the_title(); ?></p>
            </div>
        </div>
<?php if ( have_rows( 'services_page_content' ) ): ?>
	<?php while ( have_rows( 'services_page_content' ) ) : the_row(); ?>
    <div class="contentText">
		<?php if ( get_row_layout() == 'content_cards' ) : ?>
			<h1><?php the_sub_field( 'title' ); ?></h1>
			<p><?php the_sub_field( 'description' ); ?></p>
            <br>
			<p class="palvelut-headline"><?php the_sub_field( 'filter_services_text' ); ?></p>

    </div>
		<?php elseif ( get_row_layout() == 'text_box_with_image_on_left' ) : ?>
        <div class="container">
        <img class="wideImage" src="<?php the_sub_field( 'image' ); ?>" alt="Placeholder">
            <div class="overlayImageRight">
			<h1><?php the_sub_field( 'title' ); ?></h1>
			<p><?php the_sub_field( 'description' ); ?></p>
            <div class="eventsButton"><?php
                                    $link = get_sub_field('read_more_link');
                                    if( $link ):
                                        $link_url = $link['url'];
                                        $link_title = $link['title'];
                                        $link_target = $link['target'] ? $link['target'] : '_self';
                                        ?>
                                        <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                    <?php endif; ?></div>
            </div>
        </div>
		<?php endif; ?>
	<?php endwhile; ?>
<?php else: ?>
	<?php // no layouts found ?>
<?php endif; ?>

</div>

<div class="container" style="height: auto">
    <div class="palvelurajaus">
        <?php
            if (have_rows('services_page_content')) {
                while ( have_rows( 'services_page_content' ) ) {
                    the_row();
                    if ( get_row_layout() == 'content_cards' ) {
                        $serviceCats = get_sub_field("filter");
                        foreach($serviceCats as $serviceCat) {
                            echo "<a class='palvelu-filter' href='javascript:void(0)' data-filter='" . $serviceCat->slug . "'>" . ucwords($serviceCat->name) . "</a>";
                        }
                    }
                }
            };
        ?>
    </div>
</div>

<div class="container">
    <div class="contentCards">
        
    </div>
</div>

<div style="margin-bottom: 100px;"></div>

<style type="text/css">
    .palvelu-filter-selected {
        background: var(--Bussi);
        color: white;
    }
</style>

<script type="text/javascript">
    function getFilteredServices(categoryName = '') {
        var request = new XMLHttpRequest();

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == "") {
                    document.querySelector(".contentCards").innerHTML = "There is not any services under that category :(";
                }else{
                    document.querySelector(".contentCards").innerHTML = this.responseText;
                }
            }else if(this.status == 404 || this.status == 400) {
                document.querySelector(".contentCards").innerHTML = "There was an error...";
            }else{
                document.querySelector(".contentCards").innerHTML = "Loading services...";
            }
        }

        request.open("POST", '<?php echo get_site_url() . "/wp-admin/admin-ajax.php"; ?>', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
        request.send("action=getFilteredServices&categoryName=" + categoryName);
    }

    function unselectAllFilterButtons() {
        document.querySelectorAll(".palvelu-filter").forEach(filterButton => {
            filterButton.classList.remove("palvelu-filter-selected");
        });
    }

    document.querySelectorAll(".palvelu-filter").forEach(filterButton => {
        filterButton.onclick = function() {
        	if (filterButton.classList.contains("palvelu-filter-selected")) {
        		getFilteredServices();
        		unselectAllFilterButtons();
            	filterButton.classList.remove("palvelu-filter-selected");
        	}else{
        		getFilteredServices(filterButton.dataset.filter);
        		unselectAllFilterButtons();
            	filterButton.classList.add("palvelu-filter-selected");
        	}
        }
    });

    getFilteredServices();
</script>
