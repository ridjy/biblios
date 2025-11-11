<?php

namespace App\Controller;

use Knp\Bundle\SnappyBundle\Snappy\Response\PdfResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    #[Route('/pdf', name: 'app_pdf_generate')]
    public function generatePDF(\Knp\Snappy\Pdf $knpSnappyPdf): Response
    {
        $html = $this->renderView('pdf/index.html.twig', array(
            'some'  => 'var'
        ));

        return new PdfResponse(
            $knpSnappyPdf->getOutputFromHtml($html),
            'file.pdf',
            'application/pdf',
            'inline'
        );
    }
}
