<footer class="py-5 bg_blue foot">
	<div class="container">
		<div class="row">
			<div class="col-lg-4 column">
				<div id='logo_bot' class=''>
					<?php include __DIR__ . "/../media/logo_white.svg"; ?>
				</div>
				<p>Informacje z Podhala</p>
			</div>
			<div class="col-6 col-sm column">
				<h5>kontakt</h5>
				<?php dynamic_sidebar( 'stopka-kontakt' ); ?>
			</div>
			<div class="col-6 col-sm column">
				<h5>Portal</h5>
				<?php dynamic_sidebar( 'stopka-portal' ); ?>
			</div>
			<div class="col-6 col-sm column">
				<h5>Reklama</h5>
				<?php dynamic_sidebar( 'stopka-reklama' ); ?>
			</div>
			<div class="col-6 col-sm column">
				<h5>Praca</h5>
				<?php dynamic_sidebar( 'stopka-praca' ); ?>
			</div>
		</div>
	</div>
	<!-- /.container -->
</footer>
<div class="foot_copy">
	<div class="container">
		<div class="row">
			<div class="col-12 col-sm-7 text-center text-sm-left">
				© 2016 Nowotarska Telewizja Kablowa. ul. Józefczaka 1, 34-400 Nowy Targ
			</div>
			<div class="col-12 col-sm text-center text-sm-right">
				projekt i wykonanie: <a href="http://www.scepter.pl"> Scepter Agencja interaktywna</a>
			</div>
		</div>
	</div>
</div>
