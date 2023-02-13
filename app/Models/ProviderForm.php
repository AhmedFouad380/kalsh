<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderForm extends Model
{
    use HasFactory;

    public function getImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/providerForm') . '/' . $image;
        }
        return asset('defaults/default_blank.png');

    }

    public function setImageAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'providerForm');
            $this->attributes['image'] = $imageFields;
        }else {
            $this->attributes['image'] = $image;
        }
    }
    public function getDrivingLicenseImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/providerForm') . '/' . $image;
        }
        return asset('defaults/default_blank.png');

    }

    public function setDrivingLicenseImageAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'providerForm');
            $this->attributes['driving_license_image'] = $imageFields;
        }else {
            $this->attributes['driving_license_image'] = $image;
        }
    }
    public function getIdImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/providerForm') . '/' . $image;
        }
        return asset('defaults/default_blank.png');

    }

    public function setIdImageAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'providerForm');
            $this->attributes['id_image'] = $imageFields;
        }else {
            $this->attributes['id_image'] = $image;
        }
    }
    public function getUnderminingImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/providerForm') . '/' . $image;
        }
        return asset('defaults/default_blank.png');

    }

    public function setUnderminingImageAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'providerForm');
            $this->attributes['undermining_image'] = $imageFields;
        }else {
            $this->attributes['undermining_image'] = $image;
        }
    }
    public function getInsuranceImageAttribute($image)
    {
        if (!empty($image)) {
            return asset('uploads/providerForm') . '/' . $image;
        }
        return asset('defaults/default_blank.png');

    }

    public function setInsuranceImageAttribute($image)
    {
        if (is_file($image)) {
            $imageFields = upload($image, 'providerForm');
            $this->attributes['insurance_image'] = $imageFields;
        }else {
            $this->attributes['insurance_image'] = $image;
        }
    }

}

