<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    protected $fillable = [
        'menu_name',
        'category_slug',
        'position',
        'main_child',
        'parent_id',
        'header_footer',
        'status',
        'bannerImage',
        'image',
        'page_title',
        'title_slug',
        'content',
        'description',
        'external_link',
        'metaTitle',
        'metaKeyword',
        'metaDescription',
    ];

    const contentType = ['home', 'about_us', 'our_products', 'contact_us', 'album', 'career'];

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('position', 'asc');
    }
}
