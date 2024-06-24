<?php
namespace Aman5537jains\AbnCmsSettingPlugin;

use Aman5537jains\AbnCms\Lib\AbnCms;
use Aman5537jains\AbnCms\Lib\Permission;
use Aman5537jains\AbnCms\Lib\Plugin;
use Aman5537jains\AbnCms\Lib\Sidebar\Sidebar;
use Aman5537jains\AbnCms\Lib\Sidebar\SidebarItem;
use Aman5537jains\AbnCms\Lib\Theme\ScriptLoader;
use Aman5537jains\AbnCms\Lib\Theme\StylesheetLoader;


class AbnCmsSettingPlugin extends Plugin{



    public function getName()
    {
         return "Setting Form";
    }

    public function install()
    {

    }

    public function unInstall()
    {

    }

    public static function permissions(){
        return new Permission("admin-settings");
    }

    public static function sidebar(){

        return new Sidebar("Settings",[
            new SidebarItem("Settings",route("admin-settings"),"",function($permissions){
                return isset($permissions["admin-settings__view"]);
            }),
            // new SidebarItem("Colors","#1","",function($permissions){
            //     return isset($permissions["admin-settings__view"]);
            // }),
            // new SidebarItem("Logo","#2","",function($permissions){
            //     return isset($permissions["admin-settings__view"]);
            // })

        ]);
    }

    public function onActivate()
    {


        AbnCms::createAdminMenu("Settings","admin-settings",0,[["module"=>"settings","action"=>"view"]]);
        AbnCms::addPermissions(["settings"=>["view"=>"view","add"=>"add","edit"=>"edit","delete"]]);

    }
    public function onInActivate()
    {
        AbnCms::removeAdminMenu("Settings");
        AbnCms::removePermissions(["settings"=>["view"=>"view","add"=>"add","edit"=>"edit","delete"]]);

    }

    public function render(){




    }


}
