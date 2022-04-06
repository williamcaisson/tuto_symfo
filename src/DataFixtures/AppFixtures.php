<?php

namespace App\DataFixtures;

use App\Entity\Articles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;


class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for($i = 1; $i<= 10 ; $i++){
            $article = new Articles();
            $article->setTitle("Titre de l'article n°$i")
                    ->setContent("<p>Contenu de l'article n°$i</p>")
                    ->setImage("https://bootswatch.com/5/flatly/bootstrap.min.css")
                    ->setCreatedAt(new \DateTimeImmutable());
            $manager->persist($article);
        }

        $manager->flush();
    }
}
