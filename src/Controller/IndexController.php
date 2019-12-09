<?php


namespace App\Controller;


use App\Repository\ArticleRepository;
use App\Repository\PaysRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    public function base(PaysRepository $paysRepository){
        $pays = $paysRepository -> findAll();
        return $this->render('base.html.twig',[
            'pays' => $pays
        ]);
    }


    /**
     * @Route("/", name="index")
     */
    public function index(ArticleRepository $articleRepository, PaysRepository $paysRepository){
        $article = $articleRepository -> findAll();
        $pays = $paysRepository -> findAll();
        return $this->render('index.html.twig',[
            'article' => $article,
            'pays' => $pays
        ]);
    }

    /**
     * @Route("article/show/{id}", name="articleShow")
     */
    public function articleShow(ArticleRepository $articleRepository, $id, PaysRepository $paysRepository)
    {
        // j'utilise la méthode find du BookRepository afin
        // de récupérer un livre dans la table Book en fonction
        // de son id
        $article = $articleRepository -> find($id);
        $pays = $paysRepository -> findAll();
        return $this->render('articleShow.html.twig',[
            'article' => $article,
            'pays' => $pays
        ]);
    }


    /**
     * @Route("articleSearch", name="article_search")
     */

    public function getArticle(ArticleRepository $articleRepository, Request $request, PaysRepository $paysRepository){
    // je récupère la chaine de caractère envoyée dans l'url par le formulaire
    $word = $request->query->get('word');

    // j'appelle la méthode getArticle() que j'ai créée dans le repository Article
    // et je lui passe la chaine de caractères envoyée par le formulaire (récupéré dans l'URL via le get)
    $article = $articleRepository -> getArticle($word);
    $pays = $paysRepository -> findAll();
    return $this->render('articleSearch.html.twig',[
        'article' => $article,
        'pays' => $pays
    ]);
    }

    /**
     * @Route("article/show/{id}", name="articleShow")
     */
    public function articleSearchShow(ArticleRepository $articleRepository, $id, PaysRepository $paysRepository)
    {
        // j'utilise la méthode find du BookRepository afin
        // de récupérer un livre dans la table Book en fonction
        // de son id
        $article = $articleRepository -> find($id);
        $pays = $paysRepository -> findAll();
        return $this->render('articleSearchShow.html.twig',[
            'article' => $article,
            'pays' => $pays
        ]);
    }

    /**
     * @Route("presentation", name="presentation")
     */
    public function presentation(PaysRepository $paysRepository){
        $pays = $paysRepository -> findAll();
        return $this->render('presentation.html.twig',[
            'pays' => $pays
        ]);
    }


    /**
     * @Route("destinations", name="destinations")
     */
    public function destinationsLink(ArticleRepository $articleRepository, Request $request, PaysRepository $paysRepository){
        $pays = $request->query->get('pays');
        $article = $articleRepository->getarticleByPays($pays);
        $Pays = $paysRepository -> findAll();
        return $this->render('destinations.html.twig',[
            'article' => $article,
            'pays' => $Pays
            ]);
    }

    /**
     * @Route("contact", name="contact")
     */
    public function contact(PaysRepository $paysRepository){
        $pays = $paysRepository -> findAll();
        return $this->render('contact.html.twig',[
            'pays' => $pays
        ]);
    }
}

