<?php

namespace App\Policies;

use App\Models\Comment;
use App\Models\Role;
use App\Models\User;

class CommentPolicy
{
    /**
     * Create a new policy instance.
     */
    public function __construct() {}

    public function delete(User $user, Comment $comment)
    {
        // Seul l'administateur ou le créateur du commentaire peut supprimer un commentaire
        return Role::ADMIN === $user->role->name || $user->id === $comment->user_id;
    }
}
