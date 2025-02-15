<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TokenResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'access_token' => $this->resource,
            'token_type' => 'Bearer',
            'expires_in' => 3600, // Tempo de expiração do token
        ];
    }
}
