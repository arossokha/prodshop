<?php

namespace CustomerBundle\Controller;

use CustomerBundle\Entity\OrderProduct;
use CustomerBundle\Form\OrderProductType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use CustomerBundle\Entity\Order;
use CustomerBundle\Form\OrderType;

/**
 * Order controller.
 *
 */
class OrderController extends Controller
{

    /**
     * Lists all Order entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('CustomerBundle:Order')->getOrderList();

        return $this->render('CustomerBundle:Order:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Order entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Order();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $orderProducts = clone $entity->getOrderProducts();
            foreach($orderProducts as $orderPos => $orderProduct){
                $entity->removeOrderProduct($orderProduct);
                $orderProduct->setOrder($entity);
//                @todo : validate correctly if product available
                $product = $em->getRepository('ProductBundle:Product')->find($orderProduct->getProductId());
                if(!$product){
                    throw $this->createNotFoundException('Unable to find Product entity.');
                }
                $orderProduct->setProduct($product);
                $entity->addOrderProduct($orderProduct);
            }
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('order_show', array('id' => $entity->getId())));
        }

//        var_dump($form->isValid());
//        $errs = $form->getErrors();
//        foreach($errs as $err){
//            var_dump($err);
//        }
//        die();

        return $this->render('CustomerBundle:Order:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Order entity.
     *
     * @param Order $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Order $entity)
    {
        $form = $this->createForm(new OrderType(), $entity, array(
            'action' => $this->generateUrl('order_create'),
            'method' => 'POST',
        ));
//        $form->add('orderProducts',new OrderProductType());
        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Order entity.
     *
     */
    public function newAction()
    {
        $entity = new Order();
        $form   = $this->createCreateForm($entity);

        return $this->render('CustomerBundle:Order:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Order entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CustomerBundle:Order')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Order entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CustomerBundle:Order:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Order entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CustomerBundle:Order')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Order entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('CustomerBundle:Order:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Order entity.
    *
    * @param Order $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Order $entity)
    {
        $form = $this->createForm(new OrderType(), $entity, array(
            'action' => $this->generateUrl('order_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Order entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('CustomerBundle:Order')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Order entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('order_show', array('id' => $id)));
        }

        return $this->render('CustomerBundle:Order:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Order entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('CustomerBundle:Order')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Order entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('order'));
    }

    /**
     * Creates a form to delete a Order entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('order_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
