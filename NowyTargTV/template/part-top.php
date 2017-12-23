
<?php do_action( 'get_live' ); ?>

<div class="container d-flex align-items-center justify-content-between flex-wrap">
	<a class="navbar-brand" href="<?php echo home_url(); ?>"></a>
	<div id='minipanel' class='row'>
		<div class='popup'>
			<div class='view weather'>
				<?php dynamic_sidebar( 'sidebar-weather' ); ?>
			</div>
			<div class='view air'>
				<?php do_action( 'minipanel-air', getAirCon() ); ?>
			</div>
			<div class='view currency'>
				<?php dynamic_sidebar( 'sidebar-currency' ); ?>
			</div>
			
		</div>
		<div class='item d-flex flex-column' view='weather'>
			<div class='icon' style='background-image:url(<?php echo get_template_directory_uri(); ?>/media/icon_weather.png);'></div>
			<div class='title'>
				Pogoda
			</div>
			
		</div>
		<div class='item d-flex flex-column' view='air'>
			<div class='icon' style='background-image:url(<?php echo get_template_directory_uri(); ?>/media/icon_air.png);'></div>
			<div class='title'>
				Stan powietrza
			</div>
			
		</div>
		<div class='item d-flex flex-column' view='currency'>
			<div class='icon' style='background-image:url(<?php echo get_template_directory_uri(); ?>/media/icon_currency.png);'></div>
			<div class='title'>
				Kurs walut
			</div>
			
		</div>
		<a class='item d-flex flex-column' href='<?php echo home_url( '/kamery' ); ?>'>
			<div class='icon' style='background-image:url(<?php echo get_template_directory_uri(); ?>/media/icon_cam.png);'></div>
			<div class='title'>
				Kamery online
			</div>
			
		</a>
		
	</div>
	
</div>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-mainmenu static-top">
	<div class="container">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<!-- <span class="navbar-toggler-icon"></span> -->
			<div class='box'>
				<div class='bar'></div>
				<div class='bar'></div>
				<div class='bar'></div>
				
			</div>
			
		</button>
		<div class="collapse navbar-collapse" id="navbarResponsive">
			<ul class="navbar-nav mr-auto">
				<?php
					$page_title = get_post()->post_title;
					foreach( wp_get_nav_menu_items( 'glowne-menu' ) as $item ):
					$t_title = $item->title;
				?>
				<li class="nav-item">
					<a class="nav-link<?php echo $page_title == $t_title?( ' active-menu ' ):( '' ); ?>" href="<?php echo $item->url; ?>">
						<?php echo $item->title; ?>
					</a>
				</li>
				<?php endforeach; ?>
			</ul>
			<form class="searchbar d-flex d-lg-block" method="get" action="<?php echo home_url( '/' ); ?>">
				<input class="input-text" type="text" name="s" placeholder="Wyszukaj artykuł">
				<button class="input-submit pointer bold alt" type="submit">
					Szukaj
				</button>
			</form>
		</div>
	</div>
</nav>
