<?php
/*
Template Name: About Us Page Template
*/

/**
 * Template for About Us pages
 * This template can be selected in the WordPress page editor
 *
 * @package Biz-Catalog
 */

get_header();
?>

<style>
/* Animation styles for About Us page */
.mission-vision-card {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.mission-vision-card.animate {
    opacity: 1;
    transform: translateY(0);
}

.mission-vision-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
}

.mission-vision-card .fas {
    transition: all 0.3s ease;
}

.mission-vision-card:hover .fas {
    transform: scale(1.1);
    color: #ea580c !important;
}

.fact-item {
    opacity: 0;
    transform: scale(0.8);
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.fact-item.animate {
    opacity: 1;
    transform: scale(1);
}

.team-member-card {
    opacity: 0;
    transform: translateX(-30px);
    transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.team-member-card.animate {
    opacity: 1;
    transform: translateX(0);
}

.team-member-card:nth-child(even) {
    transform: translateX(30px);
}

.team-member-card:nth-child(even).animate {
    transform: translateX(0);
}

.service-card {
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.service-card.animate {
    opacity: 1;
    transform: translateY(0);
}

/* Enhanced Story Section Styling */
.story-section {
    position: relative;
    overflow: hidden;
}

.story-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: -50%;
    width: 200%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(249, 115, 22, 0.02), transparent);
    animation: storyShimmer 8s infinite;
    pointer-events: none;
}

@keyframes storyShimmer {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
}

.story-text {
    position: relative;
    font-size: 1.1rem;
    line-height: 1.8;
    color: #374151;
    max-width: 800px;
    margin: 0 auto;
    opacity: 0;
    transform: translateY(30px);
    transition: all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.story-text.animate {
    opacity: 1;
    transform: translateY(0);
}

.story-text p {
    margin-bottom: 2rem;
    position: relative;
    padding-left: 2rem;
    border-left: 3px solid #f97316;
    background: linear-gradient(135deg, rgba(249, 115, 22, 0.03), rgba(249, 115, 22, 0.01));
    padding: 1.5rem 2rem 1.5rem 2rem;
    border-radius: 0 12px 12px 0;
    transition: all 0.3s ease;
}

.story-text p:hover {
    transform: translateX(10px);
    box-shadow: 0 8px 25px rgba(249, 115, 22, 0.1);
    border-left-color: #ea580c;
}

.story-text p:first-child::before {
    content: '"';
    position: absolute;
    left: -0.5rem;
    top: -0.5rem;
    font-size: 4rem;
    color: #f97316;
    font-family: Georgia, serif;
    line-height: 1;
    opacity: 0.3;
}

.story-text p strong {
    color: #111827;
    font-weight: 600;
    position: relative;
}

.story-text p strong::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 100%;
    height: 2px;
    background: linear-gradient(90deg, #f97316, #ea580c);
    border-radius: 2px;
}

.story-highlight {
    background: linear-gradient(135deg, #f97316, #ea580c);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    font-weight: 700;
    position: relative;
}

.story-timeline {
    position: relative;
    margin: 3rem 0;
    padding: 2rem;
    background: #ffffff;
    border-radius: 16px;
    box-shadow: 0 10px 40px rgba(15, 23, 42, 0.08);
}

.story-timeline::before {
    content: '';
    position: absolute;
    left: 2rem;
    top: 1rem;
    bottom: 1rem;
    width: 2px;
    background: linear-gradient(180deg, #f97316, #ea580c);
}

.timeline-item {
    position: relative;
    padding-left: 4rem;
    margin-bottom: 2rem;
    opacity: 0;
    transform: translateX(-30px);
    transition: all 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}

.timeline-item.animate {
    opacity: 1;
    transform: translateX(0);
}

.timeline-item::before {
    content: '';
    position: absolute;
    left: 1.5rem;
    top: 0.5rem;
    width: 12px;
    height: 12px;
    background: #f97316;
    border-radius: 50%;
    border: 3px solid #ffffff;
    box-shadow: 0 0 0 3px rgba(249, 115, 22, 0.2);
}

.timeline-year {
    font-size: 1.2rem;
    font-weight: 700;
    color: #f97316;
    margin-bottom: 0.5rem;
}

.timeline-content {
    background: rgba(249, 115, 22, 0.05);
    padding: 1rem 1.5rem;
    border-radius: 8px;
    border-left: 3px solid #f97316;
}

.story-stats {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin: 3rem 0;
    padding: 2rem;
    background: linear-gradient(135deg, rgba(249, 115, 22, 0.05), rgba(234, 88, 12, 0.03));
    border-radius: 16px;
    border: 1px solid rgba(249, 115, 22, 0.1);
}

.stat-item {
    text-align: center;
    padding: 1rem;
    background: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    transition: all 0.3s ease;
}

.stat-item:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 25px rgba(249, 115, 22, 0.15);
}

.stat-number {
    font-size: 2.5rem;
    font-weight: 700;
    background: linear-gradient(135deg, #f97316, #ea580c);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    display: block;
    margin-bottom: 0.5rem;
}

.stat-label {
    font-size: 0.9rem;
    color: #6b7280;
    font-weight: 500;
}

/* Staggered animation delays */
.mission-vision-card:nth-child(1) { transition-delay: 0.1s; }
.mission-vision-card:nth-child(2) { transition-delay: 0.2s; }
.mission-vision-card:nth-child(3) { transition-delay: 0.3s; }

.fact-item:nth-child(1) { transition-delay: 0.1s; }
.fact-item:nth-child(2) { transition-delay: 0.2s; }
.fact-item:nth-child(3) { transition-delay: 0.3s; }
.fact-item:nth-child(4) { transition-delay: 0.4s; }

.team-member-card:nth-child(1) { transition-delay: 0.1s; }
.team-member-card:nth-child(2) { transition-delay: 0.2s; }
.team-member-card:nth-child(3) { transition-delay: 0.3s; }

.service-card:nth-child(1) { transition-delay: 0.1s; }
.service-card:nth-child(2) { transition-delay: 0.2s; }
.service-card:nth-child(3) { transition-delay: 0.3s; }
.service-card:nth-child(4) { transition-delay: 0.4s; }

.story-text:nth-child(1) { transition-delay: 0.1s; }
.story-text:nth-child(2) { transition-delay: 0.2s; }
.story-text:nth-child(3) { transition-delay: 0.3s; }
.story-text:nth-child(4) { transition-delay: 0.4s; }

.timeline-item:nth-child(1) { transition-delay: 0.1s; }
.timeline-item:nth-child(2) { transition-delay: 0.2s; }
.timeline-item:nth-child(3) { transition-delay: 0.3s; }
.timeline-item:nth-child(4) { transition-delay: 0.4s; }

.stat-item:nth-child(1) { transition-delay: 0.1s; }
.stat-item:nth-child(2) { transition-delay: 0.2s; }
.stat-item:nth-child(3) { transition-delay: 0.3s; }
.stat-item:nth-child(4) { transition-delay: 0.4s; }

/* Mobile responsiveness for story section */
@media (max-width: 768px) {
    .story-text p {
        padding-left: 1rem;
        padding: 1rem 1.5rem 1rem 1rem;
        margin-bottom: 1.5rem;
    }
    
    .story-text p:first-child::before {
        left: -0.2rem;
        font-size: 3rem;
    }
    
    .story-timeline {
        padding: 1.5rem 1rem;
        margin: 2rem 0;
    }
    
    .story-timeline::before {
        left: 1rem;
    }
    
    .timeline-item {
        padding-left: 3rem;
    }
    
    .timeline-item::before {
        left: 0.5rem;
    }
    
    .story-stats {
        grid-template-columns: 1fr 1fr;
        gap: 1rem;
        padding: 1.5rem;
    }
    
    .stat-number {
        font-size: 2rem;
    }
}
</style>

<main id="primary" class="site-main">

	<!-- HERO -->
	<section id="hero" class="hero">
		<div class="hero-overlay"></div>
		<?php
		$hero_image = get_field('about_hero_image', 'option');
		$hero_image_url = $hero_image ? $hero_image['url'] : "https://placehold.co/1600x700?text=About+Us+Hero+Image";
		$hero_image_alt = $hero_image ? $hero_image['alt'] : 'About us hero background image';
		?>
		<img src="<?php echo esc_url($hero_image_url); ?>" alt="<?php echo esc_attr($hero_image_alt); ?>"
			class="hero-bg" />
		<div class="container hero-content">
			<?php if ($hero_kicker = get_field('about_hero_kicker', 'option')) : ?>
			<p class="hero-kicker"><?php echo esc_html($hero_kicker); ?></p>
			<?php else : ?>
			<p class="hero-kicker">About Our Company</p>
			<?php endif; ?>
			<?php if ($hero_title = get_field('about_hero_title', 'option')) : ?>
			<h1><?php echo esc_html($hero_title); ?></h1>
			<?php else : ?>
			<h1>About Us</h1>
			<?php endif; ?>
			<?php if ($hero_subtitle = get_field('about_hero_subtitle', 'option')) : ?>
			<p class="hero-subtitle">
				<?php echo esc_html($hero_subtitle); ?>
			</p>
			<?php else : ?>
			<p class="hero-subtitle">
				Learn more about our company, our mission, and the team behind our success.
			</p>
			<?php endif; ?>
			<div class="hero-actions">
				<a href="#our-story" class="btn btn-primary">Our Story</a>
				<a href="#contact" class="btn btn-outline">Contact Us</a>
			</div>
		</div>
	</section>

	<!-- COMPANY STORY -->
	<section id="our-story" class="section story-section">
		<div class="container">
			<header class="section-header">
				<?php if ($story_title = get_field('about_story_title', 'option')) : ?>
				<h2><?php echo esc_html($story_title); ?></h2>
				<?php else : ?>
				<h2>Our Story</h2>
				<?php endif; ?>
				<?php if ($story_description = get_field('about_story_description', 'option')) : ?>
				<p><?php echo esc_html($story_description); ?></p>
				<?php else : ?>
				<p>Discover how we became who we are today</p>
				<?php endif; ?>
			</header>
			<div class="about-story-content">
				<?php if ($story_content = get_field('about_story_content', 'option')) : ?>
				<div class="story-text">
					<?php echo wp_kses_post($story_content); ?>
				</div>
				<?php else : ?>
				<div class="story-text">
					<p>
						We started as a <span class="story-highlight">small team with a big vision</span>: to transform spaces and create
						environments that inspire and enhance people's lives. Founded in 2024, our
						company has grown from humble beginnings into a trusted name in the industry.
					</p>
					<p>
						Our journey began with a simple belief that great design should be accessible
						to everyone. Today, we continue to uphold this principle while expanding our
						services and capabilities to meet the evolving needs of our clients.
					</p>
					<p>
						What sets us apart is our commitment to <strong>quality, innovation, and customer
						satisfaction</strong>. We don't just complete projects – we build lasting relationships
						and create spaces that tell your unique story.
					</p>
				</div>
				<?php endif; ?>
				
				<!-- Story Timeline -->
				<div class="story-timeline">
					<h3 style="text-align: center; margin-bottom: 2rem; color: #111827; font-size: 1.4rem;">Our Journey</h3>
					<div class="timeline-item">
						<div class="timeline-year">2024</div>
						<div class="timeline-content">
							<strong>The Beginning</strong><br>
							Founded with a vision to transform spaces and create inspiring environments
						</div>
					</div>
					<div class="timeline-item">
						<div class="timeline-year">Mid 2024</div>
						<div class="timeline-content">
							<strong>First Milestone</strong><br>
							Completed our first major project and established our core values
						</div>
					</div>
					<div class="timeline-item">
						<div class="timeline-year">Late 2024</div>
						<div class="timeline-content">
							<strong>Team Expansion</strong><br>
							Grew our team with talented designers and project managers
						</div>
					</div>
					<div class="timeline-item">
						<div class="timeline-year">Today</div>
						<div class="timeline-content">
							<strong>Continuous Growth</strong><br>
							Serving satisfied clients and expanding our creative capabilities
						</div>
					</div>
				</div>
				
				<!-- Story Stats -->
				<div class="story-stats">
					<div class="stat-item">
						<span class="stat-number">100%</span>
						<span class="stat-label">Client Satisfaction</span>
					</div>
					<div class="stat-item">
						<span class="stat-number">24/7</span>
						<span class="stat-label">Support Available</span>
					</div>
					<div class="stat-item">
						<span class="stat-number">5★</span>
						<span class="stat-label">Average Rating</span>
					</div>
					<div class="stat-item">
						<span class="stat-number">∞</span>
						<span class="stat-label">Possibilities</span>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- MISSION, VISION, VALUES -->
	<section id="mission-vision" class="section section-light">
		<div class="container">
			<header class="section-header">
				<h2>What Drives Us</h2>
				<p>Our mission, vision, and core values</p>
			</header>
			<div class="grid grid-3">
				<div class="card mission-vision-card" style="text-align: center; padding: 2rem;">
					<i class="fas fa-bullseye" style="font-size: 3rem; color: #f97316; margin-bottom: 1rem;"></i>
					<h3>Our Mission</h3>
					<?php if ($mission_content = get_field('about_mission', 'option')) : ?>
					<p><?php echo esc_html($mission_content); ?></p>
					<?php else : ?>
					<p>To deliver exceptional design solutions that exceed our clients' expectations while maintaining the highest standards of quality and professionalism.</p>
					<?php endif; ?>
				</div>
				<div class="card mission-vision-card" style="text-align: center; padding: 2rem;">
					<i class="fas fa-eye" style="font-size: 3rem; color: #f97316; margin-bottom: 1rem;"></i>
					<h3>Our Vision</h3>
					<?php if ($vision_content = get_field('about_vision', 'option')) : ?>
					<p><?php echo esc_html($vision_content); ?></p>
					<?php else : ?>
					<p>To be the leading design company recognized for innovation, creativity, and our positive impact on the spaces and lives we touch.</p>
					<?php endif; ?>
				</div>
				<div class="card mission-vision-card" style="text-align: center; padding: 2rem;">
					<i class="fas fa-heart" style="font-size: 3rem; color: #f97316; margin-bottom: 1rem;"></i>
					<h3>Our Values</h3>
					<?php if ($values_content = get_field('about_values', 'option')) : ?>
					<p><?php echo esc_html($values_content); ?></p>
					<?php else : ?>
					<p>Integrity, Excellence, Innovation, and Customer-Centricity guide everything we do and every decision we make.</p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- KEY FACTS -->
	<section id="key-facts" class="section">
		<div class="container">
			<header class="section-header">
				<h2>Key Facts About Us</h2>
				<p>Numbers that tell our story</p>
			</header>
			<div class="grid grid-4">
				<?php
				$facts = get_field('about_facts', 'option');
				if ($facts && is_array($facts)):
				 foreach ($facts as $fact):
				?>
				<div class="card fact-item" style="text-align: center; padding: 2rem;">
					<div class="fact-number" style="font-size: 2.5rem; font-weight: bold; color: #f97316; margin-bottom: 0.5rem;">
						<?php echo esc_html($fact['value']); ?>
					</div>
					<div class="fact-label" style="font-size: 1rem; color: #6b7280;">
						<?php echo esc_html($fact['label']); ?>
					</div>
				</div>
				<?php
					endforeach;
				else:
				?>
				<div class="card fact-item" style="text-align: center; padding: 2rem;">
					<div class="fact-number" style="font-size: 2.5rem; font-weight: bold; color: #f97316; margin-bottom: 0.5rem;">2024</div>
					<div class="fact-label" style="font-size: 1rem; color: #6b7280;">Year Established</div>
				</div>
				<div class="card fact-item" style="text-align: center; padding: 2rem;">
					<div class="fact-number" style="font-size: 2.5rem; font-weight: bold; color: #f97316; margin-bottom: 0.5rem;">10+</div>
					<div class="fact-label" style="font-size: 1rem; color: #6b7280;">Expert Team Members</div>
				</div>
				<div class="card fact-item" style="text-align: center; padding: 2rem;">
					<div class="fact-number" style="font-size: 2.5rem; font-weight: bold; color: #f97316; margin-bottom: 0.5rem;">100+</div>
					<div class="fact-label" style="font-size: 1rem; color: #6b7280;">Projects Completed</div>
				</div>
				<div class="card fact-item" style="text-align: center; padding: 2rem;">
					<div class="fact-number" style="font-size: 2.5rem; font-weight: bold; color: #f97316; margin-bottom: 0.5rem;">50+</div>
					<div class="fact-label" style="font-size: 1rem; color: #6b7280;">Happy Clients</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- TEAM SECTION -->
	<section id="our-team" class="section section-light">
		<div class="container">
			<header class="section-header">
				<?php if ($team_title = get_field('about_team_title', 'option')) : ?>
				<h2><?php echo esc_html($team_title); ?></h2>
				<?php else : ?>
				<h2>Meet Our Team</h2>
				<?php endif; ?>
				<?php if ($team_description = get_field('about_team_description', 'option')) : ?>
				<p><?php echo esc_html($team_description); ?></p>
				<?php else : ?>
				<p>The talented individuals behind our success</p>
				<?php endif; ?>
			</header>
			<div class="grid grid-3">
				<?php
				$team_members = get_field('about_team_members', 'option');
				if ($team_members && is_array($team_members)):
				 foreach ($team_members as $member):
				?>
				<article class="card team-member-card">
					<?php if ($member['photo']): ?>
					<img src="<?php echo esc_url($member['photo']['url']); ?>" alt="<?php echo esc_attr($member['name']); ?>" class="team-photo">
					<?php else: ?>
					<img src="https://placehold.co/300x300?text=Team+Member" alt="Team Member" class="team-photo">
					<?php endif; ?>
					<div class="card-body">
						<h4><?php echo esc_html($member['name']); ?></h4>
						<p class="team-role" style="color: #f97316; font-weight: 600; margin-bottom: 1rem;"><?php echo esc_html($member['role']); ?></p>
						<p class="team-bio"><?php echo esc_html($member['bio']); ?></p>
					</div>
				</article>
				<?php
					endforeach;
				else:
				?>
				<article class="card team-member-card">
					<img src="https://placehold.co/300x300?text=John+Doe" alt="John Doe" class="team-photo">
					<div class="card-body">
						<h4>John Doe</h4>
						<p class="team-role" style="color: #f97316; font-weight: 600; margin-bottom: 1rem;">Founder & CEO</p>
						<p class="team-bio">With over 15 years of experience in design and construction, John leads our team with passion and vision.</p>
					</div>
				</article>
				<article class="card team-member-card">
					<img src="https://placehold.co/300x300?text=Jane+Smith" alt="Jane Smith" class="team-photo">
					<div class="card-body">
						<h4>Jane Smith</h4>
						<p class="team-role" style="color: #f97316; font-weight: 600; margin-bottom: 1rem;">Creative Director</p>
						<p class="team-bio">Jane brings innovative design concepts to life with her creative expertise and attention to detail.</p>
					</div>
				</article>
				<article class="card team-member-card">
					<img src="https://placehold.co/300x300?text=Mike+Johnson" alt="Mike Johnson" class="team-photo">
					<div class="card-body">
						<h4>Mike Johnson</h4>
						<p class="team-role" style="color: #f97316; font-weight: 600; margin-bottom: 1rem;">Project Manager</p>
						<p class="team-bio">Mike ensures every project is delivered on time and to the highest quality standards.</p>
					</div>
				</article>
				<?php endif; ?>
			</div>
		</div>
	</section>

	<!-- SERVICES OVERVIEW -->
	<section id="services-overview" class="section">
		<div class="container">
			<header class="section-header">
				<h2>What We Do</h2>
				<p>Our comprehensive range of services</p>
			</header>
			<div class="grid grid-4">
				<?php
				$services = get_terms(array(
					'taxonomy' => 'service',
					'hide_empty' => false,
				));

				if (!empty($services) && !is_wp_error($services)):
				 foreach ($services as $service):
					$image = get_field('service_image', 'service_' . $service->term_id);
					$image_url = $image ? $image['url'] : "https://placehold.co/300x200?text=" . urlencode($service->name);
				?>
				<a href="<?php echo esc_url(get_term_link($service)); ?>" class="card service-card">
					<img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($service->name); ?>">
					<div class="card-body">
						<h4><?php echo esc_html($service->name); ?></h4>
						<p><?php echo esc_html(wp_trim_words($service->description, 15)); ?></p>
					</div>
				</a>
				<?php
					endforeach;
				else:
				?>
				<a href="#" class="card service-card">
					<img src="https://placehold.co/300x200?text=Service+1" alt="Service 1">
					<div class="card-body">
						<h4>Interior Design</h4>
						<p>Complete interior design solutions for residential and commercial spaces.</p>
					</div>
				</a>
				<a href="#" class="card service-card">
					<img src="https://placehold.co/300x200?text=Service+2" alt="Service 2">
					<div class="card-body">
						<h4>Furniture Design</h4>
						<p>Custom furniture design and manufacturing to fit your unique style.</p>
					</div>
				</a>
				<a href="#" class="card service-card">
					<img src="https://placehold.co/300x200?text=Service+3" alt="Service 3">
					<div class="card-body">
						<h4>Space Planning</h4>
						<p>Optimize your space for functionality and aesthetic appeal.</p>
					</div>
				</a>
				<a href="#" class="card service-card">
					<img src="https://placehold.co/300x200?text=Service+4" alt="Service 4">
					<div class="card-body">
						<h4>Consultation</h4>
						<p>Professional design consultation to bring your vision to life.</p>
					</div>
				</a>
				<?php endif; ?>
			</div>
			
			<!-- All Services Button -->
			<div class="text-center" style="margin-top: 3rem;">
				<a href="<?php echo esc_url(home_url('/services/')); ?>" class="btn btn-primary btn-large">
					View All Services
				</a>
			</div>
		</div>
	</section>

	<!-- CONTACT -->
	<section id="contact" class="section section-light">
		<div class="container contact-grid">
			<div>
				<?php if ($contact_title = get_field('contact_title', 'option')) : ?>
				<h2><?php echo esc_html($contact_title); ?></h2>
				<?php else : ?>
				<h2>Get In Touch</h2>
				<?php endif; ?>
				<?php if ($contact_description = get_field('contact_description', 'option')) : ?>
				<p><?php echo esc_html($contact_description); ?></p>
				<?php else : ?>
				<p>Ready to start your project? Contact us today for a consultation.</p>
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
							<label for="message">Message</label>
							<textarea id="message" rows="4" placeholder="Tell us about your project"></textarea>
						</div>
						<button type="submit" class="btn btn-primary">Send Message</button>
					</form>
					<?php
				}
				?>
			</div>

			<div class="contact-details">
				<h3>Contact Information</h3>
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

<script>
// Scroll-triggered animations for About Us page
document.addEventListener('DOMContentLoaded', function() {
    // Create intersection observer for animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            }
        });
    }, observerOptions);

    // Observe all animated elements
    const animatedElements = document.querySelectorAll(
        '.mission-vision-card, .fact-item, .team-member-card, .service-card, .story-text, .timeline-item, .stat-item'
    );
    
    animatedElements.forEach(el => observer.observe(el));

    // Add hover effect to mission/vision cards
    const missionCards = document.querySelectorAll('.mission-vision-card');
    missionCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });

    // Animate numbers counting up for facts section
    const factNumbers = document.querySelectorAll('.fact-number');
    const numberObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = entry.target;
                const finalNumber = target.textContent;
                
                // Check if it's a number
                if (!isNaN(finalNumber.replace(/\D/g, ''))) {
                    const number = parseInt(finalNumber.replace(/\D/g, ''));
                    const suffix = finalNumber.replace(/\d/g, '');
                    
                    animateNumber(target, 0, number, 2000, suffix);
                }
                
                numberObserver.unobserve(target);
            }
        });
    }, { threshold: 0.5 });

    factNumbers.forEach(num => numberObserver.observe(num));
});

// Number animation function
function animateNumber(element, start, end, duration, suffix) {
    const startTime = performance.now();
    
    function update(currentTime) {
        const elapsed = currentTime - startTime;
        const progress = Math.min(elapsed / duration, 1);
        
        // Easing function for smooth animation
        const easeOutCubic = 1 - Math.pow(1 - progress, 3);
        const current = Math.floor(start + (end - start) * easeOutCubic);
        
        element.textContent = current + suffix;
        
        if (progress < 1) {
            requestAnimationFrame(update);
        }
    }
    
    requestAnimationFrame(update);
}
</script>

<?php
get_footer();