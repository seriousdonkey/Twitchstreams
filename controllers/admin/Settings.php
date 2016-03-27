<?php

namespace Modules\Twitchstreams\Controllers\Admin;

class Settings extends \Ilch\Controller\Admin
{
    public function init()
    {
        $items = array
        (
            array
            (
                'name' => 'menuStreamer',
                'active' => false,
                'icon' => 'fa fa-th-list',
                'url' => $this->getLayout()->getUrl(array('controller' => 'index', 'action' => 'index'))
            ),
            array
            (
                'name' => 'add',
                'active' => false,
                'icon' => 'fa fa-plus-circle',
                'url' => $this->getLayout()->getUrl(array('controller' => 'index', 'action' => 'treat'))
            ),
            array
            (
                'name' => 'settings',
                'active' => false,
                'icon' => 'fa fa-cogs',
                'url' => $this->getLayout()->getUrl(array('controller' => 'settings', 'action' => 'index'))
            )
        );  

        if ($this->getRequest()->getControllerName() == 'index' AND $this->getRequest()->getActionName() == 'treat') {
            $items[1]['active'] = true;
        } elseif ($this->getRequest()->getControllerName() == 'settings') {
            $items[2]['active'] = true;
        } else {
            $items[0]['active'] = true;
        }

        $this->getLayout()->addMenu
        (
            'twitchstreams',
            $items
        );
    }

    public function indexAction()
    {
        $this->getLayout()->getAdminHmenu()
                ->add($this->getTranslator()->trans('twitchstreams'), array('controller' => 'index', 'action' => 'index'))
                ->add($this->getTranslator()->trans('settings'), array('action' => 'index'));

        if ($this->getRequest()->isPost()) {
            $this->getConfig()->set('twitchstreams_requestEveryPageCall', $this->getRequest()->getPost('requestEveryPage'));
        }

        $this->getView()->set('requestEveryPage', $this->getConfig()->get('twitchstreams_requestEveryPageCall'));
    }
}
