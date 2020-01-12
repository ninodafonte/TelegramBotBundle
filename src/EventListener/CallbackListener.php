<?php
/*
 * This file is part of the BoShurikTelegramBotBundle.
 *
 * (c) Alexander Borisov <boshurik@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace BoShurik\TelegramBotBundle\EventListener;

use TelegramBot\Api\BotApi;
use BoShurik\TelegramBotBundle\Telegram\Callback\CallbackRegistry;
use BoShurik\TelegramBotBundle\Event\UpdateEvent;

class CallbackListener
{
    /**
     * @var BotApi
     */
    private $api;

    /**
     * @var CallbackRegistry
     */
    private $callbackRegistry;

    public function __construct(BotApi $api, CallbackRegistry $callbackRegistry)
    {
        $this->api              = $api;
        $this->callbackRegistry = $callbackRegistry;
    }

    /**
     * @param UpdateEvent $event
     */
    public function onUpdate(UpdateEvent $event)
    {
        foreach ($this->callbackRegistry->getCallbacks() as $callback) {
            if ($callback->isApplicable($event->getUpdate())) {
                $callback->execute($this->api, $event->getUpdate());
                $event->setProcessed();
                break;
            }
        }
    }
}