<?php

// This file has been auto-generated by the Symfony Dependency Injection Component for internal use.

if (\class_exists(\Container3FkPAF3\App_KernelDevDebugContainer::class, false)) {
    // no-op
} elseif (!include __DIR__.'/Container3FkPAF3/App_KernelDevDebugContainer.php') {
    touch(__DIR__.'/Container3FkPAF3.legacy');

    return;
}

if (!\class_exists(App_KernelDevDebugContainer::class, false)) {
    \class_alias(\Container3FkPAF3\App_KernelDevDebugContainer::class, App_KernelDevDebugContainer::class, false);
}

return new \Container3FkPAF3\App_KernelDevDebugContainer([
    'container.build_hash' => '3FkPAF3',
    'container.build_id' => '9ea5ddda',
    'container.build_time' => 1665086396,
], __DIR__.\DIRECTORY_SEPARATOR.'Container3FkPAF3');
