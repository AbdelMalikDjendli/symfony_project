<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerNhzlbxx\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerNhzlbxx/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerNhzlbxx.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerNhzlbxx\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerNhzlbxx\App_KernelDevDebugContainer([
    'container.build_hash' => 'Nhzlbxx',
    'container.build_id' => '35a4171d',
    'container.build_time' => 1675090258,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerNhzlbxx');
