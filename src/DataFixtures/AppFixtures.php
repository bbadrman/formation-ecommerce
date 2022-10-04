<?php

namespace App\DataFixtures;

use Faker\Factory;
use App\Entity\User;
use App\Entity\Product;
use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\String\Slugger\SluggerInterface;

class AppFixtures extends Fixture
{
    protected $slugger;

    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create("fr_FR");
        $faker->addProvider(new \Liior\Faker\Prices($faker));
        $faker->addProvider(new \Bezhanov\Faker\Provider\Commerce($faker));
        $faker->addProvider(new \Bluemmb\Faker\PicsumPhotosProvider($faker));

        $admin = new User();

        $admin->setEmail("admin@gmail.com")
              ->setPassword("password")
              ->setFullName("Admin")
              ->setRoles(['ROLE_ADMIN']);
              $manager->persist($admin);

        for ($u = 0; $u <5; $u++){

            $user = new User();
            $user->setEmail($faker->email())
                 ->setFullName($faker->name())
                 ->setPassword("password");
            $manager->persist($user);
              
        }

        for ($c = 0; $c < 3; $c++) {
            $category = new Category();
            $category->setName($faker->department)
                ->setslug(strtolower($this->slugger->slug($category->getName())));

            $manager->persist($category);
            for ($p = 0; $p < mt_rand(15, 20); $p++) {
                $product = new Product();
                $product->setName($faker->productName)
                    ->setPrice($faker->price(4000, 20000))
                    ->setslug(strtolower($this->slugger->slug($product->getName())))
                    ->setCategory($category)
                    ->setShortDescription($faker->paragraph())
                    ->setMainPicture($faker->imageUrl(400, 400, true));
                    
                $manager->persist($product);
            }
        }

        $manager->flush();
    }
}
