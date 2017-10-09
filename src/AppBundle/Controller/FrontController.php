<?php
/**
 * Created by PhpStorm.
 * User: Demi
 * Date: 06-Oct-17
 * Time: 11:45 AM
 */
namespace AppBundle\Controller;
use AppBundle\Entity\Adventure;
use AppBundle\Entity\Destination;
use AppBundle\Entity\Gallery;
use AppBundle\Entity\Images;
use AppBundle\Entity\Packages;
use AppBundle\Entity\Pages;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FrontController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        return $this->render(':page:index.html.twig');
    }

    /**
     *  @Route("admin", name="admin")
     */
    public function adminAction()
    {
        return $this->render('::admin.html.twig');
    }

//    /**
//     * @Route("page", name="page")
//     */
//    public function  PageAction()
//    {
//        return $this->render(':page:page.html.twig');
//    }

    /**
     * @Route("adventure/page/{id}", name="adventure")
     */
    public function AdventureAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $em->getRepository('AppBundle:Adventure')->find($id);

        if($view instanceof Adventure){
            $title = $view->getTitle();
            $description = $view->getDescription();
            $image = $view->getImageurl();
        }

        return $this->render(':page:adventure.html.twig', array(
            'title' => $title,
            'description' => $description,
            'image' => $image
        ));

    }

    public function AdventureListAction(){
        $em = $this->getDoctrine()->getManager();
        $detail= array();
        $view = $em->getRepository('AppBundle:Adventure')->findAll();
        foreach($view as $value)
        {
            if ($value instanceof Adventure) {
                $title = $value->getTitle();
                $id = $value->getId();
                $detail[] = array('title' =>$title,'id' => $id);
            }
        }
        return $this->render(':adventure:links.html.twig', array(
            'detail' => $detail
        ));
    }

    /**
     * @Route("destination/page/{id}", name="destination")
     */
    public function DestinationAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $em->getRepository('AppBundle:Destination')->find($id);

        if($view instanceof Destination){
            $title = $view->getTitle();
            $description = $view->getDescription();
            $image = $view->getImageurl();
        }

        return $this->render(':page:destination.html.twig', array(
            'title' => $title,
            'description' => $description,
            'image' => $image
        ));

    }

    public function DestinationListAction(){
        $em = $this->getDoctrine()->getManager();
        $detail= array();
        $view = $em->getRepository('AppBundle:Destination')->findAll();
        foreach($view as $value)
        {
            if ($value instanceof Destination) {
                $title = $value->getTitle();
                $id = $value->getId();
                $detail[] = array('title' =>$title,'id' => $id);
            }
        }
        return $this->render(':destination:links.html.twig', array(
            'detail' => $detail
        ));
    }

    /**
     * @Route("page/{id}", name="pages")
     */
    public function PagesAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $em->getRepository('AppBundle:Pages')->find($id);

        if($view instanceof Pages){
            $title = $view->getTitle();
            $description = $view->getDescription();
        }

        return $this->render(':page:page.html.twig', array(
            'title' => $title,
            'description' => $description
        ));

    }

    public function PagesListAction(){
        $em = $this->getDoctrine()->getManager();
        $detail= array();
        $view = $em->getRepository('AppBundle:Pages')->findAll();
        foreach($view as $value)
        {
            if ($value instanceof Pages) {
                $title = $value->getTitle();
                $id = $value->getId();
                $detail[] = array('title' =>$title,'id' => $id);
            }
        }
        return $this->render(':pages:links.html.twig', array(
            'detail' => $detail
        ));
    }

    /**
     * @Route("/packages/{destination}", name="packages")
     * @Method("GET")
     */
    public function PackagesAction($destination)
    {
        $em = $this->getDoctrine()->getManager();
        $packages = $em->getRepository('AppBundle:Packages')->findpackagebydestinationAction($destination);
        $response = array();
        foreach($packages as $row)
        {
            if($row instanceof Packages) {
                $response[] = array(
                    'location' => $row->getLocation(),
                    'id' => $row->getId(),
                    'title' => $row->getTitle(),
                    'description' => $row->getDescription(),
                    'image' => $row->getImageurl()
                );
            }
        }
        return $this->render(':page:packages.html.twig', array(
            'res' => $response
        ));
    }

    /**
     * @Route("tour-packages/{id}", name="tour_packages")
     */
    public function TourPackageAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $view = $em->getRepository('AppBundle:Packages')->find($id);

        if($view instanceof Packages){
            $title = $view->getTitle();
            $description = $view->getDescription();
        }

        return $this->render(':page:packages-page.html.twig', array(
            'title' => $title,
            'description' => $description
        ));

    }

    /**
     * @Route("photo-gallery", name="photo_gallery")
     */
    public function GalleryShowAction()
    {

        $em = $this->getDoctrine()->getManager();
        $response = array();
        $gallery = $em->getRepository('AppBundle:Gallery')->findAll();

        foreach($gallery as $value)
        {
            if($value instanceof  Gallery)
            {
                $imageDetail= $value->getImage();
                $detail = array();
                foreach ($imageDetail as $val) {
                    if ($val instanceof Images) {
                        $detail[] = $val->getPath();
                    }
                }
                $response[] = array('title' => $value->getTitleName(),'images' => $detail);
            }
        }
//      dump($response);die;
        return $this->render('page/gallery.html.twig', array(
            'response'      => $response
        ));
    }
}