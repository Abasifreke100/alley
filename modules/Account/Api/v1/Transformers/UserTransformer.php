<?php

namespace Alley\Modules\Account\Api\v1\Transformers;

use League\Fractal\TransformerAbstract;
use Alley\Modules\Account\Models\User;

class UserTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(User $user)
    {
        return [

            "id"            => $user->id,
            "first_name"    => $user->first_name,
            "last_name"     => $user->last_name,
            "email"         => $user->email,
        ];
    }
}
