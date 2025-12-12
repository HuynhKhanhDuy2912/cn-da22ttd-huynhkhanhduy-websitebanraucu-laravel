<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['user_id', 'type', 'message', 'link', 'is_read'];

    public function getTitleAttribute()
    {
        return [
            'order'   => 'Có đơn hàng mới',
            'contact' => 'Có liên hệ mới',
            'wishlist' => 'Sản phẩm yêu thích',
        ][$this->type] ?? 'Thông báo hệ thống';
    }
}
