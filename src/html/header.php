<header ng-controller="search" class="clearfix">
	<div id="logo" class="clearfix collapse in">
		<div class="clearfix" id="logoUMSlogan">
			<div id="logo-UM">
				<a href="http://www.umontpellier.fr/" onclick="window.open(this.href); return false;">
					<img src="/assets/img/logo_um.png" alt="Logo de l'universite de Montpellier">
				</a>
			</div>
			<div id="responsive-logo-artistique">
				<a href="http://www.culturecommunication.gouv.fr/Politiques-ministerielles/Le-1-artistique" onclick="window.open(this.href); return false;">
					<img src="/assets/img/logo_artistique.png" alt="Logo du 1% artistique">
				</a>
			</div>
			<div id="slogan">
			  	<a href="/">
			  		<h1>1% artistique - Université de Montpellier</h1>
			  	</a>
			</div>
		</div>
		<div id="logo-artistique">
			<a href="http://www.culturecommunication.gouv.fr/Politiques-ministerielles/Le-1-artistique" onclick="window.open(this.href); return false;">
				<img src="/assets/img/logo_artistique.png" alt="Logo du 1% artistique">
			</a>
		</div>
		<div id="responsive-slogan">
			<a href="/">
		  		<h1>1% artistique - Université de Montpellier</h1>
		  	</a>
		</div>
	</div>
	<div class="input-group" id="search">
		<input type="text" class="form-control basics" placeholder="Chercher une oeuvre d'art, un lieu">
		<div class="input-group-addon" id="logo-search">
			<i class='glyphicon glyphicon-search'></i>
		</div>
	</div>
	<div class="collapse-trigger collapse-off" data-toggle="collapse" data-target="#logo">
		<i class='glyphicon glyphicon-collapse glyphicon-chevron-up'></i>
	</div>
</header>