<?php
require_once NTK_MP_PLUGIN_DIR . '/includes/support.php';

class NtkMpAdmin{	
	
	public function __construct(){
        // add_action("admin_menu", array($this, 'settingMenu4'));
        // add_action("admin_menu", array($this, 'settingMenu3'));
       
	}




    	//===============================================
	//1 Them mot submenu vao dashboard cua wp menus
	//===============================================
 //add dashboard page() 5 tham số //thêm submenu vào menu có sẳn trong wordpress
 // add media page
 //add_pages_page
 //add comments page
 //add theme page
 //add plugins page
 //add users page
 //add management page
 //add options page
    public function settingMenu() { 
        $menuSlug = 'ntk-mp-my-setting';
        add_dashboard_page('My Setting Title', 'My Setting', 'manage_options', $menuSlug,array($this,'settingPage'));
    }

    public function settingPage() {
        require_once NTK_MP_VIEWS_DIR . '/setting-page.php';;
    }

    	//===============================================
	//2 Them mot menu vao menu có sẳn cùng cấp
	//===============================================

    //add_menu_page(page_title,menu_title,capability,menu_slug,function,icon_url,position) // capability quyền truy cập  // function nội dung
   
    public function settingMenu2() {
        // $menuSlug = __FILE__;
        $menuSlug = 'ntk-mp-my-setting';
        add_menu_page('My Setting Title', 'My Setting', 'manage_options', $menuSlug,array($this,'settingPage'),NTK_MP_IMAGES_URL.'/icon-setting16x16.png');

        // add_submenu_page($menuParenSlug, 'My Setting Sub', 'Sub Setting','manage_options' ,$menuSlug,array($this,'settingPage'));
    }

    //===============================================
	//3 Them mot menu vao menu có sẳn cùng cấp và là menu con
	//===============================================
     //add_submenu_page(parent_slug,page_title,menu_title,capability,menu_slug,function)
    public function settingMenu3(){
         // $menuSlug = __FILE__;
         $menuParenSlug = 'ntk-mp-my-setting';
         $menuSlug = 'ntk-mp-my-setting-sub';
         add_submenu_page($menuParenSlug, 'My Setting Sub', 'Sub Setting','manage_options' ,$menuSlug,array($this,'settingPage'));
    }


    public function settingMenu4(){ // thêm vào vị trí bất kỳ
        // $menuSlug = __FILE__;
        $menuSlug = 'ntk-mp-my-setting';
        add_menu_page('My Setting Title', 'My Setting', 'manage_options', $menuSlug,array($this,'settingPage'),NTK_MP_IMAGES_URL.'/icon-setting16x16.png',1);
   }

   //===============================================
	//4 xóa menu con
	//===============================================

    public function removeSubMenu(){ // thêm vào vị trí bất kỳ
        // $menuSlug = __FILE__;
       
        // remove_submenu_page($menu_slug,$submenu_slug);
   }
  //===============================================
	//5 xóa menu 
	//===============================================
   public function removeMenu() {
        // remove_menu_page($menu_slug);
   }
 //===============================================
	//6 add_object_page giống add_menu_page nhưng khi sử dụng nó các menu mới sẽ được thêm vào các menu cố định 
	//===============================================


     //===============================================
//7 add_utility_page giống add_menu_page nhưng khi sử dụng nó các menu mới sẽ được thêm vào các menu cố định 
	//===============================================
   
    

    
	

}