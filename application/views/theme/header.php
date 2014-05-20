<!DOCTYPE html>
<html lang="en">
	<head>
		<title>NRJ - Reloaded</title>
		
		<!-- meta -->
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<meta name="description" content="NRJ reloaded Mush journaux">
		<meta name="author" content="FlokS">

		<!-- my favicon -->
		<link rel="shortcut icon" href="<?php echo img_url('favicon.png'); ?>">

		<!-- my template.css -->
		<!--<link rel="stylesheet" href="<?php echo css_url('main'); ?>" type="text/css" media="screen">-->
		<link rel="stylesheet" href="<?php echo css_url('neron'); ?>" type="text/css" media="screen">

		<!-- my scripts.js -->
		<script type="text/javascript" src="<?php echo js_url('day'); ?>"></script>
		<script type="text/javascript" src="<?php echo js_url('jquery-1.9.1.min'); ?>"></script>
		<script type="text/javascript" src="<?php echo js_url('jneron-terminal'); ?>"></script>
		<script type="text/javascript" src="<?php echo js_url('nerontalk'); ?>"></script>
		
	</head>
	
	<body>
		<header></header>
   		<div class="content">
        			<div class="dark">
        				<span class="red">
				<?php
					if($this->session->userdata('id')) {
						echo $this->session->userdata('name');
						//echo 'Vous &ecirc;tes connect&eacute; en tant que <span class="alert_good">'.$toto.'</span> - <a href="'.base_url('index/deco').'">d&eacute;connexion</a>';
					}
					else echo "anonymous";
				?>
				</span>
				@/> neron
			</div>

			<!-- include menu -->
			<?php $this->load->view('theme/menu'); ?>

		<section id="page">
        			