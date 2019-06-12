<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 20/05/19
 * Time: 10:06
 */

namespace App\Controller;

use App\Entity\Category;
use App\Form\CategoryType;
use Symfony\Component\Form\AbstractType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Article;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="add_category")
     * @IsGranted("ROLE_ADMIN")
     */
    public function addCategory(Request $request)
    {
        $category = new Category();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $task = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();
        }
        return $this->render('blog/create.html.twig', [
            'form' => $form->createView()
        ]);


    }
}