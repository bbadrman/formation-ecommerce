<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\ContainerRSVOmQY\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/ContainerRSVOmQY/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/ContainerRSVOmQY.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\ContainerRSVOmQY\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \ContainerRSVOmQY\App_KernelDevDebugContainer([
    'container.build_hash' => 'RSVOmQY',
    'container.build_id' => '2f932293',
    'container.build_time' => 1664736479,
], __DIR__.\DIRECTORY_SEPARATOR.'ContainerRSVOmQY');
