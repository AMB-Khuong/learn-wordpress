<?php
require_once NTK_MP_PLUGIN_DIR . '/includes/support.php';


//Options API thao tác với bản options wordpress
//$deprecated đả bị loại bỏ bảng 2x
//add_option($option,$value,$deprecated,$autoload)  , delete_option() , add_site_option(),delete_site_option()
//get_option() , update_option(),get_site_option(),update_site_option()

class NtkMpAdmin{	
	
	public function __construct(){
        add_action('admin_init',array($this,'add_new_option'));
       
	}

    public function add_array_option() {
        add_option("ntk_mp_wp_version",'4.0','','yes');
        add_option("ntk_mp_plugin_version",'4.0','','no');
    }


    public function add_new_option() {
        add_option("ntk_mp_wp_version",'4.0','','yes');
        add_option("ntk_mp_plugin_version",'4.0','','no');
    }


}