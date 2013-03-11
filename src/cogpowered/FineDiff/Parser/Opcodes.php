<?php

/**
* FINE granularity DIFF
*
* Computes a set of instructions to convert the content of
* one string into another.
*
* Originally created by Raymond Hill (github.com/gorhill/PHP-FineDiff), brought up
* to date by Cog Powered (github.com/cogpowered/FineDiff).
*
* @copyright Copyright 2011 (c) Raymond Hill (http://raymondhill.net/blog/?p=441)
* @copyright Copyright 2013 (c) Robert Crowe (http://cogpowered.com)
* @link https://github.com/cogpowered/FineDiff
* @version 0.0.1
* @license MIT License (http://www.opensource.org/licenses/mit-license.php)
*/

namespace cogpowered\FineDiff\Parser;

use cogpowered\FineDiff\Exceptions\OperationException;

class Opcodes implements OpcodesInterface
{
    protected $opcodes = array();

    public function __construct(array $opcodes)
    {
        // Ensure that all elements of the array
        // are of the correct type
        foreach ($opcodes as $opcode) {
            if (!is_a($opcode, 'cogpowered\FineDiff\Parser\Operations\OperationInterface')) {
                throw new OperationException('Invalid opcode object');
            }

            $this->opcodes[] = $opcode->getOpcode();
        }
    }

    public function getOpcodes()
    {
        return $this->opcodes;
    }

    public function generate()
    {
        return implode('', $this->opcodes);
    }

    public function __toString()
    {
        return $this->generate();
    }
}