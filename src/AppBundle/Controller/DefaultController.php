<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('AppBundle:Accueil:index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    public function compteAction(Request $request) {



        return $this->render('AppBundle:Compte:compte.html.twig', [

            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    public function membreAction(Request $request) {

        $personne = $this->getUser();

        if($personne == null) {
            return $this->redirectToRoute('login');
        }

        $demandes = $personne->getDemandes();
        $propositions = $personne->getPropositions();

        return $this->render('AppBundle:Compte:membre.html.twig',array(
            'user'=> $this->getUser(),
            'demandes'=> $demandes,
            'propositions'=> $propositions,
        ));
    }

    public function profilAction(Request $request) {

        if($this->getUser() == null) {
            return $this->redirectToRoute('login');
        }

        $demandes = $this->getDoctrine()->getRepository('AppBundle:demande')->findAll();

        $competences = $this->getDoctrine()->getRepository('AppBundle:competence')->findAll();

        $personnes = $this->getDoctrine()->getRepository('AppBundle:personne')->findAll();

        return $this->render('AppBundle:Compte:profil.html.twig',array(
            'user'=> $this->getUser(),
            'personnes'=> $personnes,
            'demandes'=> $demandes,
            'competences' => $competences,
        ));
    }


    public function showDemande(Request $request) {

        return $this->render('AppBundle:Demande:showDemande.html.twig',array(
            'user'=> $this->getUser(),
        ));
    }

    public function showDemandes(Request $request) {

        $demandes = $this->getDoctrine()->getRepository('AppBundle:demande')->findAll();

        return $this->render('AppBundle:Demande:showDemandes.html.twig',array(
            'user'=> $this->getUser(),
            'demandes'=> $demandes,
        ));
    }

}
