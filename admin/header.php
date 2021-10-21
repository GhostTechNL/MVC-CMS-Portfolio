<?php //admin ?>
<div class="header" id="menu">
	<div class="header-block">
		<div><button id="btn"><i class="fas fa-bars"></i></button></div>
		<div class="logo"><img width="120" id="logo" src="<?php echo controller::Weblink(); ?>content/assets/img/logo.png"></div>
		<div class="">
			<h2 style="text-align:center; color: red;">Admin paneel</h2>
			<ul>
				<li>
					<a href="<?php echo controller::Weblink(); ?>Home/">
						<div class="sharpcorner-lt"></div>
						<i class="fas fa-arrow-left"></i> Back
						<div class="sharpcorner-rb"></div>
					</a>
				</li>
				<li>
					<a href="<?php echo controller::Weblink(); ?>admin/Overmij/">
						<div class="sharpcorner-lt"></div>
						Over mij
						<div class="sharpcorner-rb"></div>
					</a>
				</li>
				<li>
					<a href="<?php echo controller::Weblink(); ?>admin/Skills/">
						<div class="sharpcorner-lt"></div>
						Skills
						<div class="sharpcorner-rb"></div>
					</a>
				</li>
				<li>
					<a href="<?php echo controller::Weblink(); ?>admin/Projecten/">
						<div class="sharpcorner-lt"></div>
						Projecten
						<div class="sharpcorner-rb"></div>
					</a>
				</li>
				<li>
					<a href="<?php echo controller::Weblink(); ?>admin/expages/">
						<div class="sharpcorner-lt"></div>
						Expiremental
						<div class="sharpcorner-rb"></div>
					</a>
				</li>
			</ul>
		</div>
	</div>
</div>
