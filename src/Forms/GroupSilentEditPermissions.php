<?php

namespace Waterhole\SilentEdit\Forms;

use Illuminate\View\Component;
use Waterhole\Models\Group;

class GroupSilentEditPermissions extends Component
{
    public function __construct(
        public ?Group $model,
    ) {}

    public function render()
{
    return <<<'blade'
<div class="field">
    <div class="field__label">
        {{ __('waterhole-silent-edit::cp.group-permission-silent-edit-title') }}
    </div>

    <label class="choice">
        <input
            type="hidden"
            name="permissions[user][silent-edit]"
            value="0"
        >
        <input
            type="checkbox"
            name="permissions[user][silent-edit]"
            value="1"
            @checked(
                old(
                    'permissions.user.silent-edit',
                    \Waterhole::permissions()->can(
                        $model,
                        'silent-edit',
                        \Waterhole\Models\User::class
                    )
                )
            )
        >
        {{ __('waterhole-silent-edit::cp.group-permission-silent-edit-label') }}
    </label>
</div>
blade;
}

}