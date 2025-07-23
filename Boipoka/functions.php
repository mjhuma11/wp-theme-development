<?php
// Theme Functions
add_theme_support('title-tag');
add_theme_support('post-thumbnails');
add_theme_support('menus');
add_theme_support('custom-logo');
add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));

// Enqueue Styles and Scripts
function wpdocs_custom_excerpt(){
    wp_enqueue_style('wpdocs-style', get_template_directory_uri() . '/style.css');
    wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css');
    wp_enqueue_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js', array(), '5.3.7', true);
    wp_enqueue_style('bootstrap-icons', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css');
    wp_enqueue_style('custom', get_template_directory_uri() . '/css/custom.css');

    // jQuery
    wp_enqueue_script('jquery');
    wp_enqueue_script('main', get_template_directory_uri().'/js/main.js', array('jquery'), '1.0.0', true);
}
add_action('wp_enqueue_scripts', 'wpdocs_custom_excerpt');

// Google Fonts Enqueue
function j_add_google_fonts(){
    wp_enqueue_style('j_google_fonts', 'https://fonts.googleapis.com/css2?family=Kaisei+Decol&family=Oswald:wght@300;400;500;600;700&display=swap', false);
}
add_action('wp_enqueue_scripts', 'j_add_google_fonts');

// Theme Customizer
function j_customizar_register($wp_customize){
    
    // Header Area Section
    $wp_customize->add_section('j_header_area', array(
        'title' =>__('Header Area', 'jhuma'),
        'description' => 'If you interested to update your header area, you can do it here.',
        'priority' => 30,
    ));

    $wp_customize->add_setting('j_logo', array(
        'default' => get_template_directory_uri() . '/images/f-logo.png',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'j_logo', array(
        'label' => 'Logo Upload',
        'description' => 'If you interested to change or update your logo you can do it.',
        'section' => 'j_header_area',
    )));
  
    // Menu Position Option
    $wp_customize->add_section('j_menu_option', array(
        'title' => __('Menu Position Option', 'jhuma'),
        'description' => 'If you interested to change your menu position you can do it.',
        'priority' => 31,
    ));

    $wp_customize->add_setting('j_menu_position', array(
        'default' => 'right_menu',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('j_menu_position', array(
        'label' => 'Menu Position',
        'description' => 'Select your menu position',
        'section' => 'j_menu_option',
        'type' => 'radio',
        'choices' => array(
            'left_menu' => 'Left Menu',
            'right_menu' => 'Right Menu',
            'center_menu' => 'Center Menu',
        ),
    ));

    // Featured Section
    $wp_customize->add_section('j_featured_section', array(
        'title' => __('Featured Section', 'jhuma'),
        'description' => 'Customize your featured section content.',
        'priority' => 32,
    ));

    // Featured Image
    $wp_customize->add_setting('j_featured_image', array(
        'default' => get_template_directory_uri() . '/images/featured-image.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'j_featured_image', array(
        'label' => 'Featured Image',
        'description' => 'Upload your featured section image.',
        'section' => 'j_featured_section',
    )));

    // Featured Title
    $wp_customize->add_setting('j_featured_title', array(
        'default' => 'About Our Company',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('j_featured_title', array(
        'label' => 'Featured Title',
        'section' => 'j_featured_section',
        'type' => 'text',
    ));

    // Featured Subtitle
    $wp_customize->add_setting('j_featured_subtitle', array(
        'default' => 'We are dedicated to providing excellent services',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('j_featured_subtitle', array(
        'label' => 'Featured Subtitle',
        'section' => 'j_featured_section',
        'type' => 'text',
    ));

    // Featured Description
    $wp_customize->add_setting('j_featured_description', array(
        'default' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('j_featured_description', array(
        'label' => 'Featured Description',
        'section' => 'j_featured_section',
        'type' => 'textarea',
    ));

    // Statistics
    for($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting('j_stat_'.$i.'_number', array(
            'default' => ($i == 1) ? '100+' : (($i == 2) ? '50+' : '5+'),
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('j_stat_'.$i.'_number', array(
            'label' => 'Statistic '.$i.' Number',
            'section' => 'j_featured_section',
            'type' => 'text',
        ));

        $wp_customize->add_setting('j_stat_'.$i.'_text', array(
            'default' => ($i == 1) ? 'Projects' : (($i == 2) ? 'Clients' : 'Years'),
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('j_stat_'.$i.'_text', array(
            'label' => 'Statistic '.$i.' Text',
            'section' => 'j_featured_section',
            'type' => 'text',
        ));
    }

    // Featured Button
    $wp_customize->add_setting('j_featured_button_text', array(
        'default' => 'Learn More',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('j_featured_button_text', array(
        'label' => 'Button Text',
        'section' => 'j_featured_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('j_featured_button_url', array(
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('j_featured_button_url', array(
        'label' => 'Button URL',
        'section' => 'j_featured_section',
        'type' => 'url',
    ));

    // Footer Section
    $wp_customize->add_section('j_footer_section', array(
        'title' => __('Footer Settings', 'jhuma'),
        'description' => 'Customize your footer content.',
        'priority' => 33,
    ));

    // Footer Description
    $wp_customize->add_setting('j_footer_description', array(
        'default' => get_bloginfo('description'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control('j_footer_description', array(
        'label' => 'Footer Description',
        'section' => 'j_footer_section',
        'type' => 'textarea',
    ));

    // Social Media Links
    $social_links = array(
        'facebook' => 'Facebook URL',
        'twitter' => 'Twitter URL',
        'instagram' => 'Instagram URL',
        'linkedin' => 'LinkedIn URL',
    );

    foreach($social_links as $social => $label) {
        $wp_customize->add_setting('j_'.$social.'_url', array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control('j_'.$social.'_url', array(
            'label' => $label,
            'section' => 'j_footer_section',
            'type' => 'url',
        ));
    }

    // Contact Information
    $contact_fields = array(
        'address' => array('Contact Address', 'textarea'),
        'phone' => array('Phone Number', 'text'),
        'email' => array('Email Address', 'email'),
    );

    foreach($contact_fields as $field => $details) {
        $wp_customize->add_setting('j_contact_'.$field, array(
            'default' => '',
            'sanitize_callback' => ($details[1] == 'textarea') ? 'sanitize_textarea_field' : 'sanitize_text_field',
        ));

        $wp_customize->add_control('j_contact_'.$field, array(
            'label' => $details[0],
            'section' => 'j_footer_section',
            'type' => $details[1],
        ));
    }

    // Copyright Text
    $wp_customize->add_setting('j_copyright_text', array(
        'default' => 'All rights reserved.',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('j_copyright_text', array(
        'label' => 'Copyright Text',
        'section' => 'j_footer_section',
        'type' => 'text',
    ));
}
add_action('customize_register', 'j_customizar_register');

// Menu Register
register_nav_menus(array(
    'main_menu' => __('Main Menu', 'jhuma'),
    'footer_menu' => __('Footer Menu', 'jhuma'),
));

// Bootstrap Nav Walker
class Bootstrap_Nav_Walker extends Walker_Nav_Menu {
    public function start_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"dropdown-menu\">\n";
    }

    public function end_lvl(&$output, $depth = 0, $args = null) {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n";
    }

    public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
        $indent = ($depth) ? str_repeat("\t", $depth) : '';
        $classes = empty($item->classes) ? array() : (array) $item->classes;
        $classes[] = 'menu-item-' . $item->ID;

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));

        if (in_array('menu-item-has-children', $classes)) {
            $class_names .= ' dropdown';
        }

        if (in_array('current-menu-item', $classes)) {
            $class_names .= ' active';
        }

        $class_names = $class_names ? ' class="nav-item ' . esc_attr($class_names) . '"' : ' class="nav-item"';

        $id = apply_filters('nav_menu_item_id', 'menu-item-'. $item->ID, $item, $args);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names .'>';

        $attributes = ! empty($item->attr_title) ? ' title="'  . esc_attr($item->attr_title) .'"' : '';
        $attributes .= ! empty($item->target)     ? ' target="' . esc_attr($item->target     ) .'"' : '';
        $attributes .= ! empty($item->xfn)        ? ' rel="'    . esc_attr($item->xfn        ) .'"' : '';
        $attributes .= ! empty($item->url)        ? ' href="'   . esc_attr($item->url        ) .'"' : '';

        $link_class = 'nav-link';
        if (in_array('menu-item-has-children', $classes)) {
            $link_class .= ' dropdown-toggle';
            $attributes .= ' data-bs-toggle="dropdown" aria-expanded="false"';
        }

        $item_output = isset($args->before) ? $args->before ?? '' : '';
        $item_output .= '<a class="' . $link_class . '"' . $attributes .'>';
        $item_output .= (isset($args->link_before) ? $args->link_before ?? '' : '') . apply_filters('the_title', $item->title, $item->ID) . (isset($args->link_after) ? $args->link_after ?? '' : '');
        $item_output .= '</a>';
        $item_output .= isset($args->after) ? $args->after ?? '' : '';

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el(&$output, $item, $depth = 0, $args = null) {
        $output .= "</li>\n";
    }
}

// Custom Post Meta for Featured Posts
function j_add_featured_post_meta() {
    add_meta_box(
        'j_featured_post',
        'Featured Post Settings',
        'j_featured_post_callback',
        'post',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'j_add_featured_post_meta');

function j_featured_post_callback($post) {
    wp_nonce_field('j_featured_post_nonce', 'j_featured_post_nonce_field');
    $featured = get_post_meta($post->ID, 'featured_post', true);
    ?>
    <label for="featured_post">
        <input type="checkbox" id="featured_post" name="featured_post" value="yes" <?php checked($featured, 'yes'); ?>>
        Mark as Featured Post (will appear in carousel)
    </label>
    <?php
}

function j_save_featured_post($post_id) {
    if (!isset($_POST['j_featured_post_nonce_field']) || !wp_verify_nonce($_POST['j_featured_post_nonce_field'], 'j_featured_post_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['featured_post'])) {
        update_post_meta($post_id, 'featured_post', 'yes');
    } else {
        delete_post_meta($post_id, 'featured_post');
    }
}
add_action('save_post', 'j_save_featured_post');

// Custom Post Meta for PDF Upload
function j_add_pdf_upload_meta() {
    add_meta_box(
        'j_post_pdf',
        'Post PDF Upload',
        'j_post_pdf_callback',
        'post',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'j_add_pdf_upload_meta');

function j_post_pdf_callback($post) {
    wp_nonce_field('j_post_pdf_nonce', 'j_post_pdf_nonce_field');
    $pdf_url = get_post_meta($post->ID, 'j_post_pdf', true);
    ?>
    <label for="j_post_pdf">Upload PDF File:</label>
    <input type="text" id="j_post_pdf" name="j_post_pdf" value="<?php echo esc_url($pdf_url); ?>" style="width: 100%;" readonly />
    <input type="button" class="button" value="Upload PDF" id="upload_pdf_button" />
    <input type="hidden" id="j_post_pdf_hidden" name="j_post_pdf_hidden" value="<?php echo esc_url($pdf_url); ?>" />
    <?php if ($pdf_url) : ?>
        <p><a href="<?php echo esc_url($pdf_url); ?>" target="_blank">View PDF</a> | <a href="#" id="remove_pdf">Remove PDF</a></p>
    <?php endif; ?>
    <script>
    jQuery(document).ready(function($) {
        var mediaUploader;
        $('#upload_pdf_button').click(function(e) {
            e.preventDefault();
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }
            mediaUploader = wp.media({
                title: 'Select PDF',
                button: {
                    text: 'Select PDF'
                },
                multiple: false,
                library: {
                    type: 'application/pdf'
                }
            });
            mediaUploader.on('select', function() {
                var attachment = mediaUploader.state().get('selection').first().toJSON();
                $('#j_post_pdf').val(attachment.url);
                $('#j_post_pdf_hidden').val(attachment.url);
                $('#remove_pdf').parent().show();
            });
            mediaUploader.open();
        });
        $('#remove_pdf').click(function(e) {
            e.preventDefault();
            $('#j_post_pdf').val('');
            $('#j_post_pdf_hidden').val('');
            $(this).parent().hide();
        });
    });
    </script>
    <?php
}

function j_save_post_pdf($post_id) {
    if (!isset($_POST['j_post_pdf_nonce_field']) || !wp_verify_nonce($_POST['j_post_pdf_nonce_field'], 'j_post_pdf_nonce')) {
        return;
    }

    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['j_post_pdf_hidden']) && !empty($_POST['j_post_pdf_hidden'])) {
        update_post_meta($post_id, 'j_post_pdf', esc_url_raw($_POST['j_post_pdf_hidden']));
    } else {
        delete_post_meta($post_id, 'j_post_pdf');
    }
}
add_action('save_post', 'j_save_post_pdf');

// PDF Download Handler
function j_handle_pdf_download() {
    if (isset($_GET['action']) && $_GET['action'] === 'download_pdf' && isset($_GET['post_id']) && isset($_GET['nonce'])) {
        $post_id = intval($_GET['post_id']);
        $nonce = sanitize_text_field($_GET['nonce']);

        if (!wp_verify_nonce($nonce, 'download_pdf_' . $post_id)) {
            wp_die('Security check failed.');
        }

        $pdf_url = get_post_meta($post_id, 'j_post_pdf', true);
        if (!$pdf_url) {
            wp_die('No PDF available for this post.');
        }

        $file_path = str_replace(wp_get_upload_dir()['baseurl'], wp_get_upload_dir()['basedir'], $pdf_url);
        
        if (file_exists($file_path)) {
            header('Content-Description: File Transfer');
            header('Content-Type: application/pdf');
            header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
            header('Expires: 0');
            header('Cache-Control: must-revalidate');
            header('Pragma: public');
            header('Content-Length: ' . filesize($file_path));
            readfile($file_path);
            exit;
        } else {
            wp_die('PDF file not found.');
        }
    }
}
add_action('init', 'j_handle_pdf_download');

// Custom Image Sizes
add_image_size('carousel-image', 1200, 500, true);
add_image_size('post-thumbnail', 400, 250, true);

// Excerpt Length
function j_custom_excerpt_length($length) {
    return 20;
}
add_filter('excerpt_length', 'j_custom_excerpt_length');

// Excerpt More
function j_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'j_excerpt_more');

// Widget Support
function j_widgets_init() {
    register_sidebar(array(
        'name' => __('Blog Sidebar', 'jhuma'),
        'id' => 'blog-sidebar',
        'description' => __('Sidebar for blog pages', 'jhuma'),
        'before_widget' => '<div class="widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ));

    register_sidebar(array(
        'name' => __('Footer Widget 1', 'jhuma'),
        'id' => 'footer-widget-1',
        'description' => __('Footer widget area 1', 'jhuma'),
        'before_widget' => '<div class="footer-widget %2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));
}
add_action('widgets_init', 'j_widgets_init');
?>