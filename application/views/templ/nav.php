<!--Naviguation-->
<nav class="navbar navbar-dark bg-dark fixed-top navbar-expand-lg">
	<div class="container">
		<a href="<?= base_url() ?>" class="navbar-brand">SBRH</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toogle nav"><span class="navbar-toggler-icon"></span></button>
		<div id="navbarResponsive" class="collapse navbar-collapse">
			<ul class="navbar-nav ml-auto">
				<li class="nav-item active"><a href="<?= base_url() ?>" class="nav-link">Home <span class="sr-only">(current)</span></a></li>
				<li class="nav-item"><a href="<?= base_url('MyAuth') ?>" class="nav-link">Connexion</a></li>
			</ul>
		</div>
	</div>
</nav>
