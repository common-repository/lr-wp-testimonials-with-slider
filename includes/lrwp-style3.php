<?php
add_shortcode( 'LRWP-STYLE3', 'lrwp_shortcode_style3' );
function lrwp_shortcode_style3() {
ob_start();
	$lrwp_layout_type = get_option('lrwp_layout_type');
	$lrwp_smartspeed = get_option('lrwp_smartspeed');
	$lrwp_layout_type = $lrwp_layout_type['lrwp_layout_type'];
	$lrwp_loop_value = get_option('lrwp_loop_value');
	$lrwp_loop_value = $lrwp_loop_value['lrwp_loop_value'];
	$lrwp_set_margin = get_option('lrwp_set_margin');
	$lrwp_show_nav_true = get_option('lrwp_show_nav_true');
	$lrwp_show_nav_true = $lrwp_show_nav_true['lrwp_show_nav_true'];
	$lrwp_autoplay = get_option('lrwp_autoplay');
	$lrwp_autoplay = $lrwp_autoplay['lrwp_autoplay'];?>
<div class="row">
  <div class="col-md-12">
    <div id="testimonial-slider" class="owl-carousel owl-theme">
      <?php
		$args = array('post_type' => 'lrwp_testimonial', 'posts_per_page' => -1, 'order' => 'DESC' );
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
		$lrwp_cname = get_post_meta( get_the_ID(), 'lrwp_cname', true );
		$lrwp_cemail = get_post_meta( get_the_ID(), 'lrwp_cemail', true );
		$lrwp_compname = get_post_meta( get_the_ID(), 'lrwp_compname', true );
		$lrwp_comwebsite = get_post_meta( get_the_ID(), 'lrwp_comwebsite', true );?>
      <div class="testimonial">
        <div class="pic"> <img src="<?php echo $featured_img_url;?>" alt=""> </div>
        <h3 class="title">
          <?php the_title();?>
        </h3>
        <p class="description"><?php echo get_the_content();?></p>
        <div class="testimonial-content">
          <div class="testimonial-profile">
            <h3 class="name"><?php echo $lrwp_cname; ?></h3>
            <span class="post"><?php echo $lrwp_compname; ?></span> </div>
        </div>
      </div>
      <?php endwhile; wp_reset_query();?>
    </div>
  </div>
</div>
</div>
<script>
  jQuery(document).ready(function(){
    jQuery("#testimonial-slider").owlCarousel({
		 items:2,
		 margin:10,
		 autoplayTimeout:<?php echo $lrwp_smartspeed;?>,
		 loop: <?php echo $lrwp_loop_value;?>,
		 autoplay:<?php echo $lrwp_autoplay;?>,
         dots: <?php echo $lrwp_show_nav_true;?>,
         responsive: {
		  0: {
			items: 1
		  },
		  600: {
			items: 2
		  },
		  1000: {
			items: 2
		  }
		}
    });
});
</script>
<?php return ob_get_clean();}
