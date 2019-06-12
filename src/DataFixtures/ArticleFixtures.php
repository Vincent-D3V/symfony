<?php
/**
 * Created by PhpStorm.
 * User: wilder
 * Date: 28/05/19
 * Time: 14:04
 */

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Article;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Faker;
use App\Entity\Tags;

class ArticleFixtures extends Fixture implements DependentFixtureInterface
{
    public function getDependencies(): array
    {
        return [CategoryFixtures::class];
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i <= 100; $i++) {
            $category = new Category();
            $category->setName("category " . $i);
            $manager->persist($category);

            $tag = new Tags();
            $tag->setName("tag " . $i);
            $manager->persist($tag);

            $article = new Article();
            $article->setTitle("article " . $i);
            $article->setSlug('slug'. $i);
            $article->setContent("article " . $i . " content");
            $article->setCategory($category);
            $article->addTag($tag);
            $manager->persist($article);
        }

        $manager->flush();
    }
}