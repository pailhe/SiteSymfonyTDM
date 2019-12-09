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
use App\Repository\ArticleRepository;
use App\Repository\PaysRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(ArticleRepository $articleRepository, PaysRepository $paysRepository)
    {
        $this->denyAccessUnlessGranted('ROLE_ADMIN');
        $article = $articleRepository -> findAll();
        $pays = $paysRepository -> findAll();
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
            'article' => $article,
            'pays' => $pays
        ]);
    }

    /**
     * @Route("/admin/articleForm_insert", name="article_form_insert")
     */
    public function articleFormInsert(Request $request, EntityManagerInterface $entityManager, PaysRepository $paysRepository)
    {
        // Utilisation du fichier ArticleType pour créer le formulaire
        // (ne contient pas encore de html)
        $pays = $paysRepository -> findAll();
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

            /** @var UploadedFile $imageFile */
            $imageFile = $form['picture']->getData();

            // Condition nécessaire car le champ 'image' n'est pas requis
            // donc le fichier doit être traité que s'il est téléchargé
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // Nécessaire pour inclure le nom du fichier en tant qu'URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9] remove; Lower()',
                    $originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();


                // Déplace le fichier dans le dossier des images d'articles
                try {
                    $imageFile->move(
                        $this->getParameter('article_images'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // Met à jour l'image pour stocker le nouveau nom de l'image
                $article->setPicture($newFilename);
            }

            // on vérifie que le formulaire est valide
            if ($form->isValid()) {
                // On enregistre l'entité créée avec persist
                // et flush
                $entityManager->persist( $article );
                $entityManager->flush();
                $this->addFlash('success','Article créé avec succès');
            }
        }
        return $this->render('admin/articleFormInsert.html.twig',
            [
                // envoie de la view du form au fichier twig
                'formArticleView' => $formArticleView,
                'pays' => $pays
            ]
        );
    }

    /**
     * @Route("/admin/categorieForm_insert", name="categorie_form_insert")
     */
    public function categorieFormInsert(Request $request, EntityManagerInterface $entityManager, PaysRepository $paysRepository)
    {
        // Utilisation du fichier AuthorType pour créer le formulaire
        // (ne contient pas encore de html)
        $pays = $paysRepository -> findAll();
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
                $this->addFlash('success','Catégorie créé avec succès');
            }
        }
        return $this->render('admin/categorieFormInsert.html.twig',
            [
                // envoie de la view du form au fichier twig
                'formCategorieView' => $formCategorieView,
                'pays' => $pays
            ]
        );
    }

    /**
     * @Route("/admin/paysForm_insert", name="pays_form_insert")
     */
    public function paysFormInsert(Request $request, EntityManagerInterface $entityManager, PaysRepository $paysRepository)
    {
        // Utilisation du fichier AuthorType pour créer le formulaire
        // (ne contient pas encore de html)
        $Pays = $paysRepository -> findAll();
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
                $this->addFlash('success','Pays créé avec succès');

            }
        }
        return $this->render('admin/paysFormInsert.html.twig',
            [
                // envoie de la view du form au fichier twig
                'formPaysView' => $formPaysView,
                'pays' => $Pays
            ]
        );
    }

    /**
     * @Route("/admin/utilisateurForm_insert", name="utilisateur_form_insert")
     */
    public function utilisateurFormInsert(Request $request, EntityManagerInterface $entityManager, PaysRepository $paysRepository)
    {
        // Utilisation du fichier AuthorType pour créer le formulaire
        // (ne contient pas encore de html)
        $pays = $paysRepository -> findAll();
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
                $this->addFlash('success','Utilisateur créé avec succès');

            }
        }
        return $this->render('admin/utilisateurFormInsert.html.twig',
            [
                // envoie de la view du form au fichier twig
                'formUtilisateurView' => $formUserView,
                'pays' => $pays
            ]
        );
    }

    /**
     * @Route("/admin/profilForm_insert", name="profil_form_insert")
     */
    public function profilFormInsert(Request $request, EntityManagerInterface $entityManager, PaysRepository $paysRepository)
    {
        // Utilisation du fichier AuthorType pour créer le formulaire
        // (ne contient pas encore de html)
        $pays = $paysRepository -> findAll();
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
                'formProfilView' => $formProfilView,
                'pays' => $pays
            ]
        );
    }

    /**
     * @Route("/admin/{id}/form_update", name="articleFormUpdate")
     */
    public function articleFormUpdate(Request $request, EntityManagerInterface $entityManager, $id, ArticleRepository
    $articleRepository, PaysRepository $paysRepository){

        $pays = $paysRepository -> findAll();
        $article = $articleRepository->find($id);

        // Utilisation du fichier ArticleType pour créer le formulaire
        // (ne contient pas encore de html)
        $form = $this->createForm(ArticleType::class, $article);
        // création de la view du formulaire
        $formArticleView = $form->createView();

        // Si la méthode est POST
        // si le formulaire est envoyé
        if ($request->isMethod('Post')) {
            // Le formulaire récupère les infos
            // de la requête
            $form->handleRequest($request);
            /** @var UploadedFile $imageFile */
            $imageFile = $form['picture']->getData();

            // Condition nécessaire car le champ 'image' n'est pas requis
            // donc le fichier doit être traité que s'il est téléchargé
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // Nécessaire pour inclure le nom du fichier en tant qu'URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9] remove; 
                Lower()', $originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();


                // Déplace le fichier dans le dossier des images d'articles
                try {
                    $imageFile->move(
                        $this->getParameter('article_images'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... message en cas d'erreur
                }

                // Met à jour l'image pour stocker le nouveau nom de l'image
                $article->setPicture($newFilename);
            }
            // On enregistre l'entité créée avec persist
            // et flush
            $entityManager->persist($article);
            $entityManager->flush();
            // fonction de symfony permettant d'afficher un message flash indiquant que l'article a
            // bien été mis a jour
            $this->addFlash('success','Article modifié avec succès');

        }

        return $this->render('admin/articleFormUpdate.html.twig',
            [
                // envoie de la view du form au fichier twig et des pays présents en BDD pour le menu déroulant de la
                // navbar
                'formArticleView' => $formArticleView,
                'article' => $article,
                'pays' => $pays
            ]
        );
    }

    /**
     * @Route("/admin/{id}/delete", name="articleAdminDelete")
     * Je récupere la valeur de la wilcard {id} dans la variable id
     * Je récupère le authorRepository car j'ai besoin d'utiliser la méthode find
     * Je récupère l'entityManager car c'est lui qui me permet de gérer les entités (ajout, suppression, modif)
     */

    public function remooveArticle($id, ArticleRepository $articleRepository, EntityManagerInterface $entityManager, PaysRepository $paysRepository){
        /// je récupère l'article dans la BDD qui a l'id qui correspond à la wildcard
        // ps : c'est une entité qui est récupérée
        $pays = $paysRepository -> findAll();
        $article = $articleRepository->find($id);

        // j'utilise la méthode remove() de l'entityManager en spécifiant
        // l'article à supprimer
        $entityManager->remove($article);
        $entityManager->flush();
        return $this->render('admin/articleAdminDelete.html.twig',[
           'article' => $article,
           'pays' => $pays
        ]);
    }

    /**
     * @Route("admin/show/{id}", name="adminArticleShow")
     */
    public function articleShow(ArticleRepository $articleRepository, $id, PaysRepository $paysRepository)
    {
        // j'utilise la méthode find du ArticleRepository afin
        // de récupérer un article dans la table Article en fonction
        // de son id
        $pays = $paysRepository -> findAll();
        $article = $articleRepository -> find($id);
        return $this->render('admin/articleShow.html.twig',[
            'article' => $article,
            'pays' => $pays
        ]);
    }

    /**
     * @Route("/admin/payslist", name="payslist")
     */
    public function paysList(PaysRepository $paysRepository){
        $pays = $paysRepository -> findAll();
        return $this->render('admin/paysList.html.twig',[
            'pays' => $pays
        ]);
    }

    /**
     * @Route("/admin/payslist/{id}/delete", name="paysAdminDelete")
     * Je récupere la valeur de la wilcard {id} dans la variable id
     * Je récupère le authorRepository car j'ai besoin d'utiliser la méthode find
     * Je récupère l'entityManager car c'est lui qui me permet de gérer les entités (ajout, suppression, modif)
     */

    public function remoovePays($id, EntityManagerInterface $entityManager,
                             PaysRepository $paysRepository){
        /// je récupère l'auteur dans la BDD qui a l'id qui correspond à la wildcard
        // ps : c'est une entité qui est récupérée
        $pays = $paysRepository -> findAll();
        $Pays = $paysRepository->find($id);

        // j'utilise la méthode remove() de l'entityManager en spécifiant
        // l'auteur à supprimer
        $entityManager->remove($Pays);
        $entityManager->flush();
        return $this->render('admin/paysAdminDelete.html.twig',[
            'Pays' => $Pays,
            'pays' => $pays
        ]);
    }


}
