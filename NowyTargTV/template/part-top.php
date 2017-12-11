
<?php do_action( 'get_live' ); ?>

<div class="container">
	<a class="navbar-brand" href="index.html"></a>
</div>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-mainmenu static-top">
	<div class="container">
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
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
			<form class="searchbar row" method="get">
				<input class="input-text" type="text" name="nazwa" placeholder="Wyszukaj artykuł">
				<button class="input-submit pointer bold alt" type="submit">
				Szukaj
				</button>
			</form>
		</div>
	</div>
</nav>
