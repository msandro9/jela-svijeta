<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MealResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->translate($request->lang)->title,
            'description' => $this->translate($request->lang)->description,
            'status' => $request->filled('diff_time') ? $this->calculateStatus() : 'created',
            'category' => CategoryResource::make($this->whenLoaded('category')),
            'tags' => TagResource::collection($this->whenLoaded('tags')),
            'ingredients' => IngredientResource::collection($this->whenLoaded('ingredients'))
        ];
    }

    private function calculateStatus()
    {
        $status = 'created';
        if ($this->updated_at > $this->created_at) {
            $status = 'modified';
        }
        if ($this->trashed()) {
            $status = 'deleted';
        }
        return $status;
    }
}
