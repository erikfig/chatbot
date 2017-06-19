<?php

namespace App\Http\Controllers;

use CodeBot\CallSendApi;
use CodeBot\Message\Audio;
use CodeBot\Message\File;
use CodeBot\Message\Image;
use CodeBot\Message\Video;
use CodeBot\SenderRequest;
use CodeBot\Element\Button;
use CodeBot\Element\Product;
use CodeBot\TemplatesMessage\ButtonsTemplate;
use CodeBot\TemplatesMessage\GenericTemplate;
use CodeBot\TemplatesMessage\ListTemplate;
use CodeBot\WebHook;
use CodeBot\Message\Text;
use CodeBot\Build\Solid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $postback = $sender->getPostback();

        $bot = Solid::factory();
        Solid::pageAccessToken(config('botfb.pageAccessToken'));
        Solid::setSender($senderId);

        if ($postback) {
            $bot->message('text', 'OVocê chamou o postback '. $postback);
            return '';
        }

        $bot->message('text', 'Oii, eu sou um bot...');
        $bot->message('text', 'Você digitou: '. $message);
        $bot->message('image', 'http://fathomless-castle-56481.herokuapp.com/img/homer.gif');
        $bot->message('audio', 'http://fathomless-castle-56481.herokuapp.com/audio/woohoo.wav');
        $bot->message('file', 'http://fathomless-castle-56481.herokuapp.com/file/file.zip');
        $bot->message('video', 'http://fathomless-castle-56481.herokuapp.com/video/video.mp4');

        $buttons = [
            new Button('web_url', 'Code.Education', 'https://code.education'),
            new Button('web_url', 'Google', 'https://www.google.com.br'),
        ];
        $bot->template('buttons', 'Que tal testarmos a abertura de um site?', $buttons);

        $products = [
            new Product(
                'Produto 1',
                'https://media.licdn.com/mpr/mpr/AAEAAQAAAAAAAAqfAAAAJDQwZWJiNTdkLThiYjUtNGQ2YS1iMzJjLTRiMmQ5YjZiMDNiNw.png',
                'Curso de angular',
                new Button('web_url', null, 'https://angular.io/')
            ),
            new Product(
                'Produto 2', 'https://upload.wikimedia.org/wikipedia/commons/thumb/2/27/PHP-logo.svg/1200px-PHP-logo.svg.png',
                'Curso de PHP',
                new Button('web_url', null, 'http://www.php.net/')
            )
        ];


        $bot->template('generic', '', $products);
        $bot->template('list', '', $products);

        return '';
    }
}
