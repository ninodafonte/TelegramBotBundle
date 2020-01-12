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

use TelegramBot\Api\Types\Update;

abstract class AbstractCallback implements CallbackInterface
{
    /**
     * RegExp for bot commands
     */
    const REGEXP = '/^([^\s@]+)(@\S+)?\s?(.*)$/';

    /**
     * @return string
     */
    abstract public function getName();

    /**
     * @inheritDoc
     */
    public function isApplicable(Update $update)
    {
        $callbackQuery = $update->getCallbackQuery();
        if (!is_null($callbackQuery) && $callbackQuery->getData()) {
            $callbackData = explode(' ', $callbackQuery->getData());
            if ($callbackData[0] == $this->getName()) {
                return true;
            }
        }

        return false;
    }

    public function getParams(Update $update)
    {
        $callbackQuery = $update->getCallbackQuery();
        $callbackData  = explode(' ', $callbackQuery->getData());

        return count($callbackData) > 1 ? array_slice($callbackData, 1) : null;
    }
}