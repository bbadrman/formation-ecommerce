<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerVjD7tK2\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerVjD7tK2/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerVjD7tK2.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerVjD7tK2\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerVjD7tK2\App_KernelDevDebugContainer([
    'container.build_hash' => 'VjD7tK2',
    'container.build_id' => '2ac3b289',
    'container.build_time' => 1663432984,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerVjD7tK2');
