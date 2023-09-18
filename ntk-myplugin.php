<?php
/*
 Plugin Name: NTK MyPlugin
Plugin URI: https://project-portfolio-one.vercel.app/
Description: Tim hieu ve qua trinh chuan xay dung Plugin.
Author: NTK group
Version: 1.0
Author URI: https://project-portfolio-one.vercel.app/
*/

define('NTK_MP_PLUGIN_URL', plugin_dir_url(__FILE__));
define('NTK_MP_IMAGES_URL', NTK_MP_PLUGIN_URL . 'images');
define('NTK_MP_CSS_URL', NTK_MP_PLUGIN_URL . 'css');
define('NTK_MP_JS_URL', NTK_MP_PLUGIN_URL . 'js');

define('NTK_MP_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('NTK_MP_VIEWS_DIR', NTK_MP_PLUGIN_DIR . '/views');
define('NTK_MP_INCLUDES_DIR', NTK_MP_PLUGIN_DIR . '/includes');
define('NTK_MP_WIDGET_DIR', NTK_MP_PLUGIN_DIR . '/widgets');
define('NTK_MP_SHORTCODE_DIR', NTK_MP_PLUGIN_DIR . 'shortcodes');
define('NTK_MP_METABOX_DIR', NTK_MP_PLUGIN_DIR . 'metabox');
define('NTK_MP_SETTING_DIR', NTK_MP_PLUGIN_DIR . 'settings');
define('NTK_MP_CP_DIR', NTK_MP_PLUGIN_DIR . '/posts');
define('NTK_MP_CT_DIR', NTK_MP_PLUGIN_DIR . '/taxonomy');
define('NTK_MP_TABLES_DIR', NTK_MP_PLUGIN_DIR . '/tables');

if(!is_admin()){
	require_once NTK_MP_PLUGIN_DIR . '/public.php';


}else{
	
	require_once NTK_MP_PLUGIN_DIR . '/admin.php';

    new NtkMpAdmin();
	

	
}


/* require_once ZENDVN_MP_METABOX_DIR . '/taxonomy.php';
new Zendvn_Mp_Mb_Taxonomy();
*/
// require_once ZENDVN_MP_CP_DIR . '/product.php';
// new Zendvn_Mp_Cp_Product();

// require_once ZENDVN_MP_CT_DIR . '/book.php';
// new Zendvn_Mp_CT_BookCategory(); 
/*
require_once ZENDVN_MP_CP_DIR . '/count_views.php';
new Zendvn_Mp_Count_Views();*/

/* require_once ZENDVN_MP_SHORTCODE_DIR . '/main.php';
new Zendvn_Mp_SC_Main();

require_once ZENDVN_MP_WIDGET_DIR . '/last_post.php';

function last_post_widget_init(){
	register_widget('Zendvn_Mp_Widget_Last_Post');
}

add_action('widgets_init','last_post_widget_init'); 
 */