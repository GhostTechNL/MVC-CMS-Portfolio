<?php if (empty(controller::getURLValue(2,"short"))){ ?>
	<div class="projecten container mt-70">
		<h2 class="Page-title">Projecten</h2>
		<div class="row-wrap">
			<?php 
			$project = projecten_model::getprojects();
			foreach ($project as $key => $value) { 
				$imagedir = controller::Weblink() . "content/assets/upload/". $value['imagename'];
				?>
				<a href="<?php echo $value['ID']; ?>/" class="project-item">
					<div class="project-image">
					<?php if (!empty($value['imagename'])){ ?>
						<img src="<?php echo $imagedir; ?>" alt="Project image">
					<?php }else{ ?>
						<img src="<?php echo controller::Weblink(); ?>content/assets/img/Noimage.png" alt="No image">
					<?php } ?>
					</div>
					<h2><?php echo $value['name']; ?></h2>
				</a>
			<?php } ?>
		</div>
	</div>
<?php }else{ ?>
	<div class="project-view container mt-70">
		<div class="row">
			<?php 
			$project = projecten_model::getviewproject(controller::getURLValue(2,"short"));
			foreach ($project as $key => $value) { 
				$imagedir = controller::Weblink() . "content/assets/upload/". $value['imagename'];
				?>
				<div class="col-2">
					<h2 class="Page-title"><?php echo $value['name']; ?></h2>
					<pre><?php echo $value['description']; ?></pre>
				</div>
				<div class="col-2">
					<?php if (!empty($value['imagename'])){ ?>
						<img src="<?php echo $imagedir; ?>" alt="Project image">	
					<?php }else{ ?>
						<img src="<?php echo controller::Weblink(); ?>content/assets/img/Noimage.png" alt="No image">	
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
<?php } ?>