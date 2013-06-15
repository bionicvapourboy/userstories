<?php

namespace Userstories\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Userstories\CoreBundle\Entity\Estimate;
use Userstories\CoreBundle\Form\EstimateType;

/**
 * Estimate controller.
 *
 * @Route("/estimate")
 */
class EstimateController extends Controller
{

    /**
     * Lists all Estimate entities.
     *
     * @Route("/", name="estimate")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UserstoriesCoreBundle:Estimate')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Estimate entity.
     *
     * @Route("/", name="estimate_create")
     * @Method("POST")
     * @Template("UserstoriesCoreBundle:Estimate:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Estimate();
        $form = $this->createForm(new EstimateType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('estimate_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Estimate entity.
     *
     * @Route("/new", name="estimate_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Estimate();
        $form   = $this->createForm(new EstimateType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Estimate entity.
     *
     * @Route("/{id}", name="estimate_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserstoriesCoreBundle:Estimate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estimate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Estimate entity.
     *
     * @Route("/{id}/edit", name="estimate_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserstoriesCoreBundle:Estimate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estimate entity.');
        }

        $editForm = $this->createForm(new EstimateType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Estimate entity.
     *
     * @Route("/{id}", name="estimate_update")
     * @Method("PUT")
     * @Template("UserstoriesCoreBundle:Estimate:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserstoriesCoreBundle:Estimate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Estimate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new EstimateType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('estimate_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Estimate entity.
     *
     * @Route("/{id}", name="estimate_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UserstoriesCoreBundle:Estimate')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Estimate entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('estimate'));
    }

    /**
     * Creates a form to delete a Estimate entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
