<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 13/05/19
 * Time: 15:52
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends AbstractController
{
    /**
 * @Route("/", name="app_index")
 */
    public function index()
    {

        return $this->render('blog/index.html.twig');

    }
}