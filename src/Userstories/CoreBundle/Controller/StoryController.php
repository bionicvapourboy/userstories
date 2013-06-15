<?php

namespace Userstories\CoreBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Userstories\CoreBundle\Entity\Story;
use Userstories\CoreBundle\Form\StoryType;

/**
 * Story controller.
 *
 * @Route("/story")
 */
class StoryController extends Controller
{

    /**
     * Lists all Story entities.
     *
     * @Route("/", name="story")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('UserstoriesCoreBundle:Story')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Story entity.
     *
     * @Route("/", name="story_create")
     * @Method("POST")
     * @Template("UserstoriesCoreBundle:Story:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity  = new Story();
        $form = $this->createForm(new StoryType(), $entity);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('story_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Displays a form to create a new Story entity.
     *
     * @Route("/new", name="story_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Story();
        $form   = $this->createForm(new StoryType(), $entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Story entity.
     *
     * @Route("/{id}", name="story_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserstoriesCoreBundle:Story')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Story entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Story entity.
     *
     * @Route("/{id}/edit", name="story_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserstoriesCoreBundle:Story')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Story entity.');
        }

        $editForm = $this->createForm(new StoryType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Edits an existing Story entity.
     *
     * @Route("/{id}", name="story_update")
     * @Method("PUT")
     * @Template("UserstoriesCoreBundle:Story:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('UserstoriesCoreBundle:Story')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Story entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createForm(new StoryType(), $entity);
        $editForm->bind($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('story_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Story entity.
     *
     * @Route("/{id}", name="story_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->bind($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('UserstoriesCoreBundle:Story')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Story entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('story'));
    }

    /**
     * Creates a form to delete a Story entity by id.
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
