<?php

namespace kiraxe\AdminCrmBundle\Controller;

use kiraxe\AdminCrmBundle\Entity\Materials;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Material controller.
 *
 */
class MaterialsController extends Controller
{
    /**
     * Lists all material entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $materials = $em->getRepository('kiraxeAdminCrmBundle:Materials')->findAll();

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $tableName = [];
        $tableSettingsName = [];
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Workers')->getTableName()] = "Сотрудники";
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Services')->getTableName()] = "Услуги";
        $tableSettingsName[$em->getClassMetadata('kiraxeAdminCrmBundle:User')->getTableName()] = "Пользователи";
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Materials')->getTableName()] = "Материалы";
        $tableSettingsName[$em->getClassMetadata('kiraxeAdminCrmBundle:Measure')->getTableName()] = "Единицы измерения";
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Orders')->getTableName()] = "Заказ-наряд";
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Expenses')->getTableName()] = "Расход";
        $tableCars = [];
        $tableCars[$em->getClassMetadata('kiraxeAdminCrmBundle:Brand')->getTableName()] = "Бренд автомобиля";
        $tableCars[$em->getClassMetadata('kiraxeAdminCrmBundle:Model')->getTableName()] = "Модель автомобиля";
        $tableCars[$em->getClassMetadata('kiraxeAdminCrmBundle:BodyType')->getTableName()] = "Тип кузова";
        for($i = 0; $i < count($materials); $i++) {
            $deleteForm[$materials[$i]->getName()] = $this->createDeleteForm($materials[$i])->createView();
        }

        return $this->render('materials/index.html.twig', array(
            'materials' => $materials,
            'tables' => $tableName,
            'user' => $user,
            'tableSettingsName' => $tableSettingsName,
            'delete_form' => $deleteForm,
            'tableCars' => $tableCars,
        ));
    }

    /**
     * Creates a new material entity.
     *
     */
    public function newAction(Request $request)
    {
        $material = new Materials();
        $form = $this->createForm('kiraxe\AdminCrmBundle\Form\MaterialsType', $material);
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $tableName = [];
        $tableSettingsName = [];
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Workers')->getTableName()] = "Сотрудники";
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Services')->getTableName()] = "Услуги";
        $tableSettingsName[$em->getClassMetadata('kiraxeAdminCrmBundle:User')->getTableName()] = "Пользователи";
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Materials')->getTableName()] = "Материалы";
        $tableSettingsName[$em->getClassMetadata('kiraxeAdminCrmBundle:Measure')->getTableName()] = "Единицы измерения";
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Orders')->getTableName()] = "Заказ-наряд";
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Expenses')->getTableName()] = "Расход";
        $tableCars = [];
        $tableCars[$em->getClassMetadata('kiraxeAdminCrmBundle:Brand')->getTableName()] = "Бренд автомобиля";
        $tableCars[$em->getClassMetadata('kiraxeAdminCrmBundle:Model')->getTableName()] = "Модель автомобиля";
        $tableCars[$em->getClassMetadata('kiraxeAdminCrmBundle:BodyType')->getTableName()] = "Тип кузова";
        if ($form->isSubmitted() && $form->isValid()) {

            $material->setResidue($material->getTotalsize());
            $em->persist($material);
            $em->flush();

            return $this->redirectToRoute('materials_show', array('id' => $material->getId()));
        }

        return $this->render('materials/new.html.twig', array(
            'material' => $material,
            'form' => $form->createView(),
            'tables' => $tableName,
            'user' => $user,
            'tableSettingsName' => $tableSettingsName,
            'tableCars' => $tableCars,
        ));
    }

