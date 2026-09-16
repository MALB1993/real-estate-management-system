<?php
namespace App\Policies;

use App\Models\User;
use App\Models\VisitRequest;
use Illuminate\Auth\Access\Response;

class VisitRequestPolicy
{
    /**
     * Determine whether the user can update the visit request status.
     */
    public function updateStatus(User $user, VisitRequest $visitRequest): Response
    {
        return $user->id === $visitRequest->property->user_id
            ? Response::allow()
            : Response::deny('You are not authorized to update this visit request status.');
    }

    /**
     * Determine whether the user can cancel the visit request.
     */
    public function cancel(User $user, VisitRequest $visitRequest): Response
    {
        return $user->id === $visitRequest->user_id
            ? Response::allow()
            : Response::deny('You can only cancel your own visit requests.');
    }
}