<?php

namespace App\Listeners;

use App\Events\RoleChanged;
use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Auth;

class HandleRoleChange
{
    /**
     * Create the event listener.
     */
    protected $guard;

    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(RoleChanged $event): void
    {
        Auth::logout();
    }
}
