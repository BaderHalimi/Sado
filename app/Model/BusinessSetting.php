<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BusinessSetting extends Model
{
    protected $fillable = ['type', 'value'];

    public function translations()
    {
        return $this->morphMany('App\Model\Translation', 'translationable');
    }

    public function getNameAttribute($name)
    {
        // استرجاع الترجمة إذا كان الطلب للعرض في الواجهة الأمامية
        return $this->translations[0]->value ?? $name;
    }
}
