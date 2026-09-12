<?php

namespace Waterhole\SilentEdit;

use Illuminate\Support\Facades\Gate;
use Waterhole\Extend;
use Waterhole\Models\Comment;
use Waterhole\Models\Post;
use Waterhole\SilentEdit\Actions\SilentEdit;
use Waterhole\Models\User;

class SilentEditServiceProvider extends Extend\ServiceProvider
{
    public function register(): void
    {
$this->app->extend(
    \Waterhole\Extend\Forms\GroupForm::class,
    function ($form) {
        $form->permissions->add(
            \Waterhole\SilentEdit\Forms\GroupSilentEditPermissions::class,
            'silent-edit',
        );

        $permissions = $form->permissions;

        $form->replace(
            'permissions',
            function ($model) use ($permissions) {
                if ($model?->isAdmin()) {
                    return null;
                }

                return new \Waterhole\Forms\FormSection(
                    __('waterhole::cp.group-permissions-title'),
                    $permissions->components(compact('model')),
                );
            },
        );

        return $form;
    },
);
        $this->extend(function (Extend\Core\Actions $actions) {
            $this->addAfterEdit($actions, Post::class);
            $this->addAfterEdit($actions, Comment::class);
        });
    }

    public function boot(): void
    {
        $this->loadTranslationsFrom(
            __DIR__ . '/../resources/lang',
            'waterhole-silent-edit'
        );

        Gate::define(
    'waterhole.silent-edit',
    fn (?User $user): bool => $user
        ? \Waterhole::permissions()->can(
            $user,
            'silent-edit',
            User::class,
        )
        : false,
);
    }

    private function addAfterEdit(
        Extend\Core\Actions $actions,
        string $modelClass,
    ): void {
        $list = $actions->for($modelClass);

        $items = [];

        foreach ($list->keys() as $key) {
            $items[$key] = $list->get($key);
            $list->remove($key);
        }

        $position = 0;

        foreach ($items as $key => $content) {
            $list->add($content, $key, $position++);

            if ($key === 'edit') {
                $list->add(
                    SilentEdit::class,
                    'silent-edit',
                    $position++,
                );
            }
        }
    }
}