<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container8pohJwh\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container8pohJwh/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container8pohJwh.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container8pohJwh\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container8pohJwh\App_KernelDevDebugContainer([
    'container.build_hash' => '8pohJwh',
    'container.build_id' => 'b5419a5c',
    'container.build_time' => 1664901755,
], __DIR__.\DIRECTORY_SEPARATOR.'Container8pohJwh');
