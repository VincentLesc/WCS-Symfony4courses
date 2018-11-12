<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class Article extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        for ($i=0; $i<5; $i++) {
            $category = new Category();
            $category->setName('Catégorie'.$i);
            $manager->persist($category);
            for ($j=0; $j<12; $j++) {
                $article = new \App\Entity\Article();
                $article->setTitle('Mon titre de l\'article'.$i.$j);
                $article->setContent('For one beautiful night I knew what it was like to be a grandmother. Subjugated, yet honored. Shut up and get to the point! Good man. Nixon\'s pro-war and pro-family. Or a guy who burns down a bar for the insurance money!

A true inspiration for the children. Good news, everyone! There\'s a report on TV with some very bad news! Fry, you can\'t just sit here in the dark listening to classical music. Does anybody else feel jealous and aroused and worried?

Hey, what kinda party is this? There\'s no booze and only one hooker. No, I\'m Santa Claus! As an interesting side note, as a head without a body, I envy the dead. I\'ve got to find a way to escape the horrible ravages of youth. Suddenly, I\'m going to the bathroom like clockwork, every three hours. And those jerks at Social Security stopped sending me checks. Now \'I\'\' have to pay \'\'them\'!

Um, is this the boring, peaceful kind of taking to the streets? Shut up and get to the point! Bender, I didn\'t know you liked cooking. That\'s so cute. It doesn\'t look so shiny to me.

Actually, that\'s still true. Morbo can\'t understand his teleprompter because he forgot how you say that letter that\'s shaped like a man wearing a hat. That could be \'my\' beautiful soul sitting naked on a couch. If I could just learn to play this stupid thing.');
                $article->setCategory($category);
                $manager->persist($article);
            }
        }
        $manager->flush();
    }
}
