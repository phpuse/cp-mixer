<?php

namespace PhpUse\Mixer\Installers;

class LaralibInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected array $locations = [
        'lada' => 'lada/{$name}/',
        'lams' => 'lams/{$name}/',
        'layer' => 'layer/{$name}/',
    ];
}
