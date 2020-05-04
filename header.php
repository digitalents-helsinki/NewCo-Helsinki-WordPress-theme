<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NewCo_Helsinki
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
<div class="wrapper">
	<header id="masthead" class="site-header">
		<div class="site-branding">
			<?php the_custom_logo(); ?>
			<a class="nav-title" href="<?php echo get_bloginfo('url'); ?>"><?php echo get_bloginfo('title'); ?></a>
		</div><!-- .site-branding -->
		<nav id="site-navigation" class="main-navigation">
			<!--  <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'newco_helsinki' ); ?></button> -->
	
	
			<?php
			wp_nav_menu( array(
				'theme_location' => 'top-menu',
				'menu_class'        => 'top-menu',
			) );
			?>
			


		</nav><!-- #site-navigation -->
		<div class="nav-srch-lang">
			<div class="srch">
				<a class="searchIconLink" href="javascript: void(0)">
					<img class="searchIcon" id="searchIcon" src="<?php echo get_template_directory_uri(); ?>/Icons/search-24px.svg" alt="search">
				</a>
				<div class="search_form">
					<?php get_search_form(); ?>
				</div>
			</div>
			<div class="langMenu">
				<?php
				/*wp_nav_menu( array(
					'theme_location' => 'language-menu',
					'menu_class'        => 'menu_languages',
					'container' => 'select'
				) );*/

				$languages = wp_get_nav_menu_items('Languages', array());
				echo '<div id="langSelect">';
				echo "<a href='javascript:void(0)'><span>EN</span> <img src='". get_template_directory_uri() . "/Icons/keyboard_arrow_down-24px.svg'></a>";
				echo '<div class="langOptions">';
				foreach ($languages as $language) {
					echo '<div class="option">';
					echo '<input type="radio" name="language" value="'.$language->title.'">';
					echo '<label for="'.$language->title.'">'.$language->title.'</label>';
					echo '</div>';
				}
				echo '</div></div>';

				?>	
			</div>
		</div>

		<a href="javascript:void(0)" class="mobileMenuIcon">
			<img src="<?php echo get_template_directory_uri(); ?>/Icons/bars-solid.svg">
		</a>
	</header><!-- #masthead -->

	<style>
		.site-header{
			display: flex;
			flex-direction: row;
		}

		.mobileMenuIcon {
			display: none;
		}

		.custom-logo{
			height: 50px;
			width:120px;
			margin: 5px;
		}

		.main-navigation < ul {
			margin: 0;
			padding: 0;
			list-style: none;
			position: absolute;
		}

		.menu_languages < ul {
			list-style: none;
		}

		.menu-languages-container {
			float: right;
		}

		.custom-logo-link img {
			vertical-align: middle;
		}

		#site-navigation {
			flex-grow: 1;
		}

		.site-branding {
			display: flex;
		}

		.site-branding .nav-title {
			margin: 15px 0px 0px 20px;
			font-weight: bold;
		}

		.site-branding a {
			display: inline-block;
		}

		.top-menu {
			display: flex;
			align-items: flex-start;
			margin: 15px 0px 0px 30px;
		}

		.top-menu .menu-item {
			display: inline-block;
			position: relative;
			text-align: left;
			margin-right: 20px;
			text-align: center;
		}

		.top-menu .sub-menu .menu-item {
			display: inline-block;
			position: relative;
			text-align: left;
			margin-right: 0px;
		}

		.top-menu .menu-item a {
			font-weight: bold;
			font-size: 0.9rem !important;
		}

		.top-menu .sub-menu .menu-item {
			display: block;
		}

		.top-menu .sub-menu {
			overflow: hidden;
			height: 0px;
			opacity: 0;
			text-align: left;
			transition-duration: 500ms;
		}

		.top-menu .sub-menu li {
			text-align: left;
		}

		.has-sub-menu {
			position: relative;
			margin-bottom: 20px;
			margin-right: 15px;
		}

		.sub-menu-opened {
			margin: 20px 0px;
			opacity: 1 !important;
		}

		.has-sub-menu:after {
			position: absolute;
			right: -20px;
			bottom: -3px;
			width: 20px;
			height: 20px;
			content: '';
			background: url('<?php echo get_template_directory_uri(); ?>/Icons/keyboard_arrow_down-24px.svg');
			background-position: center;
			background-size: cover;
		}

		#langSelect {
			margin-top: 15px;
			margin-right: 15px;
			border: none;
			font-weight: bold;
			outline: none;
			position: relative;
		}

		#langSelect a {
			font-size: 0.9rem;
		}

		#langSelect a img {
			vertical-align: middle;
			margin-left: -5px;
			width: 18px;
			margin-top: -2px;
		}

		.langOptions {
			overflow: hidden;
			height: 0;
			position: absolute;
			top: 30px;
			right: 0;
			transition-duration: 500ms;
			background-color: white;
			z-index: 99;
		}

		.langOptions .option {
			padding: 10px 15px;
			cursor: pointer;
		}

		.option label {
			cursor: pointer;
		}

		.option input {
			-webkit-appearance: none;
			-moz-appearance: none;
			-o-appearance: none;
			appearance: none;
		}

		.srch {
			padding-top: 18px;
			position: relative;
		}

		.srch .searchIconLink {
			height: 100%;
		}

		.srch #searchIcon {
			margin-right: 5px;
		}

		.srch .search_form {
			position: absolute;
			bottom: -70px;
			right: 0;
			display: none;
			z-index: 99;
			padding: 10px;
			background: white;
		}

		.srch .search_form .screen-reader-text {
			display: none;
		}

		.display-block {
			display: block !important;
		}

		.nav-srch-lang {
			display: flex;
		}

		@media screen and (max-width: 800px) {
			#masthead {
				position: relative;
				flex-direction: column;
				padding: 15px 0px;
			}

			.nav-srch-lang {
				position: absolute;
				right: 0;
				top: 0;
				padding-top: 15px;
			}

			.site-branding {
				margin-left: 15px;
			}

			.top-menu {
				margin-left: 20px;
			}
		}

		@media screen and (max-width: 560px) {
			.nav-srch-lang {
				position: absolute;
				right: unset;
				left: 20px;
				top: 0px;
			}

			.site-branding a {
				width: 100%;
				text-align: center;
			}

			.nav-title {
				display: none !important;
			}

			.menu-navigation-menu-en-container {
				display: flex;
				height: 0;
				overflow: hidden;
				transition-duration: 500ms;
			}

			.mobileMenuIcon {
				display: block;
				position: absolute;
				right: 20px;
				top: 32px;
			}

			.mobileMenuIcon img {
				width: 18px;
			}

			.top-menu {
				display: block;
			}

			.top-menu li {
				display: block !important;
				text-align: left !important;
			}
		}
	</style>

	<script type="text/javascript">
		var clicked = {
			menu: false,
			search: false,
			lang: false
		}
		window.onload = function() {
			var menuItems = document.querySelectorAll('.menu-item');

			for (var i = 0; i < menuItems.length - 1; i++) {
				var menuItem = menuItems[i];

				if (menuItem.querySelector('.sub-menu') !== null) {
					menuItem.querySelector('a').classList.add('has-sub-menu');
				}
			}
		}
		var menuItems = document.querySelectorAll('.menu-item');

		for (var i = 0; i < menuItems.length - 1; i++) {
			var menuItem = menuItems[i];
			menuItem.onclick = function(e) {
				clicked.menu = true;
				if (this.querySelector('.sub-menu') !== null) {
					if (e.target.classList.contains("has-sub-menu")) {
						e.preventDefault();
					}
					if (!this.querySelector('.sub-menu').classList.contains('sub-menu-opened')) {
						var calcHeight = 0;
						for (var j = 0; j < this.querySelectorAll('.sub-menu li').length; j++) calcHeight += this.querySelectorAll('.sub-menu li')[j].offsetHeight;
						this.querySelector('.sub-menu').style.height = calcHeight + 'px';
						for (var j = 0; j < menuItems.length - 1; j++) {
							if (menuItems[j].querySelector('.sub-menu') !== null) {
								if (menuItems[j].querySelector('.sub-menu').classList.contains('sub-menu-opened')) {
									menuItems[j].querySelector('.sub-menu').classList.toggle('sub-menu-opened');
									menuItems[j].querySelector('.sub-menu').style.height = '0px';
								}
							}
						}
					}else{
						this.querySelector('.sub-menu').style.height = '0px';
					}

					this.querySelector('.sub-menu').classList.toggle('sub-menu-opened');
				}
			}
		}

		document.querySelector('.searchIconLink').onclick = function() {
			document.querySelector('.search_form').classList.toggle('display-block');
			clicked.search = true;
		}

		document.querySelector('.mobileMenuIcon').onclick = function() {
			if (!document.querySelector('.menu-navigation-menu-en-container').classList.contains('mobileOpen')) {
				var mobileMenuHeight = 0,
				mobileMenuItems = document.querySelectorAll('.top-menu > li');
				for (var i = 0; i < mobileMenuItems.length; i++) {mobileMenuHeight += mobileMenuItems[i].offsetHeight};
				document.querySelector('.menu-navigation-menu-en-container').style.height = mobileMenuHeight + 15 + 'px';
				setTimeout(function() {
					document.querySelector('.menu-navigation-menu-en-container').style.height = 'auto';
				}, 500);
				console.log(mobileMenuHeight);
			}else{
				document.querySelector('.menu-navigation-menu-en-container').style.height = document.querySelector('.top-menu').offsetHeight + 15 + 'px';
				setTimeout(function() {
					document.querySelector('.menu-navigation-menu-en-container').style.height = '0px';
				}, 100);
			}
			document.querySelector('.menu-navigation-menu-en-container').classList.toggle('mobileOpen');
		}

		document.querySelector('#langSelect a').onclick = function() {
			clicked.lang = true;
			if (!this.classList.contains('lang-menu-open')) {
				var langHeight = 0,
				options = document.querySelectorAll('.langOptions .option');
				for (var i = 0; i < options.length; i++) {
					langHeight += options[i].offsetHeight;
				}
				this.parentElement.querySelector('.langOptions').style.height = langHeight + 'px';
				this.classList.toggle('lang-menu-open');
			}else{
				this.parentElement.querySelector('.langOptions').style.height = '0px';
				this.classList.toggle('lang-menu-open');
			}
		}

		var langOptions = document.querySelectorAll('.option label');
		for (var i = 0; i < langOptions.length; i++) {
			var langOption = langOptions[i];
			langOption.onclick = function() {
				this.parentElement.querySelector('input').checked = true;
				var imgURL = <?php get_template_directory_uri() .'/Icons/keyboard_arrow_down-24px.svg'; ?>
				document.querySelector('#langSelect a span').innerHTML = this.innerHTML;
			}
		}

		document.addEventListener('click', function() {
			if (!clicked.menu) {
				if (document.querySelector('.sub-menu-opened') !== null) {
					document.querySelector('.sub-menu-opened').style.height = '0px';
					document.querySelector('.sub-menu-opened').classList.toggle('sub-menu-opened');
				}
			}

			if (!clicked.search) {
				if (document.querySelector('.search_form').classList.contains('display-block')) {
					document.querySelector('.search_form').classList.toggle('display-block');
				}
			}

			if (!clicked.lang) {
				if (document.querySelector('#langSelect a').classList.contains('lang-menu-open')) {
					document.querySelector('#langSelect a').parentElement.querySelector('.langOptions').style.height = '0px';
					document.querySelector('#langSelect a').classList.toggle('lang-menu-open');
				}
			}

			clicked = {
				menu: false,
				search: false,
				lang: false
			}
		}, false);
	</script>
