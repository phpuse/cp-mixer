<?php

namespace PhpUse\Mixer\Installers;

class LaraEaseInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected array $locations = [
        'lamo'    => 'lamo/{$name}/',
        'lalib' => 'lalib/{$name}/',
    ];
}
