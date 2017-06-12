<?php

namespace App\Http\Controllers;

use CodeBot\CallSendApi;
use CodeBot\Message\Audio;
use CodeBot\Message\File;
use CodeBot\Message\Image;
use CodeBot\Message\Video;
use CodeBot\SenderRequest;
use CodeBot\Element\Button;
use CodeBot\TemplatesMessage\ButtonsTemplate;
use CodeBot\WebHook;
use CodeBot\Message\Text;
use Illuminate\Http\Request;

class BotController extends Controller
{
    public function subscribe()
    {
        $webhook = new WebHook;
        $subscribe = $webhook->check(config('botfb.validationToken'));
        if (!$subscribe) {
            abort(403, 'Unauthorized action.');
        }
        return $subscribe;
    }

    public function receiveMessage(Request $request)
    {
        $sender = new SenderRequest;
        $senderId = $sender->getSenderId();
        $message = $sender->getMessage();

        $text = new Text($senderId);
        $callSendApi = new CallSendApi(config('botfb.pageAccessToken'));

        $callSendApi->make($text->message('Oii, eu sou um bot...'));
        $callSendApi->make($text->message('Você digitou: '. $message));

        $message = new Image($senderId);
        $callSendApi->make($message->message('http://fathomless-castle-56481.herokuapp.com/img/homer.gif'));

        $message = new Audio($senderId);
        $callSendApi->make($message->message('http://fathomless-castle-56481.herokuapp.com/audio/woohoo.wav'));

        $message = new File($senderId);
        $callSendApi->make($message->message('http://fathomless-castle-56481.herokuapp.com/file/file.zip'));

        $message = new Video($senderId);
        $callSendApi->make($message->message('http://fathomless-castle-56481.herokuapp.com/video/video.mp4'));

        $message = new ButtonsTemplate($senderId);
        $message->add(new Button('web_url', 'Code.Education', 'https://code.education'));
        $message->add(new Button('web_url', 'Google', 'https://www.google.com.br'));
        $callSendApi->make($message->message('Que tal testarmos a abertura de um site?'));

        return '';
    }
}
