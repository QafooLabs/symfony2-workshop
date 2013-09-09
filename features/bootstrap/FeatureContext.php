<?php

use Behat\Behat\Context\ClosuredContextInterface;
use Behat\Behat\Context\TranslatedContextInterface;
use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Exception\PendingException;
use Behat\Behat\Context\Step;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\Symfony2Extension\Context\KernelAwareInterface;

use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\HttpKernel\Client;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

/**
 * Features context.
 */
class FeatureContext extends MinkContext implements KernelAwareInterface
{
    /**
     * @var \Symfony\Component\HttpKernel\KernelInterface
     */
    private $kernel;

    /**
     * @var array
     */
    private $parameters;

    public function __construct(array $parameters)
    {
        $this->parameters = $parameters;
    }

    public function setKernel(KernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }

    public function setUp()
    {
        Date::setTestingNow(new \DateTime("now"));

        $container = $this->kernel->getContainer();

        $entityManager = $container->get('doctrine.orm.default_entity_manager');

        $metadatas = $entityManager->getMetadataFactory()->getAllMetadata();
        $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($entityManager);

        $schemaTool->dropSchema($metadatas);
        $schemaTool->createSchema($metadatas);

        // Load fixtures here

        $entityManager->flush();
        $entityManager->clear();
    }

    private $stock;

    /**
     * @Given /^there are "([^"]*)" steak on stock$/
     */
    public function thereAreSteakOnStock($arg1)
    {
        $this->stock = $arg1;
    }

    /**
     * @When /^I order a steack$/
     */
    public function iOrderASteack()
    {
        if ($this->stock == 0) {
            throw new \RuntimeException("No steak on stock");
        }
    }

    /**
     * @Then /^the waiter serves me a steak$/
     */
    public function theWaiterServesMeASteak()
    {
        echo "Hello steak!";
    }

}
