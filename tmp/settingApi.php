<?php
require_once NTK_MP_PLUGIN_DIR . '/includes/support.php';



//setting API là tập hợp các phương thức 1 số hàm trước khi đưa vào bảng wp_option
///*Setting Register/Unregister     *Add field/Section
///-register_setting()               -add_settings_field($id,$title,$callback,$page,$section,$args)  tạo ra input selecbox radio này nọ
///-unregister_setting()             -add_settings_sections($id,$title,$callback,$page) id section title ten section $callback ham su xu $page trang hoac menu_slug

///*Options Form Rendering            *Error
///-setting_fields()                 -add_settings_error()
///-do_settings_sections()            -get_settings_errors()
///-do_settings-fields               -settings_errors()
class NtkMpAdmin{

    private $_menuSlug = 'ntk-mp-my-setting';

    private $_settingOptions;

    
	public function __construct(){
        $this->_settingOptions = get_option('ntk_mp_name',array());

       

        add_action('admin_menu', array($this, 'settingMenu'));
        add_action('admin_init',array($this,'register_setting_and_fields'));

       
	}

    public function register_setting_and_fields() {
        register_setting('ntk_mp_options','ntk_mp_name',array($this,'validate_setting'));
          
        //MAIN SETTING
		$idMainSection = 'ntk_mp_main_section';

        add_settings_section($idMainSection, 'Main Setting', array($this, 'main_section_view'),  $this->_menuSlug);

        add_settings_field('ntk_mp_new_title', 'Site title', array($this,'create_input'), 
							$this->_menuSlug,$idMainSection);
        //EXT SETTING
        $idExtSection = 'ntk_mp_ext_section'; 		
        add_settings_section($idExtSection, 'Ext Setting', array($this, 'main_section_view'),  $this->_menuSlug);
        
        add_settings_field('ntk_mp_slogan', 'Slogan', array($this,'slogan_input'), 
							$this->_menuSlug,$idExtSection);
                            
        //  add_settings_field('ntk_mp_security_code', 'Security code', array($this,'security_code_input'), 
		// 					$this->_menuSlug,'abc');

       
    }

    public function validate_setting($data_input){
        // echo '<pre>';
        // print_r($data_input);
        // echo '</pre>';
        // die;
        // echo '<pre>';
        // print_r($_POST);
        // echo '</pre>';
        update_option('ntk_mp_slogan', $_POST['ntk_mp_slogan']);
        return $data_input; // lưu vào database
        
    }

    

    public function main_section_view() {
        
    }

    public function create_input() {
        echo '<input type="text" name="ntk_mp_name[ntk_mp_new_title]" value="'.  $this->_settingOptions['ntk_mp_new_title'] .'"/>';
    }

    public function slogan_input() {
        $val = get_option('ntk_mp_slogan');
        echo '<input type="text" name="ntk_mp_slogan" value="'.  $val  .'"/>';
    }

    public function security_code_input() {
        echo '<input type="text" name="ntk_mp_name[ntk_mp_security_code]" value=""/>';
    }
    
    public function settingMenu() {
       
        add_menu_page('My Setting title', 'My Setting', 'manage_options', $this->_menuSlug,array($this,'settingPage'));
            
    }

    public function settingPage(){
        require_once NTK_MP_VIEWS_DIR . '/setting-page-setting.php';
    }


   


  

}