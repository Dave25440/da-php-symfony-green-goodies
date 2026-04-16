<?php

namespace App\DataFixtures;

use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fullDescription = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras consequat, quam vel euismod tempus, sem tortor molestie nunc, vel vulputate neque justo at purus. Morbi consequat tincidunt luctus.\n\nProin auctor ac tellus a ornare. Vestibulum tristique lacinia malesuada. Aenean sollicitudin maximus tincidunt. Donec sed dolor mattis, fermentum purus ut, tincidunt ipsum. Duis consectetur fermentum ante, nec consectetur tellus consequat aliquet. Nulla at orci a lectus sollicitudin vestibulum.\n\nSuspendisse iaculis imperdiet ipsum, ut facilisis nunc pulvinar quis. Vivamus quis sollicitudin nisi, nec ultrices ipsum. Cras dignissim tincidunt magna.";
        $secondDescription = "Déodorant Nécessaire, une formule révolutionnaire composée exclusivement d'ingrédients naturels pour une protection efficace et bienfaisante.\n\nChaque flacon de 50 ml renferme le secret d'une fraîcheur longue durée, sans compromettre votre bien-être ni l'environnement. Conçu avec soin, ce déodorant allie le pouvoir antibactérien des extraits de plantes aux vertus apaisantes des huiles essentielles, assurant une sensation de confort toute la journée.\n\nGrâce à sa formule non irritante et respectueuse de votre peau, Nécessaire offre une alternative saine aux déodorants conventionnels, tout en préservant l'équilibre naturel de votre corps.";

        $products = [
            [
                'name' => 'Savon Bio',
                'shortDescription' => 'Thé, Orange & Girofle',
                'fullDescription' => $fullDescription,
                'price' => 18.90,
                'picture' => 'savon-bio-1.webp'
            ],
            [
                'name' => 'Nécessaire, déodorant Bio',
                'shortDescription' => '50 ml déodorant à l’eucalyptus',
                'fullDescription' => $secondDescription,
                'price' => 8.50,
                'picture' => 'necessaire-deodorant-bio-2.webp'
            ],
            [
                'name' => 'Kit couvert en bois',
                'shortDescription' => 'Revêtement Bio en olivier & sac de transport',
                'fullDescription' => $fullDescription,
                'price' => 12.30,
                'picture' => 'kit-couvert-en-bois-3.webp'
            ],
            [
                'name' => 'Brosse à dent',
                'shortDescription' => 'Bois de hêtre rouge issu de forêts gérées durablement',
                'fullDescription' => $fullDescription,
                'price' => 5.40,
                'picture' => 'brosse-a-dent-4.webp'
            ],
            [
                'name' => 'Bougie Lavande & Patchouli',
                'shortDescription' => 'Cire naturelle',
                'fullDescription' => $fullDescription,
                'price' => 32,
                'picture' => 'bougie-lavande-patchouli-5.webp'
            ],
            [
                'name' => 'Disques Démaquillants x3',
                'shortDescription' => 'Solution efficace pour vous démaquiller en douceur',
                'fullDescription' => $fullDescription,
                'price' => 19.90,
                'picture' => 'disques-demaquillants-x3-6.webp'
            ],
            [
                'name' => 'Gourde en bois',
                'shortDescription' => '50 cl, bois d’olivier',
                'fullDescription' => $fullDescription,
                'price' => 16.90,
                'picture' => 'gourde-en-bois-7.webp'
            ],
            [
                'name' => 'Shot Tropical',
                'shortDescription' => 'Fruits frais, pressés à froid',
                'fullDescription' => $fullDescription,
                'price' => 4.50,
                'picture' => 'shot-tropical-8.webp'
            ],
            [
                'name' => 'Kit d\'hygiène recyclable',
                'shortDescription' => 'Pour une salle de bain eco-friendly',
                'fullDescription' => $fullDescription,
                'price' => 24.99,
                'picture' => 'kit-d-hygiene-recyclable-9.webp'
            ]
        ];

        foreach ($products as $data) {
            $product = new Product();
            $product->setName($data['name']);
            $product->setShortDescription($data['shortDescription']);
            $product->setFullDescription($data['fullDescription']);
            $product->setPrice($data['price']);
            $product->setPicture($data['picture']);

            $manager->persist($product);
        }

        $manager->flush();
    }
}
