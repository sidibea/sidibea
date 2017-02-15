<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 1/11/17
 * Time: 12:35 AM
 */

namespace NB\MainBundle\Controller;


use FOS\UserBundle\Model\UserInterface;
use NB\MainBundle\Entity\Company;
use NB\MainBundle\Form\CompanyEditType;
use NB\MainBundle\Form\CompanyType;
use NB\MainBundle\Form\CompanyUsersType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class CompanyController extends Controller {

    public function listAction(){

        $user = $this->getUser();
        if (!is_object($user) || !$user instanceof UserInterface) {
            throw new AccessDeniedException("Ce utilisateur n'est pas autorisé à acceder cette page.");
        }

        $em = $this->getDoctrine()->getManager();

        $list = $em->getRepository('NBMainBundle:Company')->findAll();



        return$this->render('NBMainBundle:Company:list.html.twig', [
            'list' => $list
        ]);
    }

    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        $company = new Company();
        $form = $this->get('form.factory')->create(new CompanyType(), $company);

        if ($form->handleRequest($request)->isValid()) {

            $logo = $form->get('logo')->getData();

            // Genere un nom unique du fichier avant le stocker
            $logoName = md5(uniqid()).'.'.$logo->guessExtension();

            //Transfer le fichier dans le repertoire ou le logo doit etre stocker
            $logo->move(
                $this->getParameter('logo_directory'),
                $logoName
            );

            $company->setLogo($logoName);

            $company->setCreatedAt(new \datetime);
            $company->setUpdatedAt(new \datetime);
            $em->persist($company);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'La compagnie bien ete enregistrée.');
            return $this->redirect($this->generateUrl('nb_main_company'));

        }

        return$this->render('NBMainBundle:Company:add.html.twig', [
            'form' => $form->createView()
        ]);

    }

    public function editAction($id, Request $request){

        $em = $this->getDoctrine()->getManager();

        $company = $em->getRepository('NBMainBundle:Company')->find($id);
        $form = $this->get('form.factory')->create(new CompanyEditType(), $company);

        if ($form->handleRequest($request)->isValid()) {
            $company->setUpdatedAt(new \datetime);

            $file = $form->get('logo')->getData();
            if(null === $file){
                $company->setLogo($company->getLogo());
            }else{
                $extension = $file->guessClientExtension();
                $logo =  md5(uniqid()).".".$extension;

                if(file_exists($this->getParameter('logo_directory').$company->getLogo()))
                    $logo->move(
                        $this->getParameter('logo_directory'),
                        $logo
                    );

                $company->setLogo($logo);

            }
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'La a bien ete modifiée.');

            return $this->redirect($this->generateUrl('nb_main_company'));
        }

        return$this->render('NBMainBundle:Company:edit.html.twig', [
            'form' => $form->createView(),
            'company' => $company
        ]);

    }


    public function usersAction($companyid){

        $em = $this->getDoctrine()->getManager();

        $company = $em->getRepository('NBMainBundle:Company')->find($companyid);



        return$this->render('NBMainBundle:Company:users.html.twig', [
            'company' => $company,

        ]);

    }

    public function usersAddAction($companyid, Request $request){

        $em = $this->getDoctrine()->getManager();

        $company = $em->getRepository('NBMainBundle:Company')->find($companyid);
        $form = $this->get('form.factory')->create(new CompanyUsersType(), $company);

        if ($form->handleRequest($request)->isValid()) {

            $company->setUpdatedAt(new \datetime);

            foreach ($company->getUsers() as $users) {
                $users->setRoles(array('ROLE_COMPANY'));
                $users->setEnabled(true);
            }

            $em->persist($company);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'La compagnie bien enregistrée.');
            return $this->redirect($this->generateUrl('nb_main_company_users', ['companyid' => $companyid]));
        }

        return$this->render('NBMainBundle:Company:addusers.html.twig', [
            'company' => $company,
            'form' => $form->createView()
        ]);

    }

}