<?php 

namespace App\Doctrine\Listener;

use App\Entity\User;
use App\Entity\Product;  
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

class ProductSlugListener {

    protected $slugger;
    public function __construct(SluggerInterface $slugger) {
      $this->slugger = $slugger;
    }


    /**
     * @param LifecycleEventArgs $event
     */
    public function prePersist(LifecycleEventArgs $event) {

       

        $entity = $event->getObject();
     //dd($entity);

        if (!$entity instanceof Product) {
          
            return;
        }
       

        if (empty($entity->getSlug())) {
            $entity->getSlug(strtolower($this->slugger->slug($entity->getName())));
        
        }
    } 
}