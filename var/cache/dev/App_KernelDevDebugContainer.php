<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container3MnspZE\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container3MnspZE/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container3MnspZE.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container3MnspZE\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container3MnspZE\App_KernelDevDebugContainer([
    'container.build_hash' => '3MnspZE',
    'container.build_id' => '65980902',
    'container.build_time' => 1663717200,
], __DIR__.\DIRECTORY_SEPARATOR.'Container3MnspZE');
