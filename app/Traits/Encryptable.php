<?php

namespace App\Traits;

use Crypt;

trait Encryptable {

 //   protected $encryptable = [];

    public function setAttribute($key, $value) {
        if (in_array($key, $this->encryptable)) {
            $value = Crypt::encrypt($value);
        }

        return parent::setAttribute($key, $value);
    }

    public function getAttribute($key) {
        if (in_array($key, $this->encryptable)) {
            return Crypt::decrypt($this->attributes[$key]);
        }

        return parent::getAttribute($key);
    }

    public function attributesToArray() {
        $attributes = parent::attributesToArray();

        foreach ($attributes as $key => $value) {
            if (in_array($key, $this->encryptable)) {
                $attributes[$key] = Crypt::decrypt($value);
            }
        }

        return $attributes;
    }

}
