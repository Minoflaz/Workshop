<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Model\FakeBoolean;

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

    public function profilAction(Request $request,$idPersonne) {

        if($this->getUser() == null) {
            return $this->redirectToRoute('login');
        }





        $personne = $this->getDoctrine()->getRepository('AppBundle:personne')->findOneById($idPersonne);

        return $this->render('AppBundle:Compte:profil.html.twig',array(
            'user'=> $this->getUser(),
            'personne'=> $personne,
        ));
    }


    public function showDemandeAction(Request $request,$idDemande) {

        $demande = $this->getDoctrine()->getRepository('AppBundle:demande')->findOneById($idDemande);

        return $this->render('AppBundle:Demande:showDemande.html.twig',array(
            'user'=> $this->getUser(),
            'demande'=> $demande,
        ));
    }

    public function showDemandesAction(Request $request) {

        $demandes = $this->getDoctrine()->getRepository('AppBundle:demande')->findAll();

        return $this->render('AppBundle:Demande:showDemandes.html.twig',array(
            'user'=> $this->getUser(),
            'demandes'=> $demandes,
        ));
    }


    public function  showPropositionsAction(Request $request,$idDemande) {

        if($this->getUser() == null) {
            return $this->redirectToRoute('login');
        }

        $demande = $this->getDoctrine()->getRepository('AppBundle:demande')->findOneById($idDemande);

        $propositions = $demande->getPropositions();

        return $this->render('AppBundle:Proposition:showPropositions.html.twig',array(
            'user'=> $this->getUser(),
            'demande'=> $demande,
            'propositions'=> $propositions,
        ));

    }

    public function showPropositionAction(Request $request,$idProposition) {

        if($this->getUser() == null) {
            return $this->redirectToRoute('login');
        }


        $proposition = $this->getDoctrine()->getRepository('AppBundle:proposition')->findOneById($idProposition);

        return $this->render('AppBundle:Proposition:showProposition.html.twig',array(
            'user'=> $this->getUser(),
            'proposition'=> $proposition,
        ));
    }

    public function validerPropositionAction(Request $request,$idProposition) {

        if($this->getUser() == null) {
            return $this->redirectToRoute('login');
        }

        $proposition = $this->getDoctrine()->getRepository('AppBundle:proposition')->findOneById($idProposition);

        $proposition->setStatut(true);

        return $this->redirectToRoute('membre');

    }

}
