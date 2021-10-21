<div class="contact container mt-70">
	<h2 class="Page-title">Contact formulier</h2>
	<?php contact_model::form();
	if (!empty(controller::get_errorMessage())) { ?>
	<div class="mobile message error">
		<h4>Error:</h4>
		<?php echo controller::get_errorMessage("get"); ?>
	</div>
<?php }elseif (!empty(controller::get_noteMessage())) { ?>
	<div class="mobile message note">
		<h4>Bericht:</h4>
		<?php echo controller::get_noteMessage("get"); ?>
	</div>
<?php } ?>
	<div class="row">
		<div class="col-2">
			<form method="POST" action="submit/" autocomplete="off">
				<label>Naam:</label>
				<input type="text" name="name">
				<label>Email adress:</label>
				<input type="text" name="email">
				<label>Bericht:</label>
				<textarea name="message"></textarea>
				<input type="submit" name="send" value="Versturen">
			</form>
		</div>
		<div class="col-2">
			<h2>Ik sta altijd klaar</h2>
			<pre>
			Ik sta altijd klaar om een email te beantwoorden.
			</pre>
			<?php
			if (!empty(controller::get_errorMessage())) { ?>
				<div class="message error">
					<h4>Error:</h4>
					<?php echo controller::get_errorMessage("clear"); ?>
				</div>
			<?php }elseif (!empty(controller::get_noteMessage())) { ?>
				<div class="message note">
					<h4>Bericht:</h4>
					<?php echo controller::get_noteMessage("clear"); ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>