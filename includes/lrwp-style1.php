<?php
add_shortcode( 'LRWP-STYLE1', 'lrwp_shortcode_style1' );
function lrwp_shortcode_style1() {
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
		$lrwp_autoplay = $lrwp_autoplay['lrwp_autoplay'];
?>
<div class="row">
  <div class="col-md-offset-3 col-md-6">
    <div id="testimonial-slider" class="owl-carousel owl-theme">
      <?php
		$args = array('post_type' => 'lrwp_testimonial', 'posts_per_page' => -1, 'order' => 'DESC' );
		$loop = new WP_Query( $args );
		while ( $loop->have_posts() ) : $loop->the_post();
        $featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'full');
		$lrwp_cname = get_post_meta( get_the_ID(), 'lrwp_cname', true );
		$lrwp_cemail = get_post_meta( get_the_ID(), 'lrwp_cemail', true );
		$lrwp_compname = get_post_meta( get_the_ID(), 'lrwp_compname', true );
		$lrwp_comwebsite = get_post_meta( get_the_ID(), 'lrwp_comwebsite', true );
		?>
      <div class="testimonial">
        <div class="pic"> <img src="<?php echo $featured_img_url;?>" alt="style 1"> </div>
        <h3 class="testimonial-title"> <?php echo $lrwp_cname; ?><br />
          <small><?php echo $lrwp_compname; ?></small> </h3>
        <p class="description">
          <?php the_content();?>
        </p>
      </div>
      <?php endwhile; wp_reset_query();?>
    </div>
  </div>
</div>
<script>
  jQuery(document).ready(function(){
    jQuery("#testimonial-slider").owlCarousel({
		 items:1,
		 autoplayTimeout:<?php echo $lrwp_smartspeed;?>,
		 dots: <?php echo $lrwp_show_nav_true;?>,
		 loop: <?php echo $lrwp_loop_value;?>,
		 autoplay:<?php echo $lrwp_autoplay;?>,
		 responsive: {
		  0: {
			items: 1
		  },
		  600: {
			items: 1
		  },
		  1000: {
			items:1
		  }
		}
    });
});
</script>
<?php return ob_get_clean();}