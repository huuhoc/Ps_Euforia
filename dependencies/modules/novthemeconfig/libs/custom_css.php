<?php  if(isset($novconfig["novthemeconfig_body_bg_color"]) && $novconfig["novthemeconfig_body_bg_color"]){ ?>
	#main-site {
		background-color: <?php echo $novconfig["novthemeconfig_body_bg_color"] ?>;
	}
<?php } ?>
<?php  if(isset($novconfig["novthemeconfig_body_bg_pattern"]) && $novconfig["novthemeconfig_body_bg_pattern"] != 'none'){ ?>
	body {
		background-image: url(<?php echo $this->_path.'images/'.$novconfig["novthemeconfig_body_bg_pattern"].'.png'; ?>);
	}
<?php } ?>
<?php  if(isset($novconfig["novthemeconfig_body_bg_image"]) && $novconfig["novthemeconfig_body_bg_image"]){ ?>
	body {
		background-image: url(<?php echo $this->_path.'images/'.$novconfig["novthemeconfig_body_bg_image"]; ?>);
	}
<?php } ?>


<?php if( isset($novconfig["novthemeconfig_mode_layout"]) && $novconfig["novthemeconfig_mode_layout"] == "boxed" ) { ?>
	<?php if( $novconfig["novthemeconfig_width_layout"] >= 1600 ) { ?>
		@media (min-width: <?php echo $novconfig["novthemeconfig_width_layout"] + 1; ?>px) {
			#main-site {
				width: <?php echo $novconfig["novthemeconfig_width_layout"]; ?>px;
				box-shadow: 0 0 20px rgba(0,0,0,0.2);
				margin: 0 auto;
			}
		}
		@media (min-width: 1200px) and (max-width: <?php echo $novconfig["novthemeconfig_width_layout"]; ?>px){
			#main-site {
				width: 1200px;
				box-shadow: 0 0 20px rgba(0,0,0,0.2);
				margin: 0 auto;
			}
		}
	<?php } elseif( $novconfig["novthemeconfig_width_layout"] >= 1200 && $novconfig["novthemeconfig_width_layout"] < 1600) { ?>
		@media (min-width: <?php echo $novconfig["novthemeconfig_width_layout"] + 1; ?>px) {
			#main-site {
				width: <?php echo $novconfig["novthemeconfig_width_layout"]; ?>px;
				box-shadow: 0 0 20px rgba(0,0,0,0.2);
				margin: 0 auto;
			}
		}

		@media (min-width: 1200px) and (max-width: <?php echo $novconfig["novthemeconfig_width_layout"]; ?>px){
			#main-site {
				width: 1200px;
				box-shadow: 0 0 20px rgba(0,0,0,0.2);
				margin: 0 auto;
			}
		}

	<?php } else { ?>
		@media (min-width: <?php echo $novconfig["novthemeconfig_width_layout"] + 1; ?>px) {
			#main-site {
				width: <?php echo $novconfig["novthemeconfig_width_layout"]; ?>px;
				box-shadow: 0 0 20px rgba(0,0,0,0.2);
				margin: 0 auto;
			}
		}
	<?php } ?>

<?php } else { ?>
	@media (min-width: 1200px) {
		.container {
			width: <?php echo $novconfig["novthemeconfig_width_layout"]; ?>px;
		}
		#header .container {
			width: <?php echo $novconfig["novthemeconfig_width_layout"]; ?>px;
		}
		.footer .container {
			width: <?php echo $novconfig["novthemeconfig_width_layout"]; ?>px;
		}
	}
<?php } ?>


<?php  if(isset($novconfig["novpopup_newsletter_bg"]) && $novconfig["novpopup_newsletter_bg"]){ ?>
	#popup-subscribe .modal-content {
		background-image: url(<?php echo $this->_path.'images/'.$novconfig["novpopup_newsletter_bg"]; ?>);
		background-repeat: no-repeat;
		background-position: top center;
	}
<?php } ?>


<?php  if(isset($novconfig["novpopup_loading_enable"]) && $novconfig["novpopup_loading_enable"]==1){ ?>
	#main-site {
	    display: none;
	}
<?php } ?>

<?php
	if(isset($novconfig["novthemeconfig_customCSS"]) && $novconfig["novthemeconfig_customCSS"]){
		echo $novconfig["novthemeconfig_customCSS"];
	}
?>
