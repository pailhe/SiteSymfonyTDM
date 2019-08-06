<?php

namespace App\Controller;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Pays;
use App\Entity\Profil;
use App\Entity\User;
use App\Entity\Utilisateur;
use App\Form\ArticleType;
use App\Form\CategorieType;
use App\Form\PaysType;
use App\Form\ProfilType;
use App\Form\UserType;
use App\Form\UtilisateurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

    /**
     * @Route("/admin/articleForm_insert", name="article_form_insert")
     */
    public function articleFormInsert(Request $request, EntityManagerInterface $entityManager)
    {
        // Utilisation du fichier AuthorType pour créer le formulaire
        // (ne contient pas encore de html)
        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);
        // création de la view du formulaire
        $formArticleView = $form->createView();
        // Si la méthode est POST
        // si le formulaire est envoyé
        if ($request->isMethod('Post')) {
            // Le formulaire récupère les infos
            // de la requête
            $form->handleRequest($request);
            // on vérifie que le formulaire est valide
            if ($form->isValid()) {
                // On enregistre l'entité créée avec persist
                // et flush
                $entityManager->persist( $article );
                $entityManager->flush();
            }
        }
        return $this->render('admin/articleFormInsert.html.twig',
            [
                // envoie de la view du form au fichier twig
                'formArticleView' => $formArticleView
            ]
        );
    }

    /**
     * @Route("/admin/categorieForm_insert", name="categorie_form_insert")
     */
    public function categorieFormInsert(Request $request, EntityManagerInterface $entityManager)
    {
        // Utilisation du fichier AuthorType pour créer le formulaire
        // (ne contient pas encore de html)
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        // création de la view du formulaire
        $formCategorieView = $form->createView();
        // Si la méthode est POST
        // si le formulaire est envoyé
        if ($request->isMethod('Post')) {
            // Le formulaire récupère les infos
            // de la requête
            $form->handleRequest($request);
            // on vérifie que le formulaire est valide
            if ($form->isValid()) {
                // On enregistre l'entité créée avec persist
                // et flush
                $entityManager->persist( $categorie );
                $entityManager->flush();
            }
        }
        return $this->render('admin/categorieFormInsert.html.twig',
            [
                // envoie de la view du form au fichier twig
                'formCategorieView' => $formCategorieView
            ]
        );
    }

    /**
     * @Route("/admin/paysForm_insert", name="pays_form_insert")
     */
    public function paysFormInsert(Request $request, EntityManagerInterface $entityManager)
    {
        // Utilisation du fichier AuthorType pour créer le formulaire
        // (ne contient pas encore de html)
        $pays = new Pays();
        $form = $this->createForm(PaysType::class, $pays);
        // création de la view du formulaire
        $formPaysView = $form->createView();
        // Si la méthode est POST
        // si le formulaire est envoyé
        if ($request->isMethod('Post')) {
            // Le formulaire récupère les infos
            // de la requête
            $form->handleRequest($request);
            // on vérifie que le formulaire est valide
            if ($form->isValid()) {
                // On enregistre l'entité créée avec persist
                // et flush
                $entityManager->persist( $pays );
                $entityManager->flush();
            }
        }
        return $this->render('admin/paysFormInsert.html.twig',
            [
                // envoie de la view du form au fichier twig
                'formPaysView' => $formPaysView
            ]
        );
    }

    /**
     * @Route("/admin/utilisateurForm_insert", name="utilisateur_form_insert")
     */
    public function utilisateurFormInsert(Request $request, EntityManagerInterface $entityManager)
    {
        // Utilisation du fichier AuthorType pour créer le formulaire
        // (ne contient pas encore de html)
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        // création de la view du formulaire
        $formUserView = $form->createView();
        // Si la méthode est POST
        // si le formulaire est envoyé
        if ($request->isMethod('Post')) {
            // Le formulaire récupère les infos
            // de la requête
            $form->handleRequest($request);
            // on vérifie que le formulaire est valide
            if ($form->isValid()) {
                // On enregistre l'entité créée avec persist
                // et flush
                $entityManager->persist( $user );
                $entityManager->flush();
            }
        }
        return $this->render('admin/utilisateurFormInsert.html.twig',
            [
                // envoie de la view du form au fichier twig
                'formUtilisateurView' => $formUserView
            ]
        );
    }

    /**
     * @Route("/admin/profilForm_insert", name="profil_form_insert")
     */
    public function profilFormInsert(Request $request, EntityManagerInterface $entityManager)
    {
        // Utilisation du fichier AuthorType pour créer le formulaire
        // (ne contient pas encore de html)
        $profil = new Profil();
        $form = $this->createForm(ProfilType::class, $profil);
        // création de la view du formulaire
        $formProfilView = $form->createView();
        // Si la méthode est POST
        // si le formulaire est envoyé
        if ($request->isMethod('Post')) {
            // Le formulaire récupère les infos
            // de la requête
            $form->handleRequest($request);
            // on vérifie que le formulaire est valide
            if ($form->isValid()) {
                // On enregistre l'entité créée avec persist
                // et flush
                $entityManager->persist( $profil );
                $entityManager->flush();
            }
        }
        return $this->render('admin/profilFormInsert.html.twig',
            [
                // envoie de la view du form au fichier twig
                'formProfilView' => $formProfilView
            ]
        );
    }
}
