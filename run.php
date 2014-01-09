<?php
/**
 * User: diegofonseca
 * Date: 09/01/14
 * Time: 13:37
 */
require_once 'vendor/autoload.php';
include_once 'config.php';
ini_set("display_errors", $configuration['display_error']);
$classLoader = new \Doctrine\Common\ClassLoader('Doctrine');
$classLoader->register();

$config = new \Doctrine\ORM\Configuration();
$config->setMetadataDriverImpl($config->newDefaultAnnotationDriver($configuration['entities']['path']));
$config->setMetadataCacheImpl(new \Doctrine\Common\Cache\ArrayCache);
$config->setProxyDir($configuration['proxies']['path']);
$config->setProxyNamespace($configuration['proxies']['name']);

$connectionParams = $configuration['db'];
$em = \Doctrine\ORM\EntityManager::create($connectionParams, $config);
$driver = new \Doctrine\ORM\Mapping\Driver\DatabaseDriver($em->getConnection()->getSchemaManager());
$em->getConfiguration()->setMetadataDriverImpl($driver);
$cmf = new \Doctrine\ORM\Tools\DisconnectedClassMetadataFactory();
$cmf->setEntityManager($em);

$classes = $driver->getAllClassNames();
$metadata = array();
foreach ($classes as $class) {
    $metadata[] = $cmf->getMetadataFor($class);
}
$generator = new \Doctrine\ORM\Tools\EntityGenerator();
$generator->setRegenerateEntityIfExists(true);
$generator->setGenerateStubMethods($configuration['getter_setter']);
$generator->setGenerateAnnotations($configuration['annotation']);
$generator->generate($metadata, $configuration['entities']['path']);
print $configuration['message'];
