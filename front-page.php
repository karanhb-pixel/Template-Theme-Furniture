<?php
/**
 * The front page template file
 *
 * @package Biz-Catalog
 */

get_header();
?>

<main id="primary" class="site-main">

	<!-- HERO -->
	<section id="hero" class="hero">
		<div class="hero-overlay"></div>
		<?php
		$hero_image = get_field('hero_image', 'option');
		$hero_image_url = $hero_image ? $hero_image['url'] : "https://placehold.co/1600x700?text=Hero+Image";
		$hero_image_alt = $hero_image ? $hero_image['alt'] : 'Hero background image';
		?>
		<img src="<?php echo esc_url($hero_image_url); ?>" alt="<?php echo esc_attr($hero_image_alt); ?>"
			class="hero-bg" />
		<div class="container hero-content">
			<?php if ($hero_kicker = get_field('hero_kicker', 'option')) : ?>
			<p class="hero-kicker"><?php echo esc_html($hero_kicker); ?></p>
			<?php endif; ?>
			<?php if ($hero_title = get_field('hero_title', 'option')) : ?>
			<h1><?php echo esc_html($hero_title); ?></h1>
			<?php endif; ?>
			<?php if ($hero_subtitle = get_field('hero_subtitle', 'option')) : ?>
			<p class="hero-subtitle">
				<?php echo esc_html($hero_subtitle); ?>
			</p>
			<?php endif; ?>
			<div class="hero-actions">
				<a href="#projects" class="btn btn-primary">View Catalog</a>
				<a href="#contact" class="btn btn-outline">Request Free Consultation</a>
			</div>
		</div>
	</section>

	<!-- SERVICES / CATEGORIES -->
	<section id="services" class="section section-light">
		<div class="container">
			<header class="section-header">
				<?php if ($services_title = get_field('services_title', 'option')) : ?>
				<h2><?php echo esc_html($services_title); ?></h2>
				<?php else : ?>
				<h2>Our Services</h2>
				<?php endif; ?>
				<?php if ($services_description = get_field('services_description', 'option')) : ?>
				<p><?php echo esc_html($services_description); ?></p>
				<?php else : ?>
				<p>Explore the key service categories offered by our company.</p>
				<?php endif; ?>
			</header>

			<div class="grid grid-4">

				<?php
				$services = get_terms(array(
					'taxonomy' => 'service',
					'hide_empty' => false,
				));

				if (!empty($services) && !is_wp_error($services)):
					foreach ($services as $service):

						// Optional: Add default placeholder images for each service
						$image = get_field('service_image', 'service_' . $service->term_id);
						$image_url = $image ? $image['url'] : "https://placehold.co/600x400?text=" . urlencode($service->name);
						?>

						<a href="<?php echo esc_url(get_term_link($service)); ?>" class="card service-card">
							<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($service->name); ?>">
    						<div class="card-body">
								<h3><?php echo esc_html($service->name); ?></h3>

								<?php if (!empty($service->description)): ?>
									<p><?php echo esc_html(wp_trim_words($service->description, 20)); ?></p>
								<?php else: ?>
									<p>Explore our work in <?php echo esc_html($service->name); ?>.</p>
								<?php endif; ?>
							</div>
						</a>

						<?php
					endforeach;
					else:
						echo "<p>No services found.</p>";
					endif;
					?>

			</div>
			
			<!-- All Services Button -->
			<div class="text-center" style="margin-top: 3rem;">
				<a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn-primary btn-large">
					All Services
				</a>
			</div>
		</div>

	</section>

	<!-- PROJECT CATALOG -->
	<section id="projects" class="section">
		<div class="container">
			<header class="section-header">
				<?php if ($projects_title = get_field('projects_title', 'option')) : ?>
				<h2><?php echo esc_html($projects_title); ?></h2>
				<?php else : ?>
				<h2>Latest Projects</h2>
				<?php endif; ?>
				<?php if ($projects_description = get_field('projects_description', 'option')) : ?>
				<p><?php echo esc_html($projects_description); ?></p>
				<?php else : ?>
				<p>Explore our recent work and projects.</p>
				<?php endif; ?>
			</header>
			<?php
			$services = get_terms(array(
				'taxonomy' => 'service',
				'hide_empty' => false,
			));

			$current_service = get_queried_object();
			?>

			<div class="service-tabs">

				<a href="<?php echo home_url('/projects/'); ?>"
					class="service-tab <?php echo (is_post_type_archive('project')) ? 'active' : ''; ?>">
					All
					</a>

				<?php foreach ($services as $service): ?>
					<a href="<?php echo esc_url(get_term_link($service)); ?>" class="service-tab <?php echo (isset($current_service->term_id) && $current_service->term_id === $service->term_id) ? 'active' : ''; ?>">
						<?php echo esc_html($service->name); ?>
					</a>
				<?php endforeach; ?>
			</div>

			<div class="grid grid-3">
				<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				$projects = new WP_Query(array(
					'post_type' => 'project',
					'posts_per_page' => 6,
					'paged' => $paged,
					'order' => 'DESC',
				));

				?>

				<?php if ($projects->have_posts()): ?>
					<?php while ($projects->have_posts()):
						$projects->the_post(); ?>

						<article class="card project-card project-item">
							<div class="project-image-wrapper">

								<?php
								$services = get_the_terms(get_the_ID(), 'service');
								if (!empty($services) && !is_wp_error($services)):
									$service_name = $services[0]->name;
									?>
									<span class="badge badge-top-left">
										<?php echo esc_html($service_name); ?>
									</span>
								<?php endif; ?>

								<?php if (has_post_thumbnail()): ?>
									<?php the_post_thumbnail('large'); ?>
								<?php else: ?>
									<img src="https://placehold.co/800x500?text=No+Image" alt="">
								<?php endif; ?>
							</div>

							<div class="card-body">
								<h3><?php the_title(); ?></h3>
								<p><?php echo wp_trim_words(get_the_content(), 20); ?></p>

								<a href="<?php the_permalink(); ?>" class="btn btn-primary" style="margin-top:10px;">
									View Project
								</a>
							</div>
						</article>

					<?php endwhile;
					?>
					<div class="catalog-pagination">
						<?php
						echo paginate_links(array(
							'total' => $projects->max_num_pages,
							'current' => $paged,
							'prev_text' => '← Prev',
							'next_text' => 'Next →'
						));
						?>
					</div>

				<?php else: ?>
					<p style="grid-column: 1 / -1; text-align:center;">No projects found.</p>
				<?php endif; ?>

				<?php wp_reset_postdata(); ?>

			</div>
			
			<!-- View All Projects Button -->
			<div class="text-center" style="margin-top: 3rem;">
				<a href="<?php echo home_url('/projects/'); ?>" class="btn btn-primary btn-large">
					View All Projects
				</a>
			</div>
		</div>
	</section>

	<!-- ABOUT / FACTS -->
	<section id="about" class="section section-light">
		<div class="container about-grid">
			<div>
				<?php if ($about_title = get_field('about_title', 'option')) : ?>
				<h2><?php echo esc_html($about_title); ?></h2>
				<?php else : ?>
				<h2>About Us</h2>
				<?php endif; ?>
				<?php if ($about_content = get_field('about_content', 'option')) : ?>
				<p><?php echo esc_html($about_content); ?></p>
				<?php else : ?>
				<p>
					We are a professional company delivering high-quality services to our clients.
					This template is designed to showcase your work and help you connect with potential customers.
				</p>
				<?php endif; ?>
			</div>

			<div class="about-facts">
				<h3>Key Facts</h3>
				<ul>
					<?php
					$facts = get_field('about_facts', 'option');
					if ($facts && is_array($facts)):
						foreach ($facts as $fact):
							?><li><strong><?php echo esc_html($fact['label']); ?>:</strong> <?php echo esc_html($fact['value']); ?></li><?php
							endforeach;
							else:
						?>
						<li><strong>Year of Establishment:</strong> 2024</li>
						<li><strong>Nature of Business:</strong> Professional Services</li>
						<li><strong>Team Size:</strong> 10+ experts</li>
						<li><strong>Location:</strong> Your Location</li>
						<?php
					endif;
					?>
				</ul>
			</div>

			<!-- Know More About Us Button -->
		<div class="text-center" style="margin-top: 3rem;">
			<a href="<?php echo esc_url(home_url('/about/')); ?>" class="btn btn-primary btn-large">
				Know More About Us
			</a>
		</div>
		</div>
		
		
	</section>

	<!-- CONTACT -->
	<section id="contact" class="section">
		<div class="container contact-grid">
			<div>
				<?php if ($contact_title = get_field('contact_title', 'option')) : ?>
				<h2><?php echo esc_html($contact_title); ?></h2>
				<?php else : ?>
				<h2>Contact Us</h2>
				<?php endif; ?>
				<?php if ($contact_description = get_field('contact_description', 'option')) : ?>
				<p><?php echo esc_html($contact_description); ?></p>
				<?php else : ?>
				<p>Use the form below to share your project details and we'll get back to you.</p>
				<?php endif; ?>

				<?php
				$form_shortcode = get_field('contact_form_shortcode', 'option');

				if ($form_shortcode) {
					echo do_shortcode($form_shortcode);
				} else {
					?>
					<form class="contact-form">
						<div class="form-row">
							<label for="name">Full Name</label>
							<input id="name" type="text" placeholder="Enter your name" required />
						</div>
						<div class="form-row">
							<label for="phone">Phone Number</label>
							<input id="phone" type="tel" placeholder="Enter your phone number" required />
						</div>
						<div class="form-row">
							<label for="email">Email Address</label>
							<input id="email" type="email" placeholder="Enter your email" />
						</div>
						<div class="form-row">
							<label for="message">Project Details</label>
							<textarea id="message" rows="4" placeholder="Share your requirements"></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Submit Enquiry</button>
					</form>
					<?php
				}
				?>
			</div>

			<div class="contact-details">
				<h3>Contact Details</h3>
				<ul>
					<?php if ($phone = get_field('contact_phone', 'option')) : ?>
						<li><strong>Phone:</strong> <?php echo esc_html($phone); ?></li>
					<?php endif; ?>

					<?php if ($whatsapp = get_field('contact_whatsapp', 'option')) : ?>
						<li>
							<strong>WhatsApp:</strong>
							<a href="https://wa.me/<?php echo preg_replace('/\D+/', '', $whatsapp); ?>" target="_blank" rel="noopener">
								<?php echo esc_html($whatsapp); ?>
							</a>
						</li>
					<?php endif; ?>

					<?php if ($email = get_field('contact_email', 'option')) : ?>
						<li>
							<strong>Email:</strong>
							<a href="mailto:<?php echo esc_attr($email); ?>">
								<?php echo esc_html($email); ?>
							</a>
						</li>
					<?php endif; ?>

					<?php if ($address = get_field('contact_address', 'option')) : ?>
						<li><strong>Address:</strong> <?php echo nl2br(esc_html($address)); ?></li>
					<?php endif; ?>
				</ul>

				<div class="contact-note">
					All contact details above are managed from the Site Settings (ACF Options) panel.
				</div>
			</div>
		</div>
	</section>

</main><!-- #primary -->

<?php
get_footer();
