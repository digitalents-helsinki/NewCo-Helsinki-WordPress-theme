<?php
/**
 * Template Name: News template
 */

get_header();
?>

<script type="text/javascript">
    var thisNewsCategory = '';
    function getFilteredNews(categoryName = '', newsOffset = 0) {
        console.log(categoryName);
        var request = new XMLHttpRequest();

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                if (this.responseText == "") {
                    if (!!document.querySelector("#loadMessage")) {
                        document.querySelector(".newsCards").removeChild(document.querySelector("#loadMessage"));
                    }
                    document.querySelector(".newsCards").innerHTML = "There is not any news under that category :(";
                }else{
                    if (!!document.querySelector("#loadMessage")) {
                        document.querySelector(".newsCards").removeChild(document.querySelector("#loadMessage"));
                    }
                    if (!!document.querySelector("#loadMoreNews")) {
                        document.querySelector(".newsCards").removeChild(document.querySelector("#loadMoreNews"));
                    }
                    document.querySelector(".newsCards").innerHTML += this.responseText;

                    if (this.responseText.includes("id='loadMoreNews'")) {
                        checkIfLoadMoreButtonIsLoaded();
                    }
                }
            }else if(this.status == 404 || this.status == 400) {
                if (!!document.querySelector("#loadMessage")) {
                    document.querySelector(".newsCards").removeChild(document.querySelector("#loadMessage"));
                }
                document.querySelector(".newsCards").innerHTML = "There was an error...";
            }else{
                if (!!document.querySelector("#loadMessage")) {
                    document.querySelector(".newsCards").removeChild(document.querySelector("#loadMessage"));
                }
                document.querySelector(".newsCards").innerHTML += "<p id='loadMessage'>Loading news...</p>";
            }
        }

        request.open("POST", '<?php echo get_site_url() . "/wp-admin/admin-ajax.php"; ?>', true);
        request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;');
        request.send("action=getFilteredNews&categoryName=" + categoryName + "&newsOffset=" + newsOffset);
    }

    function unselectAllFilterButtons() {
        document.querySelectorAll(".palvelu-filter").forEach(filterButton => {
            filterButton.classList.remove("palvelu-filter-selected");
        });
    }

    document.querySelectorAll(".palvelu-filter").forEach(filterButton => {
        filterButton.onclick = function() {
            document.querySelector('.newsCards').innerHTML = '';
            getFilteredNews(filterButton.dataset.filter);
            unselectAllFilterButtons();
            filterButton.classList.add("palvelu-filter-selected");
        }
    });

    function checkIfLoadMoreButtonIsLoaded() {
        if (!!!document.querySelector("#loadMoreNews")) {
            setTimeout(function() {
                checkIfLoadMoreButtonIsLoaded();
            }, 200);
        }else{
            document.querySelector("#loadMoreNews").onclick = function() {
                if (!!document.querySelector(".palvelu-filter-selected")) {
                    getFilteredNews(document.querySelector(".palvelu-filter-selected").dataset.filter, document.querySelector("#loadMoreNews").dataset.offset);
                }else{
                    getFilteredNews(thisNewsCategory, document.querySelector("#loadMoreNews").dataset.offset);
                }
            }
        }
    }
    checkIfLoadMoreButtonIsLoaded();
</script>

        <!-- Header image with upsidedown wave -->
        <div class="container">
            <img class="wideImage" src="<?php the_field( 'header_image' ); ?>" alt="Placeholder">
            <div class="wavemotif-loader waveKupari wavePerusUpsidedown"></div>
            <div class="pageTitleText">
                <h1><?php the_title(); ?></h1>
                <p><?php echo get_bloginfo('title'); ?> &#187; <?php the_title(); ?></p>
            </div>
        </div>

<?php if ( have_rows( 'news_page_content' ) ): ?>
	<?php while ( have_rows( 'news_page_content' ) ) : the_row(); ?>
		<?php if ( get_row_layout() == 'top_page_text' ) : ?>
        <!-- Content Cards -->
        <div class="contentText">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h1><?php echo $title; ?></h1>
            <?php endif; ?>
            <?php if ( $description = get_sub_field('description') ): ?>
                <p><?php echo $description; ?></p>
            <?php endif; ?>
        </div>
		<?php elseif ( get_row_layout() == 'news_cards' ) : ?>
			

            
            <div style="background: yellow; margin: 50px;" class="newsCards">
                <script type="text/javascript">
                    <?php 
                    $news = get_sub_field("load_news_from_category");

                    foreach ($news as $newsCat) {
                        ?>
                            thisNewsCategory = <?php echo "'" . $newsCat->name . "'"; ?>;
                            getFilteredNews(thisNewsCategory);
                        <?php

                    }
                    ?>
                </script>
            </div>




		<?php elseif ( get_row_layout() == 'text_box_with_image_on_' ) : ?>
            <div class="container">
            <img class="squareImageRight" src="<?php the_sub_field('image'); ?>"
                alt="Placeholder">
            <div class="overlayImageLeft">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h1><?php echo $title; ?></h1>
            <?php endif; ?>
            <?php if ( $text_area = get_sub_field('text_area') ): ?>
                <p><?php echo $text_area; ?></p>
            <?php endif; ?>
                <div class="eventsButton"><?php
                                            $link = get_sub_field('link');
                                            if( $link ):
                                                $link_url = $link['url'];
                                                $link_title = $link['title'];
                                                $link_target = $link['target'] ? $link['target'] : '_self';
                                                ?>
                                                <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                                            <?php endif; ?></div>
            </div>
        </div>
		<?php elseif ( get_row_layout() == 'wide_image_with_text_box_on_the_right' ) : ?>
		        <!-- Wide image with Text box on the right -->
                <div class="container">
            <img class="wideImage" src="<?php the_sub_field('image'); ?>" alt="Placeholder">
            <div class="overlayImageRight">
            <?php if ( $title = get_sub_field('title') ): ?>
                <h1><?php echo $title; ?></h1>
            <?php endif; ?>
            <?php if ( $text = get_sub_field('text') ): ?>
                <p><?php echo $text; ?></p>
            <?php endif; ?>
                <div class="eventsButton"><?php
$link = get_sub_field('link');
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
<?php
get_footer();