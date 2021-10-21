<div class="overmij container mt-70">
	<h2 class="Page-title">Over mij</h2>
	<div class="row">
		<div class="col-4">
			<?php foreach (overmij_model::overmijfoto() as $key => $value){ ?>
				<img src="<?php echo controller::Weblink() . 'content/assets/upload/' . $value['content']; ?>" alt="it's a me">
			<?php } ?>
		</div>
		<div class="col-1">
			<?php foreach (overmij_model::overmijverhaal() as $key => $value){ ?>
			<pre><?php echo $value['content']; ?></pre>
			<?php } ?>
		</div>
	</div>
</div>