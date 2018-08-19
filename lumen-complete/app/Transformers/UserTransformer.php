<?php

namespace App\Transformers;

use App\Models\User;
use League\Fractal\TransformerAbstract;

class UserTransformer extends TransformerAbstract
{
    public function transform(User $user)
    {
        $formattedUser = [
            'name'              => $user->name,
            'email'                 => $user->email,
            'password'          => $user->password,
        ];

        return $formattedUser;
    }
}