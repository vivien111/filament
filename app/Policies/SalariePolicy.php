<?php

namespace App\Policies;

use App\Models\Salarie;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class SalariePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Seuls les utilisateurs avec le rôle 'entreprise' peuvent voir la liste des salariés
        return $user->role === 'entreprise';
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Salarie $salarie): bool
    {
        // Seule l'entreprise propriétaire peut voir un salarié spécifique
        return $user->id === $salarie->entreprise->user_id;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Seuls les utilisateurs avec le rôle 'entreprise' peuvent créer des salariés
        return $user->role === 'entreprise';
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Salarie $salarie): bool
    {
        // Seule l'entreprise propriétaire peut mettre à jour un salarié
        return $user->id === $salarie->entreprise->user_id;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Salarie $salarie): bool
    {
        // Seule l'entreprise propriétaire peut supprimer un salarié
        return $user->id === $salarie->entreprise->user_id;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Salarie $salarie): bool
    {
        // Seule l'entreprise propriétaire peut restaurer un salarié (si vous utilisez SoftDeletes)
        return $user->id === $salarie->entreprise->user_id;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Salarie $salarie): bool
    {
        // Seule l'entreprise propriétaire peut supprimer définitivement un salarié
        return $user->id === $salarie->entreprise->user_id;
    }
}