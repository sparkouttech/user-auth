<?php

namespace Sparkouttech\UserAuth\Repositories;

use Sparkouttech\UserAuth\app\Models\User;

class UserRepository extends BaseRepository {

    private $user;

    /**
     * User repository constructor
     */
    public function __construct(User $user) {
        parent::__construct($user);
        $this->user = $user;
    }

}