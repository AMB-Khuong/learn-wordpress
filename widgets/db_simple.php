<?php

class Ntk_Widget_Db_Simple
{
    public function __construct()
    {
        add_action('wp_dashboard_setup', array($this, 'widget'));
    }

    public function widget()
    {
        wp_add_dashboard_widget('ntk_mp_widget_db_simple', 'My Information', array($this, 'author'));
    }
// WP_Query lấy tất cả bảng biểu của wordpress hiển thị ra

   public function author() {
        $query = new WP_Query('author=123');
   }


    public function display()
    {
        // $arrQuery = array(
        //     'author' => 1,
        //     'p' => 60
        // );
        // $wpQuery = new WP_Query('author=1&p=60&cat=2');

        // echo '<pre>';
        // print_r( $wpQuery->get_queried_object());
        // echo '</pre>';

        
        // echo '<pre>';
        // print_r( $wpQuery);
        // echo '</pre>';

        


        // The Loop.
        // if ($wpQuery->have_posts()) {
        //     echo '<ul>';
        //     while ($wpQuery->have_posts()) { 
        //         $wpQuery->the_post();
        //         $linkPost = admin_url('post.php?post= '. get_the_ID() .'&action=edit');
        //         echo '<li> <a href="'.  $linkPost  .  '">' . esc_html(get_the_title()) . '</a></li>';
        //     }
        //     echo '</ul>';
        // } else {
        //     translate(esc_html_e('Sorry, no posts matched your criteria.'));
        // }
        // // Restore original Post Data.
        // wp_reset_postdata();
    }
}