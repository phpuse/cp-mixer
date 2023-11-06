<?php

namespace PhpUse\Mixer\Installers;

class LaralibInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected array $locations = [
        'lamo' => 'lamo/{$name}/',
        'lause' => 'lause/{$name}/',
        'layer' => 'layer/{$name}/',
    ];
}
