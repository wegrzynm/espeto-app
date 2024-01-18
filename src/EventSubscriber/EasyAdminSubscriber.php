<?php
namespace App\EventSubscriber;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    private $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->userPasswordHasher = $userPasswordHasher;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['hashPassWord'],
            BeforeEntityUpdatedEvent::class => ['hashPassWordUpdate'],
        ];
    }

    public function hashPassWord(BeforeEntityPersistedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof User)) {
            return;
        }

        $entity->setPassword($this->userPasswordHasher->hashPassword($entity, $entity->getPassword()));
    }
    
    public function hashPassWordUpdate(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof User)) {
            return;
        }
        if (!empty($entity->getPassword())) {
            $entity->setPassword($this->userPasswordHasher->hashPassword($entity, $entity->getPassword()));
        }
    }
}