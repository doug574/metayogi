<?php

/**
 * This file is part of Metayogi.
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Metayogi\Components\Core\ModelWizard;

use Metayogi\Event\ApplicationEvent;
use Metayogi\Form\Element\HiddenElement;

/**
 * Adds Qnames to properties and classes
 *
 * @package Metayogi
 * @author  Doug Macdonald <doug.macdonald@usask.ca>
 */
class QnameListener
{
    /**
    * Dispatched after valid form submission  
    *
    * @access public
    * @param Metayogi\Event\ApplicationEvent $event
    * @return void
    */
    public function run(ApplicationEvent $event)
    {
        $request = $event->getRequest();
        $router = $event->getRouter();
        $form = $event->getForm();
        $dbh = $event->getDbh();
        $registry = $event->getRegistry();
        $viewer = $event->getViewer();
        $data = $event->getData();

        $qname = $request->request->get('domain') . ':' . $request->request->get('name');
        $properties = array('name' => 'qname', 'default' => $qname);
        $element = new HiddenElement($dbh, $router, $registry, $viewer, $data);
        $element->build($properties);
        $form->addElement('qname', $element);
    }
}
