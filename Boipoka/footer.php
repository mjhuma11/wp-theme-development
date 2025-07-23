<!-- Footer Section -->
    <footer id="footer_area" class="bg-dark text-light py-5">
        <div class="container">
            <div class="row">
                <!-- Logo and Description -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="footer-widget">
                        <img src="<?php echo get_theme_mod('j_logo', get_template_directory_uri() . '/images/f-logo.png'); ?>" 
                             alt="<?php bloginfo('name'); ?>" 
                             class="footer-logo mb-3" 
                             style="max-width: 150px;">
                        <p><?php echo get_theme_mod('j_footer_description', get_bloginfo('description')); ?></p>
                        <div class="social-links">
                            <?php if(get_theme_mod('j_facebook_url')) : ?>
                                <a href="<?php echo get_theme_mod('j_facebook_url'); ?>" class="text-light me-3">
                                    <i class="bi bi-facebook"></i>
                                </a>
                            <?php endif; ?>
                            <?php if(get_theme_mod('j_twitter_url')) : ?>
                                <a href="<?php echo get_theme_mod('j_twitter_url'); ?>" class="text-light me-3">
                                    <i class="bi bi-twitter"></i>
                                </a>
                            <?php endif; ?>
                            <?php if(get_theme_mod('j_instagram_url')) : ?>
                                <a href="<?php echo get_theme_mod('j_instagram_url'); ?>" class="text-light me-3">
                                    <i class="bi bi-instagram"></i>
                                </a>
                            <?php endif; ?>
                            <?php if(get_theme_mod('j_linkedin_url')) : ?>
                                <a href="<?php echo get_theme_mod('j_linkedin_url'); ?>" class="text-light me-3">
                                    <i class="bi bi-linkedin"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <div class="footer-widget">
                        <h5 class="widget-title">Quick Links</h5>
                        <?php 
                        wp_nav_menu(array(
                            'theme_location' => 'footer_menu',
                            'container' => false,
                            'menu_class' => 'list-unstyled footer-menu',
                            'fallback_cb' => false,
                        )); 
                        ?>
                    </div>
                </div>

                <!-- Recent Posts -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="footer-widget">
                        <h5 class="widget-title">Recent Posts</h5>
                        <ul class="list-unstyled recent-posts">
                            <?php
                            $recent_posts = new WP_Query(array(
                                'post_type' => 'post',
                                'posts_per_page' => 3,
                                'orderby' => 'date',
                                'order' => 'DESC'
                            ));
                            
                            if($recent_posts->have_posts()) :
                                while($recent_posts->have_posts()) : $recent_posts->the_post();
                            ?>
                            <li class="mb-2">
                                <a href="<?php the_permalink(); ?>" class="text-light text-decoration-none">
                                    <small><?php echo wp_trim_words(get_the_title(), 5); ?></small>
                                    <br>
                                    <small class="text-muted"><?php echo get_the_date(); ?></small>
                                </a>
                            </li>
                            <?php 
                                endwhile; 
                                wp_reset_postdata();
                            endif; 
                            ?>
                        </ul>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <div class="footer-widget">
                        <h5 class="widget-title">Contact Info</h5>
                        <div class="contact-info">
                            <?php if(get_theme_mod('j_contact_address')) : ?>
                            <p class="mb-2">
                                <i class="bi bi-geo-alt me-2"></i>
                                <?php echo get_theme_mod('j_contact_address'); ?>
                            </p>
                            <?php endif; ?>
                            
                            <?php if(get_theme_mod('j_contact_phone')) : ?>
                            <p class="mb-2">
                                <i class="bi bi-telephone me-2"></i>
                                <a href="tel:<?php echo get_theme_mod('j_contact_phone'); ?>" class="text-light text-decoration-none">
                                    <?php echo get_theme_mod('j_contact_phone'); ?>
                                </a>
                            </p>
                            <?php endif; ?>
                            
                            <?php if(get_theme_mod('j_contact_email')) : ?>
                            <p class="mb-2">
                                <i class="bi bi-envelope me-2"></i>
                                <a href="mailto:<?php echo get_theme_mod('j_contact_email'); ?>" class="text-light text-decoration-none">
                                    <?php echo get_theme_mod('j_contact_email'); ?>
                                </a>
                            </p>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Copyright -->
            <hr class="my-4">
            <div class="row">
                <div class="col-12 text-center">
                    <p class="mb-0">
                        &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. 
                        <?php echo get_theme_mod('j_copyright_text', 'All rights reserved.'); ?>
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <?php wp_footer(); ?>
</body>
</html>