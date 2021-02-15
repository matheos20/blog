<?php

namespace App\Controller;
use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EtudiantController extends AbstractController
{
    /**
     * @Route("/", name="etudiant")
     */
    public function index(EtudiantRepository $repo): Response
    {
        return $this->render('etudiant/index.html.twig',[
            'listes' => $repo->findAll()
        ]);
    }
    /**
     * @Route("/etudiant/supp/{id}", name="etudiant_sup")
     */
    public function supp($id,EtudiantRepository $repo): Response
    {
       $data = $repo->find($id);
       $em = $this->getDoctrine()->getManager();
       $em->remove($data);
       $em->flush();
       $this->addFlash('success', 'suppression avec succes');
       return $this->redirectToRoute('etudiant');

    }

    /**
     * @Route("/etudiant/ajout", name="etudiant_ajout")
     */
    public function ajouter(Request $request): Response
    {
        $etudiant = new Etudiant();

        $form = $this->createForm(EtudiantType::class, $etudiant);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiant);
            $em->flush();

            $this->addFlash('success', 'ajout avec succes');
            return $this->redirectToRoute('etudiant');

            
        }

        
        return $this->render('etudiant/ajouter.html.twig',[
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/etudiant/edit/{id}", name="etudiant_edit")
     */
    public function edit(Request $request,Etudiant $etudiant): Response
    {

        $form = $this->createForm(EtudiantType::class, $etudiant);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $em = $this->getDoctrine()->getManager();
            $em->persist($etudiant);
            $em->flush();

            $this->addFlash('success', 'edit avec succes');
            return $this->redirectToRoute('etudiant');


        }


        return $this->render('etudiant/edit.html.twig',[
            'form' => $form->createView()
        ]);
    }

}
