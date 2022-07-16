<?php

namespace App\helper;

class FileValidator {

    static function onlyImg($fileImage, $required){
        $name_var = key($fileImage);
        $messsages = array(
            $name_var.'.image'=>'La imagen seleccionada debe ser una imagen',
            $name_var.'.max'=>'La imagen seleccionada no puede superar los 5MB',
            $name_var.'.required'=>'Debe ingresar una imagen'
        );
        if($required){
            $rules = [
                $name_var => 'required|image|max:5120'
            ];
        }else{
            $rules = [
                $name_var => 'image|max:5120'
            ];
        }
        return $validator = \Validator::make($fileImage, $rules, $messsages);
    }

    static function onlyHtml($fileHtml, $required){
        $name_var = key($fileHtml);
         $messsages = array(
            $name_var.'.mimes'=>'El archivo seleccionado debe ser un html.',
            $name_var.'.max'=>'El archivo seleccionado no puede superar los 5MB.',
            $name_var.'.required'=>'Debe ingresar un archivo html.'
        );
        if($required){
            $rules = [
                $name_var => 'required|mimes:html|max:5120'
            ];
        }else{
            $rules = [
            $name_var => 'mimes:html|max:5120'
        ];
        }
        return $validator = \Validator::make($fileHtml, $rules, $messsages);
    }
    
}
