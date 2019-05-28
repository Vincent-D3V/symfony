<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 27/05/19
 * Time: 16:17
 */

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i <= 50; $i++) {
            $category = new Category();
            $category->setName('Nom de catégorie ' . $i);
            $this->addReference('categorie_' . $i, $category);
            $manager->persist($category);
        }
        $manager->flush();
    }

}