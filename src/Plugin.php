<?php

namespace PhpUse\Mixer;

use Composer\Composer;
use Composer\IO\IOInterface;
use Composer\Plugin\PluginInterface;
use Composer\Script\Event as ScriptEvent;
use Composer\Script\ScriptEvents;

class Plugin implements PluginInterface
{

    const CALLBACK_PRIORITY = 1000;

    /** @var Installer */
    private Installer $installer;

    /**
     * @param Composer $composer 项目的 composer 文件 对应的类
     * @param IOInterface $io
     * @return void
     */
    public function activate(Composer $composer, IOInterface $io): void
    {
        $this->installer = new Installer($io, $composer);
        $composer->getInstallationManager()->addInstaller($this->installer);
    }

    /**
     * @param Composer $composer
     * @param IOInterface $io
     * @return void
     */
    public function deactivate(Composer $composer, IOInterface $io): void
    {
        $composer->getInstallationManager()->removeInstaller($this->installer);
    }

    public function uninstall(Composer $composer, IOInterface $io): void
    {
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents(): array
    {
        return [
//            PluginEvents::INIT =>
//                ['onInit', self::CALLBACK_PRIORITY],
            ScriptEvents::POST_INSTALL_CMD =>
                ['onPostInstallOrUpdate', self::CALLBACK_PRIORITY],
            ScriptEvents::POST_UPDATE_CMD =>
                ['onPostInstallOrUpdate', self::CALLBACK_PRIORITY],
        ];
    }


    /**
     * Handle an event callback for an install, update or dump command by
     * checking for "merger" in the "extra" data and merging package
     * contents if found.
     *
     * @param ScriptEvent $event
     */
    public function onPostInstallOrUpdate(ScriptEvent $event)
    {
        var_dump($event);
    }

}