    /**
     * Finds and displays a material entity.
     *
     */
    public function showAction(Materials $material)
    {
        $deleteForm = $this->createDeleteForm($material);

        $em = $this->getDoctrine()->getManager();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $tableName = [];
        $tableSettingsName = [];
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Workers')->getTableName()] = "Сотрудники";
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Services')->getTableName()] = "Услуги";
        $tableSettingsName[$em->getClassMetadata('kiraxeAdminCrmBundle:User')->getTableName()] = "Пользователи";
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Materials')->getTableName()] = "Материалы";
        $tableSettingsName[$em->getClassMetadata('kiraxeAdminCrmBundle:Measure')->getTableName()] = "Единицы измерения";
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Orders')->getTableName()] = "Заказ-наряд";
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Expenses')->getTableName()] = "Расход";
        $tableCars = [];
        $tableCars[$em->getClassMetadata('kiraxeAdminCrmBundle:Brand')->getTableName()] = "Бренд автомобиля";
        $tableCars[$em->getClassMetadata('kiraxeAdminCrmBundle:Model')->getTableName()] = "Модель автомобиля";
        $tableCars[$em->getClassMetadata('kiraxeAdminCrmBundle:BodyType')->getTableName()] = "Тип кузова";
        return $this->render('materials/show.html.twig', array(
            'material' => $material,
            'delete_form' => $deleteForm->createView(),
            'tables' => $tableName,
            'user' => $user,
            'tableSettingsName' => $tableSettingsName,
            'tableCars' => $tableCars,
        ));
    }

    /**
     * Displays a form to edit an existing material entity.
     *
     */
    public function editAction($id,Request $request, Materials $material)
    {
        $deleteForm = $this->createDeleteForm($material);
        $editForm = $this->createForm('kiraxe\AdminCrmBundle\Form\MaterialsType', $material);

        $editForm->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $residue = 0;
        $tableName = [];
        $tableSettingsName = [];
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Workers')->getTableName()] = "Сотрудники";
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Services')->getTableName()] = "Услуги";
        $tableSettingsName[$em->getClassMetadata('kiraxeAdminCrmBundle:User')->getTableName()] = "Пользователи";
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Materials')->getTableName()] = "Материалы";
        $tableSettingsName[$em->getClassMetadata('kiraxeAdminCrmBundle:Measure')->getTableName()] = "Единицы измерения";
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Orders')->getTableName()] = "Заказ-наряд";
        $tableName[$em->getClassMetadata('kiraxeAdminCrmBundle:Expenses')->getTableName()] = "Расход";
        $tableCars = [];
        $tableCars[$em->getClassMetadata('kiraxeAdminCrmBundle:Brand')->getTableName()] = "Бренд автомобиля";
        $tableCars[$em->getClassMetadata('kiraxeAdminCrmBundle:Model')->getTableName()] = "Модель автомобиля";
        $tableCars[$em->getClassMetadata('kiraxeAdminCrmBundle:BodyType')->getTableName()] = "Тип кузова";


        $workerorders = $em->createQuery(
            'SELECT w FROM kiraxeAdminCrmBundle:WorkerOrders w where w.materials ='. $id
        )->getResult();

        if (count($workerorders) == 0) {
            $material->setResidue($material->getTotalsize());
            $em->persist($material);
            $em->flush();
        } elseif (count($workerorders) > 0) {
            foreach ($workerorders as $workerorder) {
                $residue += $workerorder->getAmountOfMaterial();
            }
            $material->setResidue($material->getTotalsize() - $residue);
            $em->persist($material);
            $em->flush();
        }

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $pricepackage = round($material->getPricepackage(), 1);
            $quantitypack = round($material->getQuantitypack(), 1);
            $priceUnit = round($pricepackage / $quantitypack, 1);
            $material->setPriceUnit($priceUnit);
            $price = $priceUnit * $material->getTotalsize();
            $material->setPrice(round($price, 1));

            $em->flush();

            return $this->redirectToRoute('materials_edit', array('id' => $material->getId()));
        }

        return $this->render('materials/edit.html.twig', array(
            'material' => $material,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'tables' => $tableName,
            'user' => $user,
            'tableSettingsName' => $tableSettingsName,
            'tableCars' => $tableCars,
        ));
    }

    /**
     * Deletes a material entity.
     *
     */
    public function deleteAction(Request $request, Materials $material)
    {
        $form = $this->createDeleteForm($material);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($material);
            $em->flush();
        }

        return $this->redirectToRoute('materials_index');
    }

    /**
     * Creates a form to delete a material entity.
     *
     * @param Materials $material The material entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Materials $material)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('materials_delete', array('id' => $material->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
