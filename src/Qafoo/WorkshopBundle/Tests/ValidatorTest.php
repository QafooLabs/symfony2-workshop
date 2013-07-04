<?php

namespace Qafoo\WorkshopBundle\Tests;

use Qafoo\WorkshopBundle\Model\Player;

/**
 * @group integration
 */
class ValidatorTest extends KernelTestCase
{
    public function testValidatePlayer()
    {
        $validator = $this->container->get('validator');
        $player = new Player();

        $constraintViolationList = $validator->validate($player);

        $this->assertEquals(1, count($constraintViolationList));
        $this->assertEquals('This value should not be blank.',
            $constraintViolationList[0]->getMessageTemplate()
        );
        $this->assertEquals('name',
            $constraintViolationList[0]->getPropertyPath()
        );
    }
}
