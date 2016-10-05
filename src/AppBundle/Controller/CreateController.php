<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\EntityType;
use AppBundle\Entity\personne;
use AppBundle\Entity\competence;
use AppBundle\Entity\proposition;
use AppBundle\Entity\demande;

class CreateController extends Controller {

    public function newDemandeAction(Request $request) {

        if($this->getUser() == null) {
            return $this->redirectToRoute('login');
        }

        $demande = new Demande();
        $user = $this->getUser();

        $demandes = $this->getDoctrine()->getRepository('AppBundle:demande')->findAll();

        $personnes = $this->getDoctrine()->getRepository('AppBundle:personne')->findAll();

        $form = $this->createFormBuilder($demande)
            ->add('titre',TextType::class)
            ->add('texte',TextareaType::class)
            ->add('save',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if($form->isValid()) {

            $user->addDemande($demande);
            $demande->setPersonne($user);
            $em = $this->getDoctrine()->getManager();
            $em->persist($demande);
            $em->flush();

            return $this->redirectToRoute('membre');
        }

        else {

        }

        return $this->render('AppBundle:Demande:AjoutDemande.html.twig',array(
            'form' => $form->createView(),
            'user'=> $this->getUser(),
        ));

    }

    public function newPropositionAction(Request $request,$idDemande) {

        if($this->getUser() == null) {
            return $this->redirectToRoute('login');
        }


        $proposition = new Proposition();

        $demande = $this->getDoctrine()->getRepository('AppBundle:demande')->findOneById($idDemande);

        $form = $this->createFormBuilder($proposition)
            ->add('titre',TextType::class)
            ->add('text',TextareaType::class, array('attr' => array('cols' => '75', 'rows' => '50')))
            ->add('save',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if($form->isValid()) {

            $proposition->setDemande($demande);
            $proposition->getDemande()->addProposition($proposition);
            $em = $this->getDoctrine()->getManager();
            $em->persist($proposition);
            $em->flush();

            return $this->redirectToRoute('membre');
        }

        return $this->render('AppBundle:Demande:showDemandeRepondre.html.twig',array(
            'form' => $form->createView(),
            'user'=> $this->getUser(),
            'demande' => $demande,
        ));

    }


    public function newPersonneAction(Request $request) {

        $personne = new Personne();

        $form = $this->createFormBuilder($personne)
            ->add('username',TextType::class)
            ->add('password',PasswordType::class)
            ->add('prenom',TextType::class)
            ->add('nom',TextType::class)
            ->add('email',TextType::class)
            ->add('ville',TextType::class)
            ->add('numeroTelephone',NumberType::class)
            ->add('save',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);  // Gestion automatique de la requête reçue ( La requête POST dans notre cas )

        if($form->isValid()) {  // Vérification de la validité du formulaire
            $em = $this->getDoctrine()->getManager();  //Manager de la base de données
            $encoder = $this->container->get('security.password_encoder');  // Encodage du mot de passe
            $encoded = $encoder->encodePassword($personne, $personne->getPassword());
            $personne->setPassword($encoded);
            $em->persist($personne); // Persistance de l'éleve dans la base de donnée
            $em->flush();

            // Rendu de la page d'affichage d'inscription réussie
            return $this->redirectToRoute('membre');
        }

        else {

        }

        return $this->render('AppBundle:Compte:inscription.html.twig', array(
            'form' => $form->createView(),
        ));
    }






}