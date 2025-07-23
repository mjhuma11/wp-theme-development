<?php get_header(); ?>

<!-- Carousel Section -->
<section id="carousel_section">
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1"></button>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2"></button>
        </div>
        <div class="carousel-inner">
            <?php
            // Get carousel posts
            $carousel_posts = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'meta_query' => array(
                    array(
                        'key' => 'featured_post',
                        'value' => 'yes',
                        'compare' => '='
                    )
                )
            ));
            
            $counter = 0;
            if($carousel_posts->have_posts()) : 
                while($carousel_posts->have_posts()) : $carousel_posts->the_post();
                    $counter++;
            ?>
            <div class="carousel-item <?php echo ($counter == 1) ? 'active' : ''; ?>">
                <?php if(has_post_thumbnail()) : ?>
                    <?php the_post_thumbnail('full', array('class' => 'd-block w-100', 'style' => 'height: 500px; object-fit: cover;')); ?>
                <?php else : ?>
                    <img src="<?php echo get_template_directory_uri(); ?>/images/img(1).jpg" class="d-block w-100" alt="Default Slide" style="height: 500px; object-fit: cover;">
                <?php endif; ?>
                <div class="carousel-caption d-none d-md-block">
                    <h5><?php the_title(); ?></h5>
                    <p><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                    <a href="<?php the_permalink(); ?>" class="btn btn-primary">Read More</a>
                </div>
            </div>
            <?php 
                endwhile; 
                wp_reset_postdata();
            else : 
            ?>
            <!-- Default slides if no featured posts -->
            <div class="carousel-item active">
                <img src="<?php echo get_template_directory_uri(); ?>/images/slide1.jpg" class="d-block w-100" alt="Slide 1" style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Welcome to <?php bloginfo('name'); ?></h5>
                    <p>Your amazing website description goes here.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?php echo get_template_directory_uri(); ?>/images/slide2.jpg" class="d-block w-100" alt="Slide 2" style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Our Services</h5>
                    <p>Discover what we can do for you.</p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="<?php echo get_template_directory_uri(); ?>/images/slide3.jpg" class="d-block w-100" alt="Slide 3" style="height: 500px; object-fit: cover;">
                <div class="carousel-caption d-none d-md-block">
                    <h5>Get In Touch</h5>
                    <p>Contact us for more information.</p>
                </div>
            </div>
            <?php endif; ?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</section>

<!-- Latest Posts Section -->
<section id="latest_posts" class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center mb-5">
                <h2 class="section-title">Latest Posts</h2>
                <p class="section-subtitle">Stay updated with our latest articles and news</p>
            </div>
        </div>
        <div class="row">
            <?php
            $latest_posts = new WP_Query(array(
                'post_type' => 'post',
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC'
            ));
            
            if($latest_posts->have_posts()) :
                while($latest_posts->have_posts()) : $latest_posts->the_post();
                    $pdf_url = get_post_meta(get_the_ID(), 'j_post_pdf', true);
                    $download_url = $pdf_url ? add_query_arg(array(
                        'action' => 'download_pdf',
                        'post_id' => get_the_ID(),
                        'nonce' => wp_create_nonce('download_pdf_' . get_the_ID())
                    ), home_url()) : '';
            ?>
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <?php if(has_post_thumbnail()) : ?>
                        <div class="card-img-wrapper">
                            <?php the_post_thumbnail('medium', array('class' => 'card-img-top', 'style' => 'height: 200px; object-fit: cover;')); ?>
                        </div>
                    <?php else : ?>
                        <img src="<?php echo get_template_directory_uri(); ?>/images/default-post.jpg" class="card-img-top" alt="Default Post" style="height: 200px; object-fit: cover;">
                    <?php endif; ?>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php the_title(); ?></h5>
                        <p class="card-text text-muted small">
                            <i class="bi bi-calendar"></i> <?php echo get_the_date(); ?> | 
                            <i class="bi bi-person"></i> <?php the_author(); ?>
                        </p>
                        <p class="card-text flex-grow-1"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></p>
                        <a href="<?php the_permalink(); ?>" class="btn btn-primary mt-auto">Read More</a>
                        <?php if($pdf_url) : ?>
                            <a href="<?php echo esc_url($download_url); ?>" class="btn btn-outline-secondary mt-2">Download PDF</a>
                        <?php else : ?>
                            <button class="btn btn-outline-secondary mt-2" disabled>No PDF Available</button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php 
                endwhile; 
                wp_reset_postdata();
            endif; 
            ?>
        </div>
        <div class="row">
            <div class="col-12 text-center mt-4">
                <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="btn btn-outline-primary">View All Posts</a>
            </div>
        </div>
    </div>
</section>

<!-- Featured Image Section -->
<section id="featured_section" class="py-5 bg-light">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="featured-image">
                    <?php 
                    $featured_image = get_theme_mod('j_featured_image', get_template_directory_uri() . '/images/featured-image.jpg');
                    ?>
                    <img src="<?php echo $featured_image; ?>" alt="Featured Image" class="img-fluid rounded shadow">
                </div>
            </div>
            <div class="col-md-6">
                <div class="featured-content">
                    <h2><?php echo get_theme_mod('j_featured_title', 'About Our Company'); ?></h2>
                    <p class="lead"><?php echo get_theme_mod('j_featured_subtitle', 'We are dedicated to providing excellent services'); ?></p>
                    <p><?php echo get_theme_mod('j_featured_description', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris.'); ?></p>
                    <div class="featured-stats mt-4">
                        <div class="row text-center">
                            <div class="col-4">
                                <h3 class="text-primary"><?php echo get_theme_mod('j_stat_1_number', '100+'); ?></h3>
                                <p class="small"><?php echo get_theme_mod('j_stat_1_text', 'Projects'); ?></p>
                            </div>
                            <div class="col-4">
                                <h3 class="text-primary"><?php echo get_theme_mod('j_stat_2_number', '50+'); ?></h3>
                                <p class="small"><?php echo get_theme_mod('j_stat_2_text', 'Clients'); ?></p>
                            </div>
                            <div class="col-4">
                                <h3 class="text-primary"><?php echo get_theme_mod('j_stat_3_number', '5+'); ?></h3>
                                <p class="small"><?php echo get_theme_mod('j_stat_3_text', 'Years'); ?></p>
                            </div>
                        </div>
                    </div>
                    <?php if(get_theme_mod('j_featured_button_text', 'Learn More')) : ?>
                    <a href="<?php echo get_theme_mod('j_featured_button_url', '#'); ?>" class="btn btn-primary mt-3">
                        <?php echo get_theme_mod('j_featured_button_text', 'Learn More'); ?>
                    </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>