<?php

namespace App\Controller;

use App\Entity\Tags;
use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class BlogController extends AbstractController
{
    /**
     * @Route("/", name="blog_index")
     */
    public function index(SessionInterface $session) : Response
    {
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();
        if (!$session->has('total')) {
            $session->set('total', 0); // if total doesn’t exist in session, it is initialized.
        }
        else {
            $total = $session->get('total');
            }
        if (!$articles){
            throw $this->createNotFoundException(
                "No articles found in article's table."
            );
        }
        return $this->render('blog/index.html.twig', [
            'owner' => 'Edouard',
            'articles' => $articles,
        ]);
    }
    /**
    @param string $slug The slugger
     *
     * @Route("/blog/{slug<^[a-z0-9-]+$>}",
     *     defaults={"slug" = null},
     *     name="blog_show")
     *  @return Response A response instance
     */
    public function show(string $slug ="article sans titre"): Response
    {
        if (!$slug)
        {
            throw $this->createNotFoundException('No slug has been sent to find an article in article\'s table .');
        }
        $slug = preg_replace(
            '/-/',
            ' ', ucwords(trim(strip_tags($slug)), "-")
        );
        $article = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findOneBy(['title'=> mb_strtolower($slug)]);
        if (!$article)
        {
            throw $this->createNotFoundException(
                'No article with '.$slug.' title found in article\'s table.'
            );
        }
        return $this->render('blog/blog.html.twig',
            [
                'title' => ucwords(str_replace('-',' ', $slug)),
                'article' => $article,
                'slug' => $slug,
            ]);
    }
    /**
     * @Route("/category/{name}", name="show_category").
     */
    public function showByCategory(Category $category): Response
    {
        return $this->render('blog/category.html.twig',
            [
                'articles' => $category->getArticles(),
                'category' => $category,
            ]);
    }
    /**
     * @Route("/tag/{name}", name="show_tag").
     */
    public function showByTags(Tags $tags): Response
    {
        return $this->render('blog/tags.html.twig',
            [
                'articles' => $tags->getArticle(),
                'tags' => $tags,
            ]);
    }
}