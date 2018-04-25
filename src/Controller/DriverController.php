<?php

namespace App\Controller;

use App\Entity\Car;
use App\Entity\Driver;
use App\Form\DriverType;
use App\Repository\DriverRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * @Route("/driver")
 */
class DriverController extends Controller
{
    /**
     * @var DriverRepository
     */
    private $driverRepository;

    public function __construct(DriverRepository $driverRepository)
    {

        $this->driverRepository = $driverRepository;
    }
    /**
     * @Route("/", name="driver_index", methods="GET")
     */
    public function index(Request $request): Response
    {
        $page = $request->query->get('page', 1);
        $perPage = 5;

        $drivers = $this->driverRepository->paginateAll($page, $perPage);
        $total = count($this->driverRepository->findAll());
        $pages = ceil($total/$perPage);
        return $this->render('driver/index.html.twig', ['drivers' => $drivers, 'pages' => $pages]);
    }

    /**
     * @Route("/new", name="driver_new", methods="GET|POST")
     */
    public function new(Request $request, ValidatorInterface $validator): Response
    {

        $driver = new Driver();



        $form = $this->createForm(DriverType::class, $driver);
        $form->handleRequest($request);
        $errors = $validator->validate($driver);
        if ($form->isSubmitted()) {

            if (count($errors) > 0) {
                return $this->render('driver/new.html.twig', array(
                    'errors' => $errors,
                    'form' => $form->createView(),
                ));
            }
            $data = $form->getData();

            $file = $data->getPhoto();
            if (!empty($file)){
                $filename = md5(uniqid()) .'.' .$file->guessClientExtension();
                $file->move(
                    $this->getParameter('attachment_folder'),
                    $filename
                );

                $driver->setPhoto($filename);
            }else{
                $driver->setPhoto('');
            }


            $em = $this->getDoctrine()->getManager();
            $em->persist($driver);
            $em->flush();

            return $this->redirectToRoute('driver_index');
        }
        $errors = [];
        return $this->render('driver/new.html.twig', [
            'driver' => $driver,
            'form' => $form->createView(),
            'errors' => $errors,
        ]);
    }

    /**
     * @Route("/{id}", name="driver_show", methods="GET")
     */
    public function show(Driver $driver): Response
    {
        return $this->render('driver/show.html.twig', ['driver' => $driver]);
    }

    /**
     * @Route("/{id}/edit", name="driver_edit", methods="GET|POST")
     */
    public function edit($id, Request $request): Response
    {
        $driver = $this->driverRepository->find($id);
        $form = $this->createForm(DriverType::class, $driver);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $file = $data->getPhoto();
            $filename = md5(uniqid()) .'.' .$file->guessClientExtension();
            $file->move(
                $this->getParameter('attachment_folder'),
                $filename
            );

            $driver->setPhoto($filename);
            $em = $this->getDoctrine()->getManager();
            $em->persist($driver);
            $em->flush();

            return $this->redirectToRoute('driver_edit', ['id' => $driver->getId()]);
        }

        return $this->render('driver/edit.html.twig', [
            'driver' => $driver,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="driver_delete", methods="DELETE")
     */
    public function delete(Request $request, Driver $driver): Response
    {
        if ($this->isCsrfTokenValid('delete'.$driver->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($driver);
            $em->flush();
        }

        return $this->redirectToRoute('driver_index');
    }
}
