<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 14/05/19
 * Time: 09:31
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends AbstractController
{
    /**
     * @Route("show/{slug}", requirements={"slug"="[a-z0-9\-]*"})
     */
    public function show(string $slug = "article sans titre"): Response
    {
        return $this->render('blog/show.html.twig', [
            'title' => ucwords(str_replace('-', ' ', $slug)),
        ]);
    }
}