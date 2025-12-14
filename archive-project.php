<?php
/**
 * The template for displaying project archive pages
 *
 * @package Biz-Catalog
 */

get_header();
?>

<main id="primary" class="site-main">

	<?php if (function_exists('cc_breadcrumbs'))
		cc_breadcrumbs(); ?>

	<!-- HERO -->
	<section id="hero" class="hero small-hero">
		<div class="hero-overlay"></div>
		<img src="https://placehold.co/1600x400?text=Projects+Catalog" alt="Projects catalog hero placeholder"
			class="hero-bg" />
		<div class="container hero-content">
			<h1>Projects Catalog</h1>
			<p class="hero-subtitle">
				Browse our complete collection of projects across all categories.
			</p>
		</div>
	</section>

	<!-- PROJECT CATALOG -->
	<section id="projects" class="section">
		<div class="container">
			<header class="section-header">
				<h2>All Projects</h2>
				<p>Explore our work across different categories and services.</p>
			</header>
			<?php
			$services = get_terms(array(
				'taxonomy' => 'service',
				'hide_empty' => false,
			));

			$current_service = get_queried_object();
			$is_service_archive = is_tax('service');
			?>

			<div class="service-tabs">

				<a href="<?php echo home_url('/projects/'); ?>"
					class="service-tab <?php echo (is_post_type_archive('project')) ? 'active' : ''; ?>">
					All
				</a>

				<?php foreach ($services as $service): ?>
					<a href="<?php echo esc_url(get_term_link($service)); ?>"
						class="service-tab <?php echo ($is_service_archive && isset($current_service->term_id) && $current_service->term_id == $service->term_id) ? 'active' : ''; ?>">
						<?php echo esc_html($service->name); ?>
					</a>
				<?php endforeach; ?>
			</div>

			<!-- FILTER & SORT OPTIONS -->
			<div class="section-header" style="margin-top: 2rem;">
				<div style="display: flex; gap: 1rem; flex-wrap: wrap; align-items: center;">
					<div style="flex: 1;">
						<label for="sort-by" style="margin-right: 0.5rem;">Sort by:</label>
						<select id="sort-by" style="padding: 0.5rem; border-radius: 0.5rem; border: 1px solid #e5e7eb;">
							<option value="newest">Newest First</option>
							<option value="featured">Featured Projects</option>
							<option value="alpha">Alphabetical</option>
						</select>
					</div>
					<div>
						<label for="filter-by" style="margin-right: 0.5rem;">Filter by:</label>
						<select id="filter-by"
							style="padding: 0.5rem; border-radius: 0.5rem; border: 1px solid #e5e7eb;">
							<option value="all">All Projects</option>
							<option value="featured">Featured Only</option>
							<?php foreach ($services as $service): ?>
								<option value="<?php echo esc_attr($service->slug); ?>">
									<?php echo esc_html($service->name); ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
			</div>

			<div class="grid grid-3">
				<?php
				$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				$projects = new WP_Query(array(
					'post_type' => 'project',
					'posts_per_page' => 9,
					'paged' => $paged,
					'order' => 'DESC',
				));

				?>

				<?php if ($projects->have_posts()): ?>
					<?php while ($projects->have_posts()):
						$projects->the_post();

						// Get project metadata
						$is_featured = (function_exists('get_field') && get_field('project_featured')) ? 'featured' : '';
						$services = get_the_terms(get_the_ID(), 'service');
						$service_name = !empty($services) && !is_wp_error($services) ? $services[0]->name : 'General';
						?>

						<article class="card project-card project-item<?php echo ' ' . esc_attr($is_featured); ?>">
							<div class="project-image-wrapper">

								<?php if ($is_featured): ?>
									<span class="badge badge-top-left" style="background: #f97316; color: white;">
										Featured
									</span>
								<?php endif; ?>

								<?php if (!empty($services) && !is_wp_error($services)): ?>
									<span class="badge badge-top-left" style="top: 35px;">
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
							'prev_text' => '← Previous',
							'next_text' => 'Next →',
							'mid_size' => 2,
							'show_all' => true,
						));
						?>
					</div>

				<?php else: ?>
					<p style="grid-column: 1 / -1; text-align:center;">No projects found.</p>
				<?php endif; ?>

				<?php wp_reset_postdata(); ?>

			</div>
		</div>
	</section>

</main><!-- #primary -->

<?php
get_footer();