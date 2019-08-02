<?php

namespace kiraxe\AdminCrmBundle\Controller;

use kiraxe\AdminCrmBundle\Entity\Expenses;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Expense controller.
 *
 */
class ExpensesController extends Controller
{
    /**
     * Lists all expense entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $expenses = $em->getRepository('kiraxeAdminCrmBundle:Expenses')->findAll();

        $deleteForm = [];

        for($i = 0; $i < count($expenses); $i++) {
            $deleteForm[$expenses[$i]->getName()] = $this->createDeleteForm($expenses[$i])->createView();
        }

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


        return $this->render('expenses/index.html.twig', array(
            'expenses' => $expenses,
            'delete_form' => $deleteForm,
            'tables' => $tableName,
            'user' => $user,
            'tableSettingsName' => $tableSettingsName,
            'tableCars' => $tableCars,
        ));
    }

    /**
     * Creates a new expense entity.
     *
     */
    public function newAction(Request $request)
    {
        $expense = new Expenses();
        $form = $this->createForm('kiraxe\AdminCrmBundle\Form\ExpensesType', $expense);
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
            $em->persist($expense);
            $em->flush();

            return $this->redirectToRoute('expenses_show', array('id' => $expense->getId()));
        }

        return $this->render('expenses/new.html.twig', array(
            'expense' => $expense,
            'form' => $form->createView(),
            'tables' => $tableName,
            'user' => $user,
            'tableSettingsName' => $tableSettingsName,
            'tableCars' => $tableCars,
        ));
    }

    /**
     * Finds and displays a expense entity.
     *
     */
    public function showAction(Expenses $expense)
    {
        $deleteForm = $this->createDeleteForm($expense);

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

        return $this->render('expenses/show.html.twig', array(
            'expense' => $expense,
            'delete_form' => $deleteForm->createView(),
            'tables' => $tableName,
            'user' => $user,
            'tableSettingsName' => $tableSettingsName,
            'tableCars' => $tableCars,
        ));
    }

    /**
     * Displays a form to edit an existing expense entity.
     *
     */
    public function editAction(Request $request, Expenses $expense)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $deleteForm = $this->createDeleteForm($expense);
        $editForm = $this->createForm('kiraxe\AdminCrmBundle\Form\ExpensesType', $expense);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('expenses_edit', array('id' => $expense->getId()));
        }

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        $user = $this->getUser();
        $tableName = [];
        $tableSettingsName = [];
        $tableName[$entityManager->getClassMetadata('kiraxeAdminCrmBundle:Workers')->getTableName()] = "Сотрудники";
        $tableName[$entityManager->getClassMetadata('kiraxeAdminCrmBundle:Services')->getTableName()] = "Услуги";
        $tableName[$entityManager->getClassMetadata('kiraxeAdminCrmBundle:User')->getTableName()] = "Пользователи";
        $tableName[$entityManager->getClassMetadata('kiraxeAdminCrmBundle:Materials')->getTableName()] = "Материалы";
        $tableSettingsName[$entityManager->getClassMetadata('kiraxeAdminCrmBundle:Measure')->getTableName()] = "Единицы измерения";
        $tableName[$entityManager->getClassMetadata('kiraxeAdminCrmBundle:Orders')->getTableName()] = "Заказ-наряд";
        $tableName[$entityManager->getClassMetadata('kiraxeAdminCrmBundle:Expenses')->getTableName()] = "Расход";
        $tableCars = [];
        $tableCars[$entityManager->getClassMetadata('kiraxeAdminCrmBundle:Brand')->getTableName()] = "Бренд автомобиля";
        $tableCars[$entityManager->getClassMetadata('kiraxeAdminCrmBundle:Model')->getTableName()] = "Модель автомобиля";
        $tableCars[$entityManager->getClassMetadata('kiraxeAdminCrmBundle:BodyType')->getTableName()] = "Тип кузова";

        return $this->render('expenses/edit.html.twig', array(
            'expense' => $expense,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'tables' => $tableName,
            'user' => $user,
            'tableSettingsName' => $tableSettingsName,
            'tableCars' => $tableCars,
        ));
    }

    /**
     * Deletes a expense entity.
     *
     */
    public function deleteAction(Request $request, Expenses $expense)
    {
        $form = $this->createDeleteForm($expense);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($expense);
            $em->flush();
        }

        return $this->redirectToRoute('expenses_index');
    }

    /**
     * Creates a form to delete a expense entity.
     *
     * @param Expenses $expense The expense entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Expenses $expense)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('expenses_delete', array('id' => $expense->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
