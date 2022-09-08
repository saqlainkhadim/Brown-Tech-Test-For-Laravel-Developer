<?php

use Nette\Utils\Image;

function image_upload($image_obj){
    $image_name = '' . 'IMG-' . uniqid() . '-' . time() . '.' . $image_obj->extension();
    $image_obj->move(public_path('storage/company_logos'), $image_name);
    return $image_name;
}
