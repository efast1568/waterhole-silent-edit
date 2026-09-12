<?php

use Waterhole\Extend;
use Waterhole\Models\Post;
use WaterholeSilentEdit\Actions\SilentEdit;

return [
    (new Extend\Core\Actions())
        ->for(Post::class)
        ->add(SilentEdit::class),
];