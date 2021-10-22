<?php

namespace App\EventSubscriber;

use App\Repository\GroupRepository;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\ControllerEvent;
use Twig\Environment;

class TwigEventSubscriber implements EventSubscriberInterface
{
    private Environment $twig;
    private GroupRepository $groupRepository;

    public function __construct(Environment $twig, GroupRepository $groupRepository)
    {
        $this->twig = $twig;
        $this->groupRepository = $groupRepository;
    }


    public function onControllerEvent()
    {
        $this->twig->addGlobal('groups', $this->groupRepository->findAll());
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ControllerEvent::class => 'onControllerEvent',
        ];
    }
}
