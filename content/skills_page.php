<div class="skills container mt-70">
	<h2 class="Page-title">Skills</h2>
	<div class="row">
		<div class="col-2">
		<?php foreach (skills_model::skillstory() as $key => $value) { ?>
			<div class="skill-story desktop">
				<div class="skill-story-i">
					<i class="<?php echo $value['style']; ?>"></i>
				</div>
				<div class="skill-story-text">
					<h2><?php echo $value['title']; ?></h2>
					<p><?php echo $value['content']; ?></p>
				</div>
			</div>
			<div class="skill-story mobile">
				<div class="skill-story-text">
					<h2><i class="<?php echo $value['style']; ?>"></i> <?php echo $value['title']; ?></h2>
					<p><?php echo $value['content']; ?></p>
				</div>
			</div>
			<?php } ?>
		</div>
		<div class="col-2">
			<?php 
			$i = 0;
			foreach (skills_model::skillmeter() as $key => $value) { ?>
				<div class="meter-bar">
					<span><?php echo $value['content']; ?></span>
					<div id="k<?php echo $i ?>" class="progress" style=" <?php echo $value['style']; ?>"><h4><?php echo $value['title']; ?></h4></div>
					<script type="text/javascript">window.addEventListener("load",function(){document.getElementById("k<?php echo $i ?>").style.width = "<?php echo $value['content']; ?>"});</script>
				</div>
			<?php 
				$i++;
			} ?>
		</div>
	</div>
</div>