<?php

use AbnCms\RolesPermission\PermissionService;
use Aman5537jains\AbnCms\Lib\AbnCms;
use Aman5537jains\AbnCmsContactFormPlugin\ContactForm as AbnCmsContactFormPluginContactForm;
use Aman5537jains\AbnCmsCRUD\Layouts\FormBuilder;
use Aman5537jains\AbnCmsSettingPlugin\AbnCmsSettingPlugin;
use Aman5537jains\AbnCmsSettingPlugin\SettingService;

\Route::group(["middleware"=>["web","auth"],"prefix"=>"cpadmin"],function(){

\Route::any("settings",function(){
    PermissionService::hasOrAbort("settings","view");
    return SettingService::settingForm();


  })->name("admin-settings");
  \Route::any("settings/activate",function(){

     $AbnCmsSettingPlugin= new AbnCmsSettingPlugin;
     $AbnCmsSettingPlugin->onActivate();
    })->name("admin-settings-activate");

  \Route::any("settings/in-activate",function(){

      $AbnCmsSettingPlugin= new AbnCmsSettingPlugin;
      $AbnCmsSettingPlugin->onInActivate();
  })->name("admin-settings-in-activate");
});
