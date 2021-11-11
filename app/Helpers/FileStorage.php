<?php

namespace App\Helpers;
use Storage;

class FileStorage {

    /**
     * store image file: the image file will be storage 
     * on public folder
     * 
     * @param Request $request
     * @param Eloquent $model
     * @param String $field,
     * @param Boolean $update
     */
    public static function storeImage(Request $request, $model, $field, $path = '/images') {

        #Remove image permanently
        if ($request->has($field) && $request->{$field} == '-1') {

            #Remove from storage
            if (!is_null($model->{$field})) {
                Storage::delete($model->{$field});
            }

            #Set null on field
            $model->update([$field => null]);
            return true;
        }

        #Proccess and save image file
        if ($request->hasFile($field) && $request->file($field)->isValid()
            || $request->has($field) && !empty($request->{$field})) { #Android
            
            #With Android we receive the image on base64 string
            if ($request->has('Android')) {

                $base64_image    = $request->{$field};
                $base64Extension = $request->{$field};
                if (preg_match('/^data:image\/(\w+);base64,/', $base64_image)) {

                    #Get extension
                    $extension = explode('/', explode(':', substr($base64Extension, 0, strpos($base64Extension, ';')))[1])[1];
                    $data      = substr($base64_image, strpos($base64_image, ',') + 1);
                    $data      = base64_decode($data);
                } else {
                    return null;
                }
            } else {

                #Get extension
                $file      = $request->file($field);
                $extension = $file->getClientOriginalExtension();
            }

            $folio      = new Folio;
            $id         = (isset($model->hash)) ? $model->hash : $model->id;
            $profileImg = $folio->create().'-'.$id.'.'.$extension;

            #Remove preview image saved if exists
            if (!is_null($model->{$field})) {
                Storage::delete($model->{$field});
            }

            #Storage field and get url image
            if ($request->has('Android')) {
                $img_url = $path.'/'.$profileImg;
                Storage::put($img_url, $data);
            } else {
                $img_url = $request->file($field)->storeAs($path, $profileImg);
            }

            $model->update([$field => '/'.$img_url]);

            return $img_url;
        }
    }
}