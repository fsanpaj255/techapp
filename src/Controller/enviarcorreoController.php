<?php
 
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Pdf\Pdf;
use Twig\Environment;

class enviarcorreoController extends AbstractController
{
    #[Route('/enviar-correo', name: 'app_enviarcorreo')]
    public function enviarPedido(MailerInterface $mailer, Environment $twig): Response
    {
        // Obtener los datos del pedido y del usuario
        $productos = []; // Aquí debes obtener los datos de los productos del pedido
        $usuario = $this->getUser(); // Obtener el usuario actualmente logueado
        
        // Generar el contenido HTML del pedido utilizando Twig
        $contenidoHtml = $twig->render('pago/pedido.html.twig', [
            'productos' => $productos,
            'usuario' => $usuario,
        ]);
        
        // Crear un PDF a partir del contenido HTML
        $pdf = new Pdf();
        $pdf->setBinary('/usr/local/bin/wkhtmltopdf'); // Ruta al ejecutable de wkhtmltopdf
        $pdf->generateFromHtml($contenidoHtml, '/ruta/al/archivo/pedido.pdf');
        
        // Crear el mensaje de correo electrónico
        $email = (new Email())
            ->from('tu@correo.com')
            ->to($usuario->getEmail()) // Utiliza el correo electrónico del usuario
            ->subject('Confirmación de pedido')
            ->text('Adjuntamos el PDF con los detalles de tu pedido.')
            ->attachFromPath('/ruta/al/archivo/pedido.pdf');
        
        // Enviar el correo electrónico
        $mailer->send($email);
        
        // Eliminar el archivo PDF generado
        unlink('/ruta/al/archivo/pedido.pdf');
        
        // Redirigir al usuario a la página de agradecimiento
        return $this->redirectToRoute('pagina_agradecimiento');
    }
}