<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerO0edDP3\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerO0edDP3/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerO0edDP3.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerO0edDP3\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerO0edDP3\App_KernelDevDebugContainer([
    'container.build_hash' => 'O0edDP3',
    'container.build_id' => '07be9256',
    'container.build_time' => 1665259472,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerO0edDP3');
