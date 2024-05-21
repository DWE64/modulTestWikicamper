<?php


namespace App\MessageHandler;


use App\Message\MailContact;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
class MailContactHandler extends AbstractMessageHandler
{
    public function __invoke(MailContact $mail)
    {
        try {
            $email=(new TemplatedEmail())
                ->from($mail->getEmail())
                ->to($mail->getDestinataire())
                ->subject($mail->getSubject())
                ->htmlTemplate('mail/mail_contact.html.twig')
                ->context(
                    [
                        'firstname' => $mail->getFirstname(),
                        'name' => $mail->getName(),
                        'mail' => $mail->getEmail(),
                        'phone' => $mail->getPhone(),
                        'content' => $mail->getContent(),
                        'id'=> $mail->getIdRental(),
                        'title'=> $mail->getTitleRental()
                    ]
                );
            $this->mailer->send($email);
            return;
        }catch (TransportExceptionInterface $e){
            print_r($e);
            return null;
        }
    }
}