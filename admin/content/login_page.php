<div class="login container">
	<?php login_model::form(); ?>
	<div class="login-container">
		<img width="150" src="<?php echo controller::Weblink(); ?>content/assets/img/logo.png">
		<form method="POST" action="submit/" autocomplete="off">
			<div class="login-inform">
				<h2>Login</h2>
				<?php if (!empty(controller::get_errorMessage("get"))) { ?>
					<div class="error">
						<?php echo controller::get_errorMessage("clear"); ?>
					</div>
				<?php }
				$givemecookie = "";
				$is_checked = "";
				if (!empty($_COOKIE['username'])) {
					$givemecookie = $_COOKIE['username'];
					$is_checked = "checked";
				}
				?> 
				<input type="text" name="username" placeholder="Username" value="<?php echo $givemecookie ?>">
				<input type="password" name="password" placeholder="Password">
				<div class="login-member">
					<input type="checkbox" name="member" value="true" <?php echo $is_checked ?> ><label>Remember me</label>
				</div>
				<input type="submit" name="login" value="Login">
			</div>
		</form>
	</div>
</div>