<?php
require_once NTK_MP_PLUGIN_DIR . '/includes/support.php';


//Options API thao tác với bản options wordpress
//$deprecated đả bị loại bỏ bảng 2x
//add_option($option,$value,$deprecated,$autoload)  , delete_option() , add_site_option(),delete_site_option()
//get_option() , update_option(),get_site_option(),update_site_option()

class NtkMpAdmin{	

    //các giá trị option.php hay dùng
    //admin_email, blogname, blogdescription,blog_charset,date format,default_category,home,siteurl
    //template/start_of_week,upload_path,posts_per_page,posts_per_rss 
    // 4phuong thuc 
    //add_site_option()
	//delete_site_option()
    //get_site_option()
    //update_site_option()
	public function __construct(){
        add_action('admin_init',array($this,'change_autoload'));
       
	}


    public function change_autoload() {
        $old_option = get_option('ntk_mp_plugin_version');
        delete_option('ntk_mp_plugin_version');
        add_option('ntk_mp_plugin_version',$old_option,'','yes');
    }

    // lấy ra giá trị trong bản options
    public function get_options() {

        $tmp = get_option('ntk_mp_wp_course', array());
        echo '<pre>';
        print_r($tmp);
        echo '</pre>';
    }

    public function update_options() {
        update_option('ntk_mp_wp_version', '4.5');

        $arrOptions = array(
            'course' =>'Wordpress 4.5',
            'author' => 'NTK Group',
            'website' => 'www.ntk.com'
        );

        update_option("ntk_mp_wp_course",$arrOptions);
    }

    public function update_options2() {
        $old_options = get_option('ntk_mp_wp_course');
        $old_options['course'] = "Wordpress 6x";
        update_option("ntk_mp_wp_course", $old_options);
    }


    public function add_array_option() {
        $arrOptions = array(
            'course' =>'Wordpress 4.x',
            'author' => 'NTK Group',
            'website' => 'www.ntk.com'
        );

        add_option("ntk_mp_wp_course",$arrOptions,'','yes');
       
    }


    public function delete_options() {
        delete_option('ntk_mp_wp_version');
    }


    public function add_new_option() {
        add_option("ntk_mp_wp_version",'4.0','','yes');
        add_option("ntk_mp_plugin_version",'4.0','','no');
    }


}