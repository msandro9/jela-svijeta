<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;

class Meal extends Model implements TranslatableContract
{
    use HasFactory, SoftDeletes, Translatable;

    public $translatedAttributes = ['title', 'description'];
    protected $fillable = ['category_id'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'meal_tag');
    }

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'meal_ingredient');
    }

    public function scopeGetMealsInCategory($query, $category)
    {
        switch ($category) {
            case 'NULL':
                return $query->whereNull('category_id');
            case '!NULL':
                return $query->whereNotNull('category_id');
            case null:
                return $query->whereNotNull('id');
            default:
                return $query->where('category_id', $category);
        }
    }

    public function scopeDiffTime($query, $diffTime)
    {
        if (!is_null($diffTime)) {
            $ts = Carbon::createFromTimestamp($diffTime);
            return $query->withTrashed()
                ->where('created_at', '>', $ts)
                ->orWhere('updated_at', '>', $ts)
                ->orWhere('deleted_at', '>', $ts);
        }
        return $query;
    }

    public function scopeWithIncludes($query, $with)
    {
        if (is_null($with)) return $query;
        $includes = explode(',', $with);
        foreach ($includes as $include) {
            $query = $query->with($include);
        }
        return $query;
    }

    public function scopeWhereHasTags($query, $tags)
    {
        if (is_null($tags)) return $query;
        $tags = explode(',', $tags);
        foreach ($tags as $tagId) {
            $query->whereHas('tags', function ($q) use ($tagId) {
                $q->where('id', $tagId);
            });
        }
        return $query;
    }
}
