<?php

namespace AppBundle\EventListener\Post;

use AppBundle\Entity\Post;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Doctrine\ORM\Events;

class PostEntitySubscriber implements EventSubscriber
{
    private $imagePath;

    /**
     * PostEntitySubscriber constructor.
     * @param string $imagePath
     */
    public function __construct(string $imagePath)
    {
        $this->imagePath = $imagePath;
    }

    public function getSubscribedEvents()
    {
        return array(
            Events::postLoad
        );
    }

    public function postLoad(LifecycleEventArgs $args)
    {
        /**
         * @var Post $entity
         */
        $entity = $args->getEntity();
        $em = $args->getEntityManager();

        if ($entity instanceof Post) {
            $thumbName = $entity->getThumb();
            $fullPath = $this->imagePath . '/' . $thumbName;

            $entity->setThumb($fullPath);
        }
    }

//    public function preFlush(LifecycleEventArgs $args)
//    {
//        /**
//         * @var Post $entity
//         */
//        $entity = $args->getEntity();
//        $em = $args->getEntityManager();
//
//        if ($entity instanceof Post) {
//
//        }
//    }
}
