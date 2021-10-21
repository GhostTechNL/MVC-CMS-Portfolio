<?php $thispage = controller::Weblink() . "admin/" . controller::getURLValue(1,"short") . "/" ?>
<div class="projecten-ad container mt-70">
	<?php if (controller::getURLValue(2,"short") == "Update" && !empty(controller::getURLValue(3,"short"))) { ?>
		<?php projecten_model::Update(); 
		$data = projecten_model::the_project(controller::getURLValue(3,"short"));
		?>
		<h2 class="Page-title">Projecten Update</h2>
		<a class="default-btn" href="<?php echo $thispage ?>"><i class="fas fa-arrow-left"></i> Back</a>
		<form action="submit/" method="POST" enctype="multipart/form-data" autocomplete="off">
			<?php if (!empty(controller::get_errorMessage("get"))) { ?>
			<div class="error">
				<?php echo controller::get_errorMessage("clear",3); ?>
			</div>
		<?php }elseif(!empty(controller::get_noteMessage("get"))){ ?>
			<div class="note">
				<?php echo controller::get_noteMessage("clear",3); ?>
			</div>
		<?php } ?>
			<input type="text" name="name" placeholder="Project name" value="<?php echo $data['name'] ?>">
			<label id="newfile" for="file" class="upload-btn"><i class="fas fa-upload"></i> Would you like upload a new image?</label>
			<input type="file" name="image" id="file" style="display: none;">
			<textarea name="description" placeholder="Description.... There is a story"><?php echo $data['description'] ?></textarea>
			<input type="submit" name="send" value="Versturen">
		</form>
	<?php } elseif(controller::getURLValue(2,"short") == "Create"){ ?>
		<?php projecten_model::Create(); ?>
		<h2 class="Page-title">Projecten Create</h2>
		<a class="default-btn" href="<?php echo $thispage ?>"><i class="fas fa-arrow-left"></i> Back</a>
		<form action="submit/" method="POST" enctype="multipart/form-data" autocomplete="off">
			<?php if (!empty(controller::get_errorMessage("get"))) { ?>
			<div class="error">
				<?php echo controller::get_errorMessage("clear",2); ?>
			</div>
		<?php }elseif(!empty(controller::get_noteMessage("get"))){ ?>
			<div class="note">
				<?php echo controller::get_noteMessage("clear",2); ?>
			</div>
		<?php } ?>
			<input type="text" name="name" placeholder="Project name">
			<label id="newfile" for="file" class="upload-btn"><i class="fas fa-upload"></i> Upload an image</label>
			<input type="file" name="image" id="file" style="display: none;">
			<textarea name="description" placeholder="Description.... There is a story"></textarea>
			<input type="submit" name="send" value="Versturen">
		</form>
	<?php }else{ ?>
		<h2 class="Page-title">Projecten overview</h2>
		<div>
			<a class="default-btn" href="<?php echo $thispage . 'Create/' ?>"><i class="fas fa-plus"></i> Create project</a>
		</div>
			<?php if (!empty(controller::get_errorMessage("get"))) { ?>
			<div class="error">
				<?php echo controller::get_errorMessage("clear"); ?>
			</div>
		<?php }elseif(!empty(controller::get_noteMessage("get"))){ ?>
			<div class="note">
				<?php echo controller::get_noteMessage("clear"); ?>
			</div>
		<?php } ?>
		<?php projecten_model::Delete(); ?>
		<div class="project-ad-list">
			<table>
				<thead>
					<tr>
						<th class="main">Projecten</th>
						<th>Project type</th>
						<th>Coming Soon</th>
						<th>Delete</th>
					</tr>
				</thead>
				<tbody>
				<?php foreach (projecten_model::get_projects() as $key => $value) { 
					$update = $thispage . "Update/" . $value["ID"] ."/";
					$delete = $thispage . "Delete/" . $value["ID"] ."/submit/";
					?>
					<tr>
						<td class="name"><a href="<?php echo $update ?>"><?php echo $value['name']; ?></a></td>
						<td><?php echo "Null"; ?></td>
						<td><?php echo "Null"; ?></td>
						<td class="delete-btn"><a href="<?php echo $delete ?>"><i class="fas fa-trash"></i> Delete</a></td>
					</tr>
			<?php } ?>
			</tbody>
			</table>
		</div>
	<?php } ?>
</div>
<script type="text/javascript">
	input_file = document.getElementById("file");
	output_file = document.getElementById("newfile");
	if (input_file !== null) {
		input_file.addEventListener("change", function(){
			const string = input_file.value;
			const inputer = string.split('\\').pop();
			output_file.innerHTML = "<i class='fas fa-upload'></i> " + inputer;
			
		});
	}
</script>