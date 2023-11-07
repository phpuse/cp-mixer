<?php

namespace PhpUse\Mixer;

use Composer\Composer;
use Composer\DependencyResolver\Operation\InstallOperation;
use Composer\DependencyResolver\Operation\UpdateOperation;
use Composer\EventDispatcher\EventSubscriberInterface;
use Composer\Installer\PackageEvent;
use Composer\Installer\PackageEvents;
use Composer\IO\IOInterface;
use Composer\Package\Package;
use Composer\Plugin\PluginInterface;

class Plugin implements PluginInterface, EventSubscriberInterface
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
            PackageEvents::POST_PACKAGE_UPDATE => [
                'onPackageInstallOrUpdate', self::CALLBACK_PRIORITY
            ],
            PackageEvents::POST_PACKAGE_INSTALL => [
                'onPackageInstallOrUpdate', self::CALLBACK_PRIORITY
            ]
        ];
    }

    /**
     *
     * @param PackageEvent $event
     * @return void
     */
    public function onPackageInstallOrUpdate(PackageEvent $event)
    {
        $rootPackage = $event->getComposer()->getPackage();
        /** @var UpdateOperation|InstallOperation $operation */
        $operation = $event->getOperation();
        if ($operation instanceof UpdateOperation) {
            /** @var Package $installedPackage */
            $installedPackage = $operation->getTargetPackage();
        } else {
            /** @var Package $installedPackage */
            $installedPackage = $operation->getPackage();
        }

        if (!$event->isDevMode()) {
            $installedPackagePath = $this->installer->getInstallPath($installedPackage);
            rmdir($installedPackagePath . '.git');
        }
    }
}
