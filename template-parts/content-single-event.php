<div class="container no-header-image">
            <div class="wavemotif-loader waveUIGREY wavePerus Upsidedown"></div>
            <div class="pageTitleText">
                <h1><?php the_title(); ?></h1>
                <p><?php echo get_bloginfo('title'); ?> &#187; <?php $cat = get_the_category(); echo $cat[0]->cat_name; ?> &#187; <?php the_title(); ?></p>
            </div>
</div>
