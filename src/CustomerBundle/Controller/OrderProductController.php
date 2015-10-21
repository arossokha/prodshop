<?php

namespace CustomerBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CustomerBundle\Entity\OrderProduct;
use CustomerBundle\Form\OrderProductType;

/**
 * OrderProduct controller.
 *
 */
class OrderProductController extends Controller
{

    /**
     * Lists all OrderProduct entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CustomerBundle:OrderProduct')->findAll();

        return $this->render('CustomerBundle:OrderProduct:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new OrderProduct entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new OrderProduct();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('orderproduct_show', array('id' => $entity->getId())));
        }

        return $this->render('CustomerBundle:OrderProduct:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a OrderProduct entity.
     *
     * @param OrderProduct $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(OrderProduct $entity)
    {
        $form = $this->createForm(new OrderProductType(), $entity, array(
            'action' => $this->generateUrl('orderproduct_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new OrderProduct entity.
     *
     */
    public function newAction()
    {
        $entity = new OrderProduct();
        $form   = $this->createCreateForm($entity);

        return $this->render('CustomerBundle:OrderProduct:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a OrderProduct entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CustomerBundle:OrderProduct')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OrderProduct entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CustomerBundle:OrderProduct:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing OrderProduct entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CustomerBundle:OrderProduct')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OrderProduct entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CustomerBundle:OrderProduct:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a OrderProduct entity.
    *
    * @param OrderProduct $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(OrderProduct $entity)
    {
        $form = $this->createForm(new OrderProductType(), $entity, array(
            'action' => $this->generateUrl('orderproduct_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing OrderProduct entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CustomerBundle:OrderProduct')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find OrderProduct entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('orderproduct_edit', array('id' => $id)));
        }

        return $this->render('CustomerBundle:OrderProduct:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a OrderProduct entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CustomerBundle:OrderProduct')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find OrderProduct entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('orderproduct'));
    }

    /**
     * Creates a form to delete a OrderProduct entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('orderproduct_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
