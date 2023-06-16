<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class CorreoController extends AbstractController
{
    #[Route('/correo', name: 'app_correo')]
    public function enviarcorreo(MailerInterface $mailer)
    {
        $email = (new Email())
        ->from('fcotrabajos8@gmail.com')
        ->to('fcotrabajos8@gmail.com')
        ->subject('Asunto del correo');

    $mailer->send($email);

    return $this->redirectToRoute('app_landing');

    }
}