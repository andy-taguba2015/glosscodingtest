<?php get_header(); ?>
    <section class="hero" style="background-image: url('<?php the_field('hero_background_image') ?>')">
        <div class="HeroContent">
            <h1><?php the_field('hero_header'); ?></h1>
            <p><?php the_field('hero_paragraph'); ?></p>
            <a href="#" class="CTAbtn">Get Started Now</a>
        </div>
    </section> <!-- Hero -->
    
    <section class="BrowseCourses">
        <div class="LeftBCourses">
            <img src="<?php the_field('browse_course_image'); ?>" alt="Best Courses Offered">
        </div>
        <div class="RightBCourses">
            <h2><?php the_field('browser_course_header_h2'); ?></h2>
            <p><?php the_field('browse_course_paragraph'); ?></p>
            <a href="#" class="BCoursesBtn">Browse Courses</a>
        </div>
    </section> <!-- Browse Courses -->
    
    <section class="LearnMore">
        <div class="LeftLearnMore">
            <h2><?php the_field('learn_more_header'); ?></h2>
            <p><?php the_field('learn_more_paragraph'); ?></p>
            <a href="#" class="LearnMoreBtn">Learn More</a>
        </div>
        <div class="RightLearnMore"></div>
    </section> <!--Learn More -->
    
    <section class="members">
      <div>
           <h2>Lorem Ipsum Dolor Sit Amet</h2>
           <p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
       </div>
       <div class="memberslist">  
           <?php echo do_shortcode( '[glossmembers]' ); ?>
        </div>
    </section> <!-- Members -->   
   
   
<?php get_footer(); ?>   
    
    