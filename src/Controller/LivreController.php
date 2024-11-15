<?php
namespace App\Controller;

// src/Controller/LivreController.php
use App\Entity\Livre;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class LivreController extends AbstractController
{
    #[Route('/livres', name: 'app_livres')]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $livres = $entityManager->getRepository(Livre::class)->findAll();
        return $this->render('livre/ajouter/index.html.twig', ['livres' => $livres]);
    }

    #[Route('/livre/ajouter', name: 'app_livre_ajouter', methods: ['POST', 'GET'])]
    public function ajouter(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($request->isMethod('POST')) {
            $livre = new Livre();
            $livre->setTitre($request->request->get('titre'));
            $livre->setAuteur($request->request->get('auteur'));
            $livre->setDateDePublication(new \DateTime($request->request->get('datePublication')));
    
            try {
                $entityManager->persist($livre);
                $entityManager->flush();
                return $this->redirectToRoute('app_livres');
            } catch (\Exception $e) {
               
                $this->addFlash('error', 'An error occurred while adding the book: ' . $e->getMessage());
            }
        }
    
        return $this->render('livre/ajouter/ajouter.html.twig');
    }
}