<?php

namespace App;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function getProjectDir(): string
    {
        return dirname(__DIR__);
    }

    public function getAbsolutePath(string $path): string
    {
        return sprintf('%s/%s', $this->getProjectDir(), ltrim($path, '/'));
    }

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import($this->getAbsolutePath('config/{packages}/*.yaml'));
        $container->import($this->getAbsolutePath('config/{packages}/'.$this->environment.'/*.yaml'));

        if (is_file($this->getAbsolutePath('config/services.yaml'))) {
            $container->import($this->getAbsolutePath('config/services.yaml'));
            $container->import($this->getAbsolutePath('config/{services}_'.$this->environment.'.yaml'));
        } elseif (is_file($path = $this->getAbsolutePath('config/services.php'))) {
            (require $path)($container->withPath($path), $this);
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import($this->getAbsolutePath('config/{routes}/'.$this->environment.'/*.yaml'));
        $routes->import($this->getAbsolutePath('config/{routes}/*.yaml'));

        if (is_file($this->getAbsolutePath('config/routes.yaml'))) {
            $routes->import($this->getAbsolutePath('config/routes.yaml'));
        } elseif (is_file($path = $this->getAbsolutePath('config/routes.php'))) {
            (require $path)($routes->withPath($path), $this);
        }
    }
}
