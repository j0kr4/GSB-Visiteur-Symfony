<?php

namespace App\Controller;


use App\Entity\Visiteur;
use App\Entity\FicheFrais;
use App\Form\FicheFraisType;
use App\Form\ConnexionType;
use App\Form\VisiteurType;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



use App\Controller\VisiteurController;

class VisiteurController extends AbstractController
{


    /**
     * @Route("/ajoutVisiteur", name="AjoutVisiteur")
     */
    public function AjoutVisiteur(Request $request)
    {
        $visiteur = new Visiteur();
        $form = $this->createForm(VisiteurType::class, $visiteur);
        $form->handleRequest($request);
        if($request->isMethod('POST'))
        {
            if($form->isValid())
            {
                $manager = $this->getDoctrine()->getManager();
                $manager->persist($visiteur);
                $manager->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Visiteur enregistré.');
                //return $this->redirectToRoute('rli_exame_homepage_1', array('id' => $etudiant->getId()));
                return new Response("Le visiteur a été ajouter.");

            }
        }
        return $this->render('visiteur/ajout.html.twig', array('form' => $form->createView(),));
    }


    /**
     * @Route("/login", name="login")
     */
    public function LoginVisiteur(Request $request)
    {
        $visiteur = new Visiteur;
        $summit = false;
        $form = $this->createForm(ConnexionType::class, $visiteur);

        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid())
        {
            $login = $form['login']->getData();
            $password = $form['mdp']->getData();
            $lesVisiteurs = new visiteur();
            $lesVisiteurs = $this->getDoctrine()->getRepository(Visiteur::class)->seConnecter($login, $password);

            if($lesVisiteurs != null) 
            {
                $session = new Session();
                $session->set('user_nom', $lesVisiteurs->getNom());
                $session->set('user_prenom', $lesVisiteurs->getPrenom());
                $session->set('user_id', $lesVisiteurs->getId());
                $session->set('login', 'Bonjour');
                $_SESSION = array();
                $_SESSION['login'] = true;
                $_SESSION['visiteur'] = $lesVisiteurs;
                return $this->redirect('CompteVisiteur');
            }
            $summit = true;
        }
        return $this->render('visiteur/login.html.twig', array('form'=>$form->createView(),'essie'=>$summit,));
    }

    /**
     * @Route("/CompteVisiteur", name="CompteVisiteur")
     */
    public function CompteVisiteur()
    {
        if(isset($_SESSION['login'])){
            if($_SESSION['login'] == true){
                return $this->render('visiteur/index.html.twig');
            }
        }

    }


}
