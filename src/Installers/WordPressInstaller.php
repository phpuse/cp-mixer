<?php

namespace PhpUse\Mixer\Installers;

class WordPressInstaller extends BaseInstaller
{
    /** @var array<string, string> */
    protected array $locations = [
        'plugin'    => 'wp-content/plugins/{$name}/',
        'theme'     => 'wp-content/themes/{$name}/',
        'muplugin'  => 'wp-content/mu-plugins/{$name}/',
        'dropin'    => 'wp-content/{$name}/',
    ];
}
