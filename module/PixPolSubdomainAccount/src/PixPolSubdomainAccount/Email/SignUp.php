<?php
/**
 * This file is part of pixelpolishers.com.
 *
 * @copyright Copyright (c) 2012-2013 Pixel Polishers. All rights reserved.
 * @link https://github.com/pixelpolishers/pixelpolishers.com for the canonical source repository
 */

namespace PixPolSubdomainAccount\Email;

use Zend\Mail\Message;
use Zend\Mail\Transport\Sendmail;
use Zend\Mime\Part as MimePart;
use Zend\Mime\Mime;
use Zend\Mime\Message as MimeMessage;

class SignUp extends AbstractEmail
{
    private $user;
    private $password;

    public function __construct($user, $password)
    {
        $this->user = $user;
        $this->password = $password;
    }

    private function createTextPart()
    {
        $content = 'Hi ' . $this->user->getName() . ',

Welcome to Pixel Polishers! With this account you are able to join discussions on our development
portal. You can login with this e-mail address and the following password: ' . $this->password . '

Cheers,

The Pixel Polishers team';

        $part = new MimePart($content);
        $part->type = "text/plain";
        $part->charset = 'utf-8';
        $part->disposition = Mime::DISPOSITION_INLINE;
        return $part;
    }

    private function createHtmlPart()
    {
        $content = '<div style="margin: 0px auto; width: 500px;">
            <div style="background-color: ' . $this->getTopBarColor() . '; padding: 10px 20px 5px 10px;">
                <img src="cid:logo" />
            </div>
            <div style="background-color: ' . $this->getSubBarColor() . '; height: 20px;">&nbsp;</div>
            <div style="background-color: #FFF; font-family: verdana, arial, courier; line-height: 25px; font-size: 12px; padding: 10px 0px;">
                <p style="line-height: 25px;">
                    Hi ' . $this->user->getName() . ',
                </p>
                <p style="line-height: 25px;">
                    Welcome to Pixel Polishers! With this account you are able to join discussions on
                    our development portal. You can login with this e-mail address and the following
                    password: <strong>' . $this->password . '</strong>
                </p>
                <p style="line-height: 25px;">
                    Cheers,
                </p>
                <p style="line-height: 25px;">
                    The Pixel Polishers team
                </p>
            </div>
        </div>';

        $part = new MimePart($content);
        $part->type = "text/html";
        $part->charset = 'utf-8';
        $part->disposition = Mime::DISPOSITION_INLINE;
        return $part;
    }

    private function createImagePart($id, $path)
    {
        $image = new MimePart(fopen($path, 'r'));
        $image->type = "image/png";
        $image->encoding = Mime::ENCODING_BASE64;
        $image->id = $id;
        $image->filename = basename($path);
        return $image;
    }

    public function send()
    {
        $textPart = $this->createTextPart();
        $htmlPart = $this->createHtmlPart();

        $alternativeMime = new MimeMessage();
        $alternativeMime->addPart($textPart);
        $alternativeMime->addPart($htmlPart);

        $alternativePart = new MimePart($alternativeMime->generateMessage());
        $alternativePart->type = 'multipart/alternative';
        $alternativePart->boundary = $alternativeMime->getMime()->boundary();
        $alternativePart->charset = 'utf-8';

        $logoPath = realpath('htdocs/www/img/logo/transparent-white.png');
        $logoPart = $this->createImagePart('logo', $logoPath);

        $body = new MimeMessage();
        $body->addPart($alternativePart);
        $body->addPart($logoPart);

        $message = new Message();
        $message->setSubject('Welcome to Pixel Polishers');
        $message->setFrom('no-reply@pixelpolishers.com', 'Pixel Polishers');
        $message->addTo($this->user->getEmail(), $this->user->getDisplayName());
        $message->setBody($body);

        $transport = new Sendmail();
        $transport->send($message);
    }
}
