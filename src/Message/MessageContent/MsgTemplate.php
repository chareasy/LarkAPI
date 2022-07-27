<?php
/**
 * Don't let love live in memory.
 * user: CharEasy
 * Date：2022/7/25
 * Time: 14:30.
 */

namespace CharEasy\LarkApi\Message\MessageContent;

abstract class MsgTemplate
{
    abstract public function buildMsg();
}
