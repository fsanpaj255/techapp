<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class CorreoController extends AbstractController
{
    #[Route('/email')]
    public function sendEmail(MailerInterface $mailer): Response
    {
        $email = (new Email())
        ->from('santoyopajaresf@gmail.com')
        ->to('santoyopajaresf@gmail.com')
        ->subject('Asunto del correo')
        ->text('Contenido del correo.');

    $mailer->send($email);

    return new Response('ENVIADO',Response::HTTP_BAD_REQUEST);

    }
}