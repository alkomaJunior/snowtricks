<?php

namespace App\Controller\FrontController;

use App\Entity\User;
use App\Form\UserProfileType;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Service\MediaUploader;
use DateTime;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{

    private $translator;
    private $mailer;

    public function __construct(TranslatorInterface $translator, MailerInterface $mailer)
    {
        $this->translator = $translator;
        $this->mailer = $mailer;
    }

    /**
     * @Route("/sign_up", name="user_sign_up", methods={"GET","POST"})
     * @throws TransportExceptionInterface
     */
    public function new(
        Request $request,
        UserPasswordEncoderInterface $passwordEncoder
    ): Response {

        // User form building
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        // Get form data
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Hashing password
            $password = $passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);

            // Setting user role
            $user->setRoles(["ROLE_USER"]);

            // Setting user status
            $user->setIsActive(false);

            // Activation token
            $user->setActivationToken(md5(uniqid()));

            // Setting slug
            $user->setSlug(strtolower(preg_replace('/\s+/', '', $user->getPseudo())));

            // Activation mail
            $email = (new TemplatedEmail())
                ->from('no-reply@snowtricks.com')
                ->to($user->getEmail())
                ->subject($this->translator->trans('Thanks for signing up!'))

                // path of the Twig template to render
                ->htmlTemplate('emails/signup.html.twig')

                // pass variables (name => value) to the template
                ->context([
                    'activationToken' => $user->getActivationToken(),
                    'emailAddress' => $user->getEmail(),
                    'pseudo' => $user->getPseudo()
                ])
            ;

            $this->mailer->send($email);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash(
                "success",
                $this->translator
                    ->
                trans('An activation link was sent to your email address. Please check to activate your account.')
            );

            return $this->redirectToRoute('home', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/user/new.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/activation/{token}", name="activation")
     * @param $token
     * @param UserRepository $user
     * @return RedirectResponse
     * @throws TransportExceptionInterface
     * @throws Exception
     */
    public function activation($token, UserRepository $user): Response
    {
        // We search for a user with this token in the database
        $user = $user->findOneBy(['activationToken' => $token]);

        // If not found?
        if (!$user) {
            // We send a 404 error
            throw $this->createNotFoundException($this->translator->trans('Page not found!'));
        }

        // Deletion of the token
        $user->setActivationToken(null);

        if (new DateTime("now") > date_add(
            new DateTime($user->getCreatedAt()->format("Y-m-d H:i:s")),
            date_interval_create_from_date_string('1440 minute')
        )) {
            $user->setActivationToken(md5(uniqid()));
            // Activation mail
            $email = (new TemplatedEmail())
                ->from('jimmysnowtricks@gmail.com')
                ->to($user->getEmail())
                ->subject($this->translator->trans('Thanks for signing up!'))

                // path of the Twig template to render
                ->htmlTemplate('emails/signup.html.twig')

                // pass variables (name => value) to the template
                ->context([
                    'activationToken' => $user->getActivationToken(),
                    'emailAddress' => $user->getEmail(),
                    'pseudo' => $user->getPseudo()
                ])
            ;

            $this->mailer->send($email);
            $user->setCreatedAt(new DateTime("now"));
            $user->setUpdatedAt(new DateTime("now"));
        } else {
            $user->setIsActive(true);
        }

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($user);
        $entityManager->flush();

        if (!$user->getIsActive()) {
            $this->addFlash('success', $this->translator
                ->trans('Your link has expired. A new one was sent to your email address.'));
        } else {
            $this->addFlash('success', $this->translator->trans('Account successfully activated!'));
        }

        return $this->redirectToRoute('home');
    }


    /**
     * @Route("/{slug}/profile", name="user_show", methods={"GET"})
     */
    public function show(User $user): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'User tried to access a page without having ROLE_USER');

        return $this->render('front/user/show.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/{slug}/profile/edit", name="user_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, User $user, MediaUploader $mediaUploader): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'User tried to access a page without having ROLE_USER');

        $form = $this->createForm(UserProfileType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $media = $form["media"]->getData();

            if ($media) {
                $mediaUploader->uploadAvatar($media, $user);
            }

            $user->setSlug(strtolower(preg_replace('/\s+/', '', $user->getPseudo())));

            $this->getDoctrine()->getManager()->flush();

            $this->addFlash("success", $this->translator->trans("Your profile was successfully edited"));
            return $this->redirectToRoute('user_show', ['slug' => $user->getSlug()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('front/user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
