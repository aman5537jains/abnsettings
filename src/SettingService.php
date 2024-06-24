<?php
namespace Aman5537jains\AbnCmsSettingPlugin;

use Aman5537jains\AbnCms\Lib\AbnCms;
use Aman5537jains\AbnCmsCRUD\Components\FileInputComponent;
use Aman5537jains\AbnCmsCRUD\Components\InputComponent;
use Aman5537jains\AbnCmsCRUD\Components\SubmitButtonComponent;
use Aman5537jains\AbnCmsCRUD\Layouts\FormBuilder;
use Aman5537jains\AbnCmsCRUD\Layouts\TableLayout;


class SettingService {

    public static $loadedSettings = [];
    public static function getSettings($slug,$default=''){
        if(isset(self::$loadedSettings[$slug])){
            return self::$loadedSettings[$slug];
        }
        if($slug){
            $setting =  Setting::where('name',$slug)->first();

            if($setting && $setting->description){
                $value ="";
                if($setting->parameter_type == 'image')
               {

                $value = url($setting->description);
               }
               else if($setting->parameter_type == 'file')
               {
                $value = url($setting->description)  ;
               }
               else
               {

                $value = @$setting->description;
               }
               self::$loadedSettings[$slug]=$value;
               return  self::$loadedSettings[$slug];
           }
           else{

               return $default;
           }
        }

       return $slug;
    }
    public static function setSettings($slug,$default){

        if($slug){
            $setting =  Setting::where('name',$slug)->first();
            $setting->description = $default;
            $setting->save();
            return $setting->description ;
        }

       return $slug;
    }
    public function addSetting($name,$value,$type){
        $types = ['color','string','email','number','url','boolean','phone_number','file','happyhours','editor','image','password'];
        $settings = new Setting();
        $settings->name = $name;
        $settings->description = $name;
        $settings->parameter_type = $type;
        $settings->save();
        return $settings;
    }
    public static function settingForm(){
        $settings = Setting::get();

        $FormBuilder =  new FormBuilder(["name"=>"settings",'autoBuild'=>false]);
        $FormBuilder->setModel(new Setting());
        foreach($settings as $setting){
            if($setting->parameter_type=="image"){
                $FormBuilder->addField($setting->name,new FileInputComponent(["name"=>$setting->name,"path"=>"cms/settings","isImage"=>true]));
                if($setting->description)
                $FormBuilder->getField($setting->name)->setValue(url($setting->description));
            }

            else{
                $FormBuilder->addField($setting->name,new InputComponent(["type"=>$setting->parameter_type,"name"=>$setting->name]));
                $FormBuilder->getField($setting->name)->setValue($setting->description);

            }
            if($setting->name=="ACTIVE_THEME" || $setting->name=="BACKEND_ACTIVE_THEME"){

                $FormBuilder->getField($setting->name)->setAttributes(["readonly"=>true]);
            }

        }
        $FormBuilder->addField("submit",new SubmitButtonComponent(["name"=>"submit"]));

        $msg = '';


        if(request()->isMethod("POST")){

// dd(request()->all());
            foreach($settings as $setting){

                if($setting->parameter_type=="image" ){
                    if(request()->hasFile($setting->name)){
                        $setting->description =  $FormBuilder->getField($setting->name)
                                                ->upload(request()->file($setting->name));
                        $FormBuilder->getField($setting->name)->setValue(url($setting->description));
                    }
                }
                else{
                    $setting->description =  request()->get($setting->name);
                }


                $setting->save();



            }
            AbnCms::flash("Settings saved successfully");
            return redirect()->back();

        }
      return   AbnCms::getActiveTheme("BACKEND_ACTIVE_THEME")
    ->setPageContent("<div style=''><h2>Global Settings</h2> $msg <br>".$FormBuilder->render()."</div>")
    ->render();

    }

    public static function contactFormRequests(){

        $TableBuilder =  new TableLayout(["name"=>"contact",'autoBuild'=>true]);
        $TableBuilder->setModel(new ContactForm());
        return " Contact Request <div style='display:flex;justify-content:center;align-items:center'>   <br>".$TableBuilder->render()."</div>";
    }

}
