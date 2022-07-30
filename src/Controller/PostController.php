<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Comment;
use App\Entity\Category;
use App\Form\CommentType;
use App\Form\SearchPostType;
use App\Repository\PostRepository;
use App\Repository\CommentRepository;
use App\Repository\CategoryRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
        public function __construct(
        private CategoryRepository $categoryRepo,
        private CommentRepository $commentRepo,
        private PostRepository $postRepo, 
        private PaginatorInterface $paginator){}
    
    #[Route('/', name: 'app_post')]
    public function index(Request $request): Response
    {
        // On affiche tous les articles
        $donnees = $this->postRepo->findAll();
        $category = $this->categoryRepo->findAll();

        // pagination
        $posts = $this->paginator->paginate($donnees,$request->query->getInt('page', 1),2);

        $formSearch = $this->createForm(SearchPostType::class);
        $formSearch->handleRequest($request);

        if ($formSearch->isSubmitted() && $formSearch->isValid()) {
            dd('ok');
        }

        return $this->render('post/index.html.twig',[
            'posts' => $posts,
            'categories' => $category,
            'nouveauPost' => $this->postRepo->findBy([],['createdAt'=>'DESC'], 4),
            'formSearch' => $formSearch->createView()
        ]);
        
    }

    #[Route('/article/detail/{slug}', name: 'app_post_detail', methods:['GET','POST'])]
    public function detail(Post $post,Request $request): Response
    {
        // On initilise le commentaire
        $comment = new Comment;

        // On créé le formulaire
        $form = $this->createForm(CommentType::class, $comment);
        
        $form->handleRequest($request);

        // On recupère l'identifiant du commentaire parent

        $parentid = $form->get('parent')->getData();
        
        if ($form->isSubmitted() && $form->isValid()) {
            $comment->setPost($post);
            
           
            // Si le commentaire parent existe ajoute le
            if ($parentid) {
                $parent =  $this->commentRepo->find($parentid);
                $comment->setParent($parent);
            }
            $this->commentRepo->add($comment, true);
            
            $this->addFlash('success','Votre commentaire a été envoyé.');
            return $this->redirectToRoute('app_post_detail',[
                'slug' => $post->getSlug()
            ]);
        }

        // On initialise le formulaire
        if ($form->isSubmitted() ) {
            $comment = new Comment;
            $form = $this->createForm(CommentType::class);
        }

        // Si l'article n'existe, affiche le sur la page detail
        if (!$post){
            return $this->redirectToRoute('app_post');
        }

       
        return $this->renderForm('post/details_post.html.twig',[
            'post' => $post,
            'formComment' => $form,
            'comments' => $this->commentRepo->findAll(),
            'categories' =>  $this->categoryRepo->findAll(),
            'nouveauPost' => $this->postRepo->findBy([],['createdAt'=>'DESC'], 4)

        ]);
       
    }


    #[Route('/category/article/{id}', name: 'app_category_articles', methods:['GET','POST'])]
    public function detail_category(Category $category, Request $request): Response
    {
        $donnees = $category->getPosts()->getValues();
        // Si l'article n'existe pas
        if (!$category){
            $this->addFlash('warning', 'Aucun article dans dans cette catégorie');
            return $this->redirectToRoute('app_post');
        }

        $formSearch = $this->createForm(SearchPostType::class);
        $formSearch->handleRequest($request);

        if ($formSearch->isSubmitted() && $formSearch->isValid()) {
            dd('ok');
        }
         // pagination
         $posts = $this->paginator->paginate($donnees,$request->query->getInt('page', 1),2);
       
        return $this->render('post/index.html.twig',[
            'posts' => $posts,
            'categories' => $this->categoryRepo->findAll(),
            'nouveauPost' => $this->postRepo->findBy([],['createdAt'=>'DESC'], 4),
            'formSearch' => $formSearch->createView()
        ]);
       
    }
}
