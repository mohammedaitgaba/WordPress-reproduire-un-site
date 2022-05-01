<?php
/*
*
* Home intro section for portfolix section
*
*
*/



function portfoliox_intro_section_output()
{
  $portfoliox_dfimgh = get_template_directory_uri() . '/assets/img/hero.png';
  $portfoliox_intro_img = get_theme_mod('portfoliox_intro_img', $portfoliox_dfimgh);
  $portfoliox_intro_subtitle = get_theme_mod('portfoliox_intro_subtitle', __('WELCOME TO MY WORLD', 'portfoliox'));
  $portfoliox_intro_title = get_theme_mod('portfoliox_intro_title', __('Hi, I\'m Jone Doe', 'portfoliox'));
  $portfoliox_intro_designation = get_theme_mod('portfoliox_intro_designation', __('a Designer', 'portfoliox'));
  $portfoliox_intro_desc = get_theme_mod('portfoliox_intro_desc');
  $portfoliox_btn_text_one = get_theme_mod('portfoliox_btn_text_one', __('Hire me', 'portfoliox'));
  $portfoliox_btn_url_one = get_theme_mod('portfoliox_btn_url_one', '#');
  $portfoliox_btn_text_two = get_theme_mod('portfoliox_btn_text_two', __('Download CV', 'portfoliox'));
  $portfoliox_btn_url_two = get_theme_mod('portfoliox_btn_url_two', '#');
?>
  <!-- home -->
  <section class="home" id="home">
    <div class="container">
      <div class="home-all-content">
        <div class="row">
          <div class="col-lg-6">

            <div class="content">
              <?php if ($portfoliox_intro_subtitle) : ?>
                <h5><?php echo esc_html($portfoliox_intro_subtitle); ?></h5>
              <?php endif; ?>
              <?php if ($portfoliox_intro_title) : ?>
                <h1><?php echo esc_html($portfoliox_intro_title); ?> <br><span id="type1"><?php echo esc_html($portfoliox_intro_designation); ?></span></h1>
              <?php endif; ?>
              <?php if ($portfoliox_intro_desc) : ?>
                <p><?php echo esc_html($portfoliox_intro_desc); ?></p>
              <?php endif; ?>
              <?php if ($portfoliox_btn_url_one) : ?>
                <a href="<?php echo esc_url($portfoliox_btn_url_one); ?>" class="btn btn-hero"><?php echo esc_html($portfoliox_btn_text_one); ?></a>
              <?php endif; ?>
              <?php if ($portfoliox_btn_url_two) : ?>
                <a href="<?php echo esc_url($portfoliox_btn_url_two); ?>" class="btn btn-hero"><?php echo esc_html($portfoliox_btn_text_two); ?></a>
              <?php endif; ?>
            </div>

          </div>

          <div class="col-lg-6">
            <?php if ($portfoliox_intro_img) : ?>
              <div class="hero-img">
                <img src="<?php echo esc_url($portfoliox_intro_img); ?>" alt="<?php esc_attr($portfoliox_intro_title); ?>">
              <?php else : ?>
                <div class="hero-img px-noimg">
                <?php endif; ?>
                </div>

              </div>

          </div>
        </div>
      </div>
  </section>

<?php
}
add_action('portfoliox_profile_intro', 'portfoliox_intro_section_output');
