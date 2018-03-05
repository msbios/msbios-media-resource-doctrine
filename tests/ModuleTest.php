<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBiosTest\Media\Resource\Doctrine;

use MSBios\Media\Resource\Doctrine\Module;
use PHPUnit\Framework\TestCase;

/**
 * Class ModuleTest
 * @package MSBiosTest\Media\Resource\Doctrine
 */
class ModuleTest extends TestCase
{
    /**
     * @return $this
     */
    public function testGetConfig()
    {
        $this->assertInternalType('array', (new Module)->getConfig());
        return $this;
    }

    /**
     * @return $this
     */
    public function testGetAutoloaderConfig()
    {
        $this->assertInternalType('array', (new Module)->getAutoloaderConfig());
        return $this;
    }
}
