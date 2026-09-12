<?php

namespace Waterhole\SilentEdit\Actions;

use Illuminate\Support\Collection;
use Waterhole\Actions\Action;
use Waterhole\Models\Comment;
use Waterhole\Models\Model;
use Waterhole\Models\Post;
use Waterhole\Models\User;

class SilentEdit extends Action
{
    protected string $renderType = self::TYPE_MENU_ITEM;

    public function appliesTo(Model $model): bool
    {
        return $model instanceof Post || $model instanceof Comment;
    }

public function authorize(?User $user, Model $model): bool
{
    return $user?->can('waterhole.silent-edit', User::class) ?? false;
}

    public function shouldRender(
        Collection $models,
        ?string $context = null,
    ): bool {
        return $models->every(
            fn (Post|Comment $model) => $model->edited_at !== null,
        );
    }

    public function label(Collection $models): string
    {
        return __('waterhole-silent-edit::forum.clear-last-edit');
    }

    public function icon(Collection $models): ?string
    {
        return 'tabler-pencil-off';
    }

    public function run(Collection $models): void
    {
        $models->each(function (Post|Comment $model) {
            $model->edited_at = null;
            $model->save();
        });
    }
}