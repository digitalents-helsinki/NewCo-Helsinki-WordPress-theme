<!-- single news post -->
<script type="text/javascript">
    function getFilteredNews(categoryName = '', newsOffset = 0) {
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

        //OVDE MENJAS BROJ VESTI KOJI SE PRIKAZUJU
        request.send("action=getFilteredNews&categoryName=" + categoryName + "&newsOffset=" + newsOffset + "&newsLimit=4&loadMoreButton=no&postId=" + <?php the_ID() ?>);
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
                    getFilteredNews('', document.querySelector("#loadMoreNews").dataset.offset);
                }
            }
        }
    }
    checkIfLoadMoreButtonIsLoaded();

</script>

<div class="container">
            <img class="wideImage" src="Images/49531010-48dad180-f8b1-11e8-8d89-1e61320e1d82.png" alt="Placeholder">
            <div class="wavemotif-loader waveKupari wavePerusUpsidedown"></div>
            <div class="pageTitleText">
                <h1><?php the_title(); ?></h1>
                <p><?php echo get_bloginfo('title'); ?> &#187; <?php $cat = get_the_category(); echo $cat[0]->cat_name; ?> &#187; <?php the_title(); ?></p>
            </div>
        </div>



<?php if ( have_rows( 'singular_news_article_content' ) ): ?>
	<?php while ( have_rows( 'singular_news_article_content' ) ) : the_row(); ?>
		<?php if ( get_row_layout() == 'top_content_text' ) : ?>
        <!-- Singular News Article -->
        <h4 class="dividerDate"><?php echo get_the_date( 'd.m.Y' ); ?></h4>
            <div class="contentText">
                <?php if ( $title = get_sub_field('title') ): ?>
                    <h2><?php echo $title; ?></h2>
                    <?php endif; ?>
                <?php if ( $description = get_sub_field('description') ): ?>
                    <p><?php echo $description; ?></p>
                    <?php endif; ?>                
            </div>			
		<?php elseif ( get_row_layout() == 'content_news' ) : ?>
            <div class="contentNews">
            <img class="newsImg" src="<?php the_sub_field('news_image'); ?>" />
            <div class="innerContentNews">
                <?php if ( $title = get_sub_field('title') ): ?>
                    <h3><?php echo $title; ?></h3>
                <?php endif; ?>
                <?php if ( $text_content = get_sub_field('text_content') ): ?>
                    <p><?php echo $text_content; ?></p>
                <?php endif; ?>
                

                <?php if ( have_rows( 'link' ) ) : ?>
				<?php while ( have_rows( 'link' ) ) : the_row(); ?>
					<?php $link = get_sub_field( 'link' ); ?>
					<?php if ( $link ) { ?>
						<p><a class="inline" style="text-decoration: none;" href="<?php echo $link['url']; ?>" target="<?php echo $link['target']; ?>"><?php echo $link['title']; ?> <img class="cardArrow" src="<?php echo get_stylesheet_directory_uri()?>/Icons/keyboard_arrow_right-24px.svg" alt="placeholder icon"></a> </p>
					<?php } ?>
				<?php endwhile; ?>
			<?php else : ?>
				<?php // no rows found ?>
			<?php endif; ?>





                <h5>Jaa uutinen</h5>
                <p>load facebook and a twitter button</p>
            </div>
        </div>


		<?php endif; ?>
	<?php endwhile; ?>
<?php else: ?>
	<?php // no layouts found ?>
<?php endif; ?>
        <div class="wavemotif-loader waveUIGREY waveSyke"></div>

        <div>
            <h4 class="guideTitle"><?php if ( $lisaa_uutisa_section_text = get_field('lisaa_uutisa_section_text') ): ?>
                                        <?php echo $lisaa_uutisa_section_text; ?>
                                    <?php endif; ?></h4>
            
            <div class="mNewsMain">
                <div class="newsCards">
                    <script type="text/javascript">
                        getFilteredNews(<?php echo "'" . get_the_terms(get_the_ID(), 'news_categories')[0]->name . "'"; ?>);
                    </script>
                    <?php
                        /*$news = get_posts(array(
                            'post_type' => 'news',
                            'posts_per_page' => 12,
                            "numberposts" => 12
                        ));

                        foreach ($news as $article) {
                            echo "<div class='News'>";
                                echo "<img class='newsPhoto' src='" . get_the_post_thumbnail_url($article->ID) . "' alt='placeholder icon' class='object-fit: cover'>";
                                echo "<div class='newsText'>";
                                    echo "<p>" . get_the_date('d.m.Y', $article->ID) . "</p>";
                                    echo "<h4>" . $article->post_title . "</h4>";
                                    echo "<p>" . wp_trim_words($article->post_content, 20) . "</p>";
                                    echo "<div class='readMore'>";
                                        echo "<a href='" . get_the_permalink($article->ID) . "' class='dropbtn'>Lue lisää";
                                            echo "<img class="cardArrow" src="<?php echo get_stylesheet_directory_uri()?>/Icons/keyboard_arrow_right-24px.svg" alt="placeholder icon">";
                                        echo "</a>";
                                echo " </div>";
                            echo " </div>";
                            echo "</div>";
                        }

                        if ($news->found_posts >= 12) {
                            echo "<a href='#'>1VIEW MORE</a>";
                        }*/
                    ?>
                </div>
                <!--- Link to news pages --->
                <?php
                $link = get_field('linkki_uutiset_sivulle');
                if( $link ):
                    $link_url = $link['url'];
                    $link_title = $link['title'];
                    $link_target = $link['target'] ? $link['target'] : '_self';
                    ?>
                    <div class="mNewsCenter">
                                    <div class="Button">
                    <a class="button" href="<?php echo esc_url( $link_url ); ?>" target="<?php echo esc_attr( $link_target ); ?>"><?php echo esc_html( $link_title ); ?></a>
                    </div>
                </div><?php endif; ?>
            </div>
        </div>
        <div class="wavemotif-loader waveUIGREY waveSykeUpsidedown"></div>
    