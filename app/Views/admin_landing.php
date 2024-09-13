<!DOCTYPE html>
<html>
	<title><?= $siteConfig->siteName ?></title>	
	<?php if(isset($alert)){ ?>
		<script type="text/javascript">
			if (<?=$alert?>!="")alert("<?=$alert?>")
		</script>
	<?php } else ?>
	<body>
		<span> <?=$currentUrl ?> || </span>
		<span> <?=$currentUser['name'] ?> || </span>
		<span> <?=$key ?> || </span>
		<span> <a href="<?php echo site_url('a/') ?>">Home</a> || </span>
		<span> <a href="<?php echo site_url('a/user') ?>">User</a> || </span>
		<span> <a href="<?php echo site_url('a/logout') ?>">Logout</a> || </span>
		<div>
			<?php if($currentUrl=="a/"){ ?>
				<span>HOME</span>
			<?php } else ?>
			<?php if($currentUrl=="a/user"){ ?>
				<span>USER</span>
				<a href="<?php echo site_url('a/user/create') ?>">Tambah User</a>
				<?php if (isset($_SESSION['error'])): ?>
				    <div class="alert alert-warning" role="alert">
				        <?= $_SESSION['error']; ?>
				    </div>
				<?php endif;?>


				<?php
					if(isset($userData)){?>
						<table><?php
						foreach ($userData as $x) { ?>
							<tr>
								<td><?= $x['name'] ?></td>
								<td><a href="<?php echo site_url('a/user/delete/'.$x['id']) ?>">Hapus</a></td>
							</tr>
						<?php }
					} ?></table><?php
			 }else ?>
			 	
		</div>


	</body>
</html>

