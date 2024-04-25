<?php
/*
 * Template Name: Homepage Template
 * Stylesheet: homepage.css
 */
get_header(); 
$contact_title = get_field( 'contact_title');
$contact_excerpt = get_field( 'contact_excerpt');
$contact_form_title = get_field( 'contact_form_title');
$form_shortcode = get_field( 'form_shortcode');
$reach_us_title = get_field( 'reach_us_title');
$reach_us_details = get_field( 'reach_us_details');

$facebook_url = get_option( 'facebook_url');
$twitter_url = get_option( 'twitter_url');
$linkedin_url = get_option( 'linkedin_url');
$pinterest_url = get_option( 'pinterest_url');
?>

<body>
    <main class="content_div">
		<section class="page_navigation">
			Home / Who we are / <span>Contact</span>
		</section>
		<section class="contact">
			<h1><?php echo $contact_title ?></h1>
			<p><?php echo $contact_excerpt ?></p>
		</section>
		<section class="contact_details">
			<section class="contact_form">
				<h1><?php echo $contact_form_title ?></h1>
				<div class="rizeen-form">
					<?php echo apply_shortcodes($form_shortcode); ?>
				</div>
        	</section>
			<section class="contact_address">
				<h1><?php echo $reach_us_title ?></h1>
				<section class="address_block">
					<?php echo $reach_us_details ?>
				</section>
				<section class="social_icons">
					<span>
						<a href="<?php echo $facebook_url ?>">
							<i class="fa-brands fa-facebook-f fa-fw" title="facebook button"></i>
						</a>
					</span>
					<span>
						<a href="<?php echo $twitter_url ?>">
							<i class="fa-brands fa-twitter fa-fw" title="twitter button"></i>
						</a>
					</span>
					<span>
						<a href="<?php echo $linkedin_url ?>">						
							<i class="fa-brands fa-linkedin-in fa-fw" title="linkedin button"></i>
						</a>
					</span>
					<span>
						<a href="<?php echo $pinterest_url ?>">						
							<i class="fa-brands fa-pinterest-p fa-fw" title="pinterest button"></i>
						</a>						
					</span>
				</section>
        	</section>
    	</section>
    </main>
</body>

<?php get_footer(); 

