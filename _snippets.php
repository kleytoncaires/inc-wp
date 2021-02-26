<?php echo get_template_directory_uri(); ?>/

<? // clean cache 
?>
?version=1.0<?php echo get_cache_prevent_string(); ?>

<?php
define("DEBUGGING", true); // or false in production enviroment
function get_cache_prevent_string($always = false)
{
    return (DEBUGGING || $always) ? date('_Y-m-d_H:i:s') : "";
}
?>

<? // call menu 
?>
<?php
wp_nav_menu(array(
    'theme_location'    => 'header-nav',
    'menu_class'        => "menu list-unstyled",
    'container'         => false,
    'depth'             => 1
));
?>

<? // call sidebar 
?>
<?php if (is_active_sidebar('sidebar')) : ?>
    <?php dynamic_sidebar('sidebar'); ?>
<?php endif; ?>

<? // yoast social 
?>
<?php echo do_shortcode('[social_links]'); ?>

<? // language call 
?>
<?php _e('Text', 'DOMAIN'); ?>

<? // foreach query 
?>
<?php
$args = array(
    'post_type'         => 'post-type',
    'post_status'       => 'publish',
    'posts_per_page'    =>  -1,
    'orderby'           => 'post_date',
    'order'             => 'desc',
);

$posts = query_posts($args);
?>

<?php if (have_posts()) : ?>
    <?php foreach ($posts as $post) : setup_postdata($post); ?>
        <?php the_title(); ?>
        <?php the_content(); ?>
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endif; ?>

<?php wp_reset_query(); ?>

<? // page query 
?>

<?php
$args = array(
    'post_type'      => 'page',
    'pagename'       => 'contato',
);

$posts = query_posts($args);
?>

<?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>
        <?php the_title(); ?>
        <?php the_content(); ?>
        <?php if (has_post_thumbnail()) : ?>
            <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
        <?php endif; ?>
    <?php endwhile; ?>
<?php endif; ?>

<?php wp_reset_query(); ?>

<? // acf field 
?>
<?php the_field('nome'); ?>

<? // bootstrap first slider active 
?>
<div id="carouselXXX" class="carousel slide carousel-fade" data-ride="carousel">

    <ol class="carousel-indicators">
        <?php $cont = 0; ?>
        <?php foreach ($posts as $post) : setup_postdata($post); ?>
            <li data-target="#carouselHome" data-slide-to="<?= $cont; ?>" <?php if ($cont == 0) : ?> class="active" <?php endif; ?>></li>
            <?php $cont++; ?>
        <?php endforeach; ?>
    </ol>

    <div class="carousel-inner">
        <?php $cont = 0; ?>
        <?php foreach ($posts as $post) : setup_postdata($post); ?>
            <div class="carousel-item <?php if ($cont == 0) : ?>active<?php endif; ?>">
                <div class="carousel-pattern"></div>

                <div class="carousel-caption">
                    <div class="container">
                        <?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
                    </div>
                </div>
            </div>
            <?php $cont++; ?>
        <?php endforeach; ?>
    </div>
</div>

<? // mod
?>
<div class="row">
    <?php $cont = 0; ?>
    <?php foreach ($posts as $post) : setup_postdata($post); ?>
        <?php if ($cont == 2) {
            echo "<div class='w-100'></div>";
            $cont = 0;
        } ?>
        <div class="col-12">

        </div>
        <?php $cont++; ?>
    <?php endforeach; ?>
</div>


<? // contact form 7 estados brasileiros 
?>
[select Estado class:form-control first_as_label "Selecione o Estado*" "Acre" "Alagoas" "Amazonas" "Amapá" "Bahia" "Ceará" "Distrito Federal" "Espírito Santo" "Goiás" "Maranhão" "Mato Grosso" "Mato Grosso do Sul" "Minas Gerais" "Pará" "Paraíba" "Paraná" "Pernambuco" "Piauí" "Rio de Janeiro" "Rio Grande do Norte" "Rondônia" "Rio Grande do Sul" "Roraima" "Santa Catarina" "Sergipe" "São Paulo" "Tocantins"]

<? // image path sass 
?>
background-image: url("#{$image-path}/x.svg");

<? // Video with thumbnail
?>
<?php $link = get_field('url_video'); ?>
<?php if ($link) : ?>
    <a href="<?php echo $link ?>" data-fancybox class="institucional-video">
        <div class="institucional-play">
            <?php echo file_get_contents(get_template_directory() . '/assets/img/play.svg'); ?>
        </div>
        <?php
        $link = explode("?v=", $link);
        $link = $link[1];
        $thumbnail = "http://img.youtube.com/vi/" . $link . "/maxresdefault.jpg";
        ?>
        <img src="<?php echo $thumbnail; ?>" class="w-100">
    </a>
<?php endif; ?>