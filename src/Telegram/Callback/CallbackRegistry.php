<?php
/*
 * This file is part of the BoShurikTelegramBotBundle.
 *
 * (c) Alexander Borisov <boshurik@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BoShurik\TelegramBotBundle\Telegram\Callback;

class CallbackRegistry
{
    /**
     * @var CallbackInterface[]
     */
    private $callbacks;

    public function __construct()
    {
        $this->callbacks = [];
    }

    /**
     * @param CallbackInterface $callback
     */
    public function addCallback(CallbackInterface $callback)
    {
        $this->callbacks[] = $callback;
    }

    /**
     * @return CallbackInterface[]
     */
    public function getCallbacks()
    {
        return $this->callbacks;
    }
} 