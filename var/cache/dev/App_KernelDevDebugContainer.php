<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerNLYxBUd\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerNLYxBUd/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerNLYxBUd.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerNLYxBUd\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerNLYxBUd\App_KernelDevDebugContainer([
    'container.build_hash' => 'NLYxBUd',
    'container.build_id' => '709982eb',
    'container.build_time' => 1663711515,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerNLYxBUd');
