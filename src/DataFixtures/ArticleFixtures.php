<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

use App\Entity\Articles;
use App\Entity\Category;
use App\Entity\Comment;
use DateTimeImmutable;
use Faker\Factory;


class ArticleFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return['group2'];
    }
    public function load(ObjectManager $manager): void
    {
        // require_once '/path/to/Faker/src/autoload.php';
        
        $faker = \Faker\Factory::create('fr_FR');
        for($i = 1; $i <= 3; $i++){
            $category = new Category();
            $category->setTitle($faker->sentence())
                     ->setDescription($faker->paragraph());
            $manager->persist($category);

            // Créer entre 4 et 6 articles
            for($j = 1 ; $j <= mt_rand(4,6); $j++){
                $article = new Articles();
                $content = '<p>';
                $content = '<p>'.join([$faker->paragraph(5),'</p><p>']).'</p>';
                
                $dateImmutable = DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-6 months'));
                
                $article->setTitle($faker->sentence())
                        ->setContent($content)
                        ->setImage($faker->imageUrl())
                        ->setCreatedAt($dateImmutable)
                        ->setCategory($category);
                $manager->persist($article);

                for($k = 1; $k <= mt_rand(4,10); $k++){
                    $comment = new Comment();
                    $content = '<p>'.join([$faker->paragraph(2),'</p><p>']).'</p>';
                    $now = new \DateTimeImmutable();
                    $interval = $now->diff($article->getCreatedAt());
                    $days = $interval->days;
                    $minimum = '-'.$days.'days';
                    
                    $dateImmutable = DateTimeImmutable::createFromMutable($faker->dateTimeBetween('-'.$days.' days'));
                
                    $comment->setAuthor($faker->name)
                            ->setContent($content)
                            ->setCreatedAt($dateImmutable)
                            ->setArticle($article);

                    $manager->persist($comment);
                
                }
                
            }
        }
        // $product = new Product();
        // $manager->persist($product);
        /*for($i = 1; $i<= 10 ; $i++){
            $article = new Articles();
            $article->setTitle("Titre de l'article n°$i")
                    ->setContent("<p>Contenu de l'article n°$i</p>")
                    ->setImage("https://placeholder.com/350x150")
                    ->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($article);
        }*/
        $manager->flush();
    }
}
