<?php get_header(); ?>

<div class="container my-5">
    <div class="row">
        <div class="col-lg-8">
            <?php if(have_posts()) : ?>
                <?php while(have_posts()) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('mb-5'); ?>>
                        <!-- Post Header -->
                        <header class="post-header mb-4">
                            <h1 class="post-title mb-3"><?php the_title(); ?></h1>
                            <div class="post-meta d-flex flex-wrap align-items-center text-muted mb-4">
                                <span class="me-4">
                                    <i class="bi bi-calendar me-1"></i>
                                    <?php echo get_the_date(); ?>
                                </span>
                                <span class="me-4">
                                    <i class="bi bi-person me-1"></i>
                                    <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" class="text-decoration-none">
                                        <?php the_author(); ?>
                                    </a>
                                </span>
                                <span class="me-4">
                                    <i class="bi bi-folder me-1"></i>
                                    <?php the_category(', '); ?>
                                </span>
                                <?php if(has_tag()) : ?>
                                <span>
                                    <i class="bi bi-tags me-1"></i>
                                    <?php the_tags('', ', ', ''); ?>
                                </span>
                                <?php endif; ?>
                            </div>
                        </header>

                        <!-- Featured Image -->
                        <?php if(has_post_thumbnail()) : ?>
                        <div class="post-thumbnail mb-4">
                            <?php the_post_thumbnail('large', array('class' => 'img-fluid rounded shadow')); ?>
                        </div>
                        <?php endif; ?>

                        <!-- Post Content -->
                        <div class="post-content">
                            <?php the_content(); ?>
                        </div>

                        <!-- Post Navigation -->
                        <div class="post-navigation mt-5 pt-4 border-top">
                            <div class="row">
                                <div class="col-md-6">
                                    <?php 
                                    $prev_post = get_previous_post();
                                    if($prev_post) : 
                                    ?>
                                    <div class="nav-previous">
                                        <h6 class="text-muted mb-2">Previous Post</h6>
                                        <a href="<?php echo get_permalink($prev_post->ID); ?>" class="text-decoration-none">
                                            <i class="bi bi-arrow-left me-2"></i>
                                            <?php echo get_the_title($prev_post->ID); ?>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-6 text-end">
                                    <?php 
                                    $next_post = get_next_post();
                                    if($next_post) : 
                                    ?>
                                    <div class="nav-next">
                                        <h6 class="text-muted mb-2">Next Post</h6>
                                        <a href="<?php echo get_permalink($next_post->ID); ?>" class="text-decoration-none">
                                            <?php echo get_the_title($next_post->ID); ?>
                                            <i class="bi bi-arrow-right ms-2"></i>
                                        </a>
                                    </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>

                        <!-- Author Bio -->
                        <div class="author-bio mt-5 p-4 bg-light rounded">
                            <div class="row align-items-center">
                                <div class="col-auto">
                                    <?php echo get_avatar(get_the_author_meta('ID'), 80, '', '', array('class' => 'rounded-circle')); ?>
                                </div>
                                <div class="col">
                                    <h5 class="mb-2"><?php the_author(); ?></h5>
                                    <p class="mb-0"><?php the_author_meta('description'); ?></p>
                                </div>
                            </div>
                        </div>
                    </article>

                    <!-- Comments -->
                    <?php
                    if(comments_open() || get_comments_number()) :
                        comments_template();
                    endif;
                    ?>

                <?php endwhile; ?>
            <?php endif; ?>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <aside class="sidebar">
                <!-- Search Widget -->
                <div class="widget mb-4">
                    <h5 class="widget-title">Search</h5>
                    <form class="d-flex" method="get" action="<?php echo home_url(); ?>">
                        <input class="form-control me-2" type="search" placeholder="Search posts..." name="s" value="<?php echo get_search_query(); ?>">
                        <button class="btn btn-outline-primary" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </form>
                </div>

                <!-- Recent Posts -->
                <div class="widget mb-4">
                    <h5 class="widget-title">Recent Posts</h5>
                    <ul class="list-unstyled">
                        <?php
                        $recent_posts = new WP_Query(array(
                            'post_type' => 'post',
                            'posts_per_page' => 5,
                            'post__not_in' => array(get_the_ID()),
                        ));
                        
                        if($recent_posts->have_posts()) :
                            while($recent_posts->have_posts()) : $recent_posts->the_post();
                        ?>
                        <li class="mb-3">
                            <div class="d-flex">
                                <?php if(has_post_thumbnail()) : ?>
                                <div class="flex-shrink-0 me-3">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('thumbnail', array('class' => 'rounded', 'style' => 'width: 60px; height: 60px; object-fit: cover;')); ?>
                                    </a>
                                </div>
                                <?php endif; ?>
                                <div class="flex-grow-1">
                                    <h6 class="mb-1">
                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                            <?php echo wp_trim_words(get_the_title(), 5); ?>
                                        </a>
                                    </h6>
                                    <small class="text-muted"><?php echo get_the_date(); ?></small>
                                </div>
                            </div>
                        </li>
                        <?php 
                            endwhile; 
                            wp_reset_postdata();
                        endif; 
                        ?>
                    </ul>
                </div>

                <!-- Categories -->
                <div class="widget mb-4">
                    <h5 class="widget-title">Categories</h5>
                    <ul class="list-unstyled">
                        <?php
                        $categories = get_categories();
                        foreach($categories as $category) :
                        ?>
                        <li class="mb-2">
                            <a href="<?php echo get_category_link($category->term_id); ?>" class="text-decoration-none d-flex justify-content-between">
                                <span><?php echo $category->name; ?></span>
                                <span class="badge bg-primary"><?php echo $category->count; ?></span>
                            </a>
                        </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Tags -->
                <?php
                $tags = get_tags();
                if($tags) :
                ?>
                <div class="widget mb-4">
                    <h5 class="widget-title">Tags</h5>
                    <div class="tag-cloud">
                        <?php foreach($tags as $tag) : ?>
                        <a href="<?php echo get_tag_link($tag->term_id); ?>" class="badge bg-light text-dark me-2 mb-2 text-decoration-none">
                            <?php echo $tag->name; ?>
                        </a>
                        <?php endforeach; ?>
                    </div>
                </div>
                <?php endif; ?>

                <!-- Archive -->
                <div class="widget mb-4">
                    <h5 class="widget-title">Archive</h5>
                    <ul class="list-unstyled">
                        <?php wp_get_archives(array('type' => 'monthly', 'limit' => 12)); ?>
                    </ul>
                </div>

                <?php if(is_active_sidebar('blog-sidebar')) : ?>
                    <?php dynamic_sidebar('blog-sidebar'); ?>
                <?php endif; ?>
            </aside>
        </div>
    </div>
</div>

<?php get_footer(); ?>