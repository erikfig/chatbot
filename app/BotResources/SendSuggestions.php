<?php

namespace App\BotResources;

use App\Repositories\SuggestionsRepository;
use CodeBot\Bot;
use CodeBot\SenderRequest;
use CodeBot\Resources\ResourceInterface;

class SendSuggestions implements ResourceInterface
{
    public function __invoke(SenderRequest $sender, Bot $bot) :bool
    {
        $suggestion = new SuggestionsRepository;
        if ($suggestion->statusCheck($sender->getSenderId()) === 'started') {
            $suggestion->create($sender->getSenderId(), $sender->getMessage());

            $bot->message('text', 'Obrigado, sua sugestão foi enviada com sucesso');
            $suggestion->statusStop($sender->getSenderId());

            return true;
        }
        return false;
    }

    public function statusStart(SenderRequest $sender, Bot $bot)
    {
        (new SuggestionsRepository)->statusStop($sender->getSenderId());
        $bot->message('text', 'Ok, por favor, qual sua sugestão?');
        $bot->message('text', 'Você pode digitar, mas envie a sugestão em uma única mensagem');
    }
}