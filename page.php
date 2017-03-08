<?php
/*
Template Name: Archives inspire
*/
get_header();
?>
<div class="a-i">
    <div class="banner feature-img" role="banner" style="background-image: url('<?php
    $page_id = $post->ID;
    $image = wp_get_attachment_image_src(get_post_thumbnail_id($page_id), 'single-post-thumbnail');
    $childimage = wp_get_attachment_image_src(get_post_thumbnail_id($post->post_parent), 'single-post-thumbnail');
    if (has_post_thumbnail($page_id)) {
        echo make_path_relative_no_pre_path($image[0]);
    } elseif (is_page($page_id)) {
        echo make_path_relative_no_pre_path($childimage[0]);
    }
    ?>')">
        <?php get_template_part('breadcrumb'); ?>
        <div class="heading-banner text-left">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <?php get_image_caption('top'); ?>
                        <h1 class="super-heading"><?php echo get_the_title(); ?></h1>
                        <?php $sub_heading = get_post_meta($page_id, 'sub_heading_sub_heading', true);
                        if ($sub_heading) : ?>
                            <h2 class="super-heading"><?php echo $sub_heading; ?></h2>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <main class="content-area" role="main">
        <div class="container">
            <?php
            $args = array('category_name' => 'navigation', 'post_type' => 'page','post__not_in' => array($page_id),'order' => 'ASC', 'orderby' => 'menu_order');
            $the_query = new WP_Query($args);
            if ($the_query->have_posts())   : ?>
                <div class="breadcrumb">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="list-inline">
                                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                    <li>
                                        <a href="<?php echo make_path_relative(get_page_link()); ?>"
                                               title="<?php the_title_attribute(); ?>"
                                               rel="bookmark"><?php the_title(); ?>
                                        </a>
                                    </li>

                                <?php endwhile; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            <?php endif;
            wp_reset_query(); ?>
            <section class="parent_section"> <!--Main section-->
                <h2 class="sr-only">Main section</h2>
                <div class="row">
                    <div class="col-md-4 col-md-push-8">
                        <?php $featbox_editor = get_post_meta($post->ID, 'featbox_editor', true);
                        $video = get_post_meta($post->ID, 'video_metabox', true);
                        $video_filter = apply_filters('the_content', $video);
                        //apply_filters('the_content',$child_video);
                        $featbox_color = get_post_meta($post->ID, 'featbox_select', true);
                        if ($featbox_editor) : ?>
                            <div class="editor-container <?php echo $featbox_color; ?>">
                                <?php echo make_path_relative(wpautop($featbox_editor)); ?>
                            </div>
                        <?php elseif ($video) : ?>
                            <div class="video-container">
                                <?php echo $video_filter; ?>
                            </div>
                        <?php elseif (!empty($featbox_editor) && !empty($video)) : ?>
                            <div class="editor_container <?php echo $featbox_color; ?>">
                                <?php echo wpautop($featbox_editor); ?>
                            </div>
                        <?php endif;
                        wp_reset_query(); ?>
                    </div>
                    <div class="col-md-8 col-md-pull-4">
                        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                            <?php the_content(); ?>
                            <?php if (in_category('form')) : ?>
                                <iframe src="https://r1.surveysandforms.com/ef3pub0a-e31z1b9f" frameborder="0"
                                        scrolling="no"></iframe>
                            <?php endif; ?>
                        <?php endwhile; endif; ?>
                    </div>
                </div>
            </section><!--End Main section-->
        </div><!--End container-->
        <?php
        $page_id = $post->ID;
        $args = array('post_type' => 'page', 'post_parent' => $page_id, 'post_per_page' => 6, 'orderby' => 'menu_order', 'order' => 'ASC', 'category_name'=>'case-study');
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()) : ?>
            <section class="a-i-tabs-section"><!--Tabs sections container-->
                <h2 class="sr-only">Tabs Navigation</h2>
                <div class="container">
                    <ul class="nav nav-pills">
                        <?php $active = false; ?>
                        <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                            <li class="<?php echo !$active ? "active" : ""; ?>" role="tab">
                                <a class="stop" href="#<?php echo sanitize_title_with_dashes(strtolower(get_the_title())); ?>" data-toggle="tab">
                                    <h3><?php the_title(); ?></h3>
                                </a>
                            </li>
                            <?php $active = true; ?>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </section>
        <?php endif;
        wp_reset_query(); ?>
        <?php
        $page_id = $post->ID;
        $args = array('post_type' => 'page', 'post_parent' => $page_id, 'orderby' => 'menu_order', 'order' => 'ASC', 'category_name'=>'case-study');
        $the_query = new WP_Query($args);
        if ($the_query->have_posts()) : ?>
            <section class="a-i-tabs"><!--Tabs sections-->
                <h2 class="sr-only">Tabs</h2>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="tab-content ">
                                <?php $active = false; ?>
                                <?php while ($the_query->have_posts()) : $the_query->the_post(); ?>
                                    <div class="tab-pane <?php echo !$active ? "active" : ""; ?>"
                                         id="<?php echo sanitize_title_with_dashes(strtolower(get_the_title())); ?>">
                                        <div class="col-md-12 pr-only">
                                            <h3><?php the_title(); ?></h3>
                                            <hr>
                                        </div>
                                        <?php $child_video = get_post_meta($post->ID, 'video_metabox', true);
                                        if (has_post_thumbnail()) : ?>
                                            <div class="col-md-6">
                                                <?php the_content(); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="tab_img">
                                                    <?php
                                                    $thumb_id = get_post_thumbnail_id();
                                                    $thumb_url_array = wp_get_attachment_image_src($thumb_id, 'large', true);
                                                    $thumb_url = $thumb_url_array[0];
                                                    $thumb_img = get_post( get_post_thumbnail_id() );
                                                    $thumb_caption = $thumb_img->post_excerpt;
                                                    $thumb_title = $thumb_img->post_title; ?>
                                                    <a href="<?php the_post_thumbnail_url(); ?>" title="<?php echo $thumb_title; ?>">
                                                        <img src="<?php echo make_path_relative_no_pre_path($thumb_url) ?>"
                                                             alt="<?php the_title(); ?>" class="img-responsive">
                                                    </a>
                                                    <?php $thumb_img = get_post( get_post_thumbnail_id() );
                                                            $thumb_caption = $thumb_img->post_excerpt;
                                                            $thumb_title = $thumb_img->post_title;
                                                        if ($thumb_caption) : ?>
                                                            <?php echo "<p class='wp-caption-text'>$thumb_caption</p>" ?>
                                                        <?php else : ?>
                                                            <?php echo "<p class='wp-caption-text'>$thumb_title</p>" ?>
                                                        <?php endif; ?>
                                                </div>
                                            </div>
                                        <?php elseif (!empty($child_video)) : ?>
                                            <div class="col-md-6">
                                                <?php the_content(); ?>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="video-container">
                                                    <?php
                                                    $video_filter = apply_filters('the_content', $child_video);
                                                    echo $video_filter;
                                                    ?>
                                                </div>
                                            </div>
                                        <?php elseif (has_post_thumbnail() == null && empty($child_video)) : ?>
                                            <div class="col-sm-8 col-md-8">
                                                <?php the_content(); ?>
                                            </div>
                                            <div class="col-sm-4 col-md-12"></div>
                                        <?php endif; ?>
                                    </div>
                                    <?php $active = true; ?>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!--End tabs section-->
        <?php endif;
        wp_reset_query(); ?>
        <?php
        if (in_category('carousel')) : ?>
            <section class="a-i-carousel">
                <h2 class="sr-only">Carousel section</h2>
                <div class="container-fluid">
                    <div class="row">
                        <div id="myCarousel" class="carousel slide" data-ride="carousel">

                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">
                                <div class="item active">
                                    <div class="col-md-6">
                                        <div class="carousel-text">
                                            <p>
                                                Archives are bursting with valuable information and insights. But
                                                finding
                                                the right information can sometimes take many years of painstaking work.
                                                How
                                                can our research help researchers everywhere?
                                            </p>
                                            <p>
                                                Traces through time is our ground-breaking international collaborative
                                                research project inspired by archives.
                                            </p>
                                            <p>
                                                This is just the beginning of a revolution in research technology.
                                            </p>
                                            <p>
                                                <a href="http://www.nationalarchives.gov.uk/documents/archives-inspire-2015-19.pdf">Read
                                                    more in Archives Inspire 2015-19</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <img
                                            src="<?php echo make_path_relative_no_pre_path(get_stylesheet_directory_uri()); ?>/img/archives-inspire-screenshot-1.png"
                                            alt="screenshot-1" class="img-responsive full-width">
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="col-md-6">
                                        <div class="carousel-text">
                                            <p>
                                                Every family has a history. Experiences of loss, courage, adventure and
                                                separation can resonate through generations and through communities.
                                                Making
                                                a connection with our past can help us to understand our own lives
                                                better.
                                            </p>
                                            <p>
                                                Through interactive technology we are bringing these real stories from
                                                the
                                                trenches to the classroom. We are also working with Caribbean, African
                                                and
                                                Asian communities in the UK to explore their First World War history.
                                            </p>
                                            <p>
                                                <a href="http://www.nationalarchives.gov.uk/documents/archives-inspire-2015-19.pdf">Read
                                                    more in Archives Inspire 2015-19</a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <img
                                            src="<?php echo make_path_relative_no_pre_path(get_stylesheet_directory_uri()); ?>/img/archives-inspire-screenshot-2.png"
                                            alt="screenshot-1" class="img-responsive full-width">
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="col-md-6">
                                        <div class="carousel">
                                            <div class="carousel-text">
                                                <p>
                                                    The laws that govern our society and guarantee our rights are
                                                    constantly
                                                    evolving. A change to one law will have implications for others. How
                                                    can
                                                    we follow these changes and understand their impact on our lives?
                                                </p>
                                                <p>
                                                    <a href="http://www.nationalarchives.gov.uk/documents/archives-inspire-2015-19.pdf">Read
                                                        more in Archives Inspire 2015-19</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <img
                                            src="<?php echo make_path_relative_no_pre_path(get_stylesheet_directory_uri()); ?>/img/archives-inspire-screenshot-3.png"
                                            alt="screenshot-1" class="img-responsive full-width">
                                    </div>
                                </div>

                                <div class="item">
                                    <div class="col-md-6">
                                        <div class="carousel">
                                            <div class="carousel-text">
                                                <p>
                                                    The laws that govern our society and guarantee our rights are
                                                    constantly
                                                    evolving. A change to one law will have implications for others. How
                                                    can
                                                    we follow these changes and understand their impact on our lives?
                                                </p>
                                                <p>
                                                    <a href="http://www.nationalarchives.gov.uk/documents/archives-inspire-2015-19.pdf">Read
                                                        more in Archives Inspire 2015-19</a>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <img
                                            src="<?php echo make_path_relative_no_pre_path(get_stylesheet_directory_uri()); ?>/img/archives-inspire-screenshot-4.png"
                                            alt="screenshot-1" class="img-responsive full-width">
                                    </div>
                                </div>
                                <!-- Left and right controls -->

                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                    <span>&lt;</span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                    <span>&gt;</span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    </main>
</div>
<?php get_footer(); ?>
