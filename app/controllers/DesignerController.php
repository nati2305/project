<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class DesignerController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for Designer
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Designer', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $designer = Designer::find($parameters);
        if (count($designer) == 0) {
            $this->flash->notice("The search did not find any Designer");

            $this->dispatcher->forward([
                "controller" => "Designer",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $designer,
            'limit'=> 10,
            'page' => $numberPage
        ]);

        $this->view->page = $paginator->getPaginate();
    }

    /**
     * Displays the creation form
     */
    public function newAction()
    {

    }

    /**
     * Edits a Designer
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $designer = Designer::findFirstByid($id);
            if (!$designer) {
                $this->flash->error("Designer was not found");

                $this->dispatcher->forward([
                    'controller' => "Designer",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $designer->getId();

            $this->tag->setDefault("id", $designer->getId());
            $this->tag->setDefault("firstname", $designer->getFirstname());
            $this->tag->setDefault("surname", $designer->getSurname());
            $this->tag->setDefault("dateofbirth", $designer->getDateofbirth());
            $this->tag->setDefault("emailaddress", $designer->getEmailaddress());
            
        }
    }

    /**
     * Creates a new Designer
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "Designer",
                'action' => 'index'
            ]);

            return;
        }

        $designer = new Designer();
        $designer->setfirstname($this->request->getPost("firstname"));
        $designer->setsurname($this->request->getPost("surname"));
        $designer->setdateofbirth($this->request->getPost("dateofbirth"));
        $designer->setemailaddress($this->request->getPost("emailaddress"));
        

        if (!$designer->save()) {
            foreach ($designer->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "Designer",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("Designer was created successfully");

        $this->dispatcher->forward([
            'controller' => "Designer",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a Designer edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "Designer",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $designer = Designer::findFirstByid($id);

        if (!$designer) {
            $this->flash->error("Designer does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "Designer",
                'action' => 'index'
            ]);

            return;
        }

        $designer->setfirstname($this->request->getPost("firstname"));
        $designer->setsurname($this->request->getPost("surname"));
        $designer->setdateofbirth($this->request->getPost("dateofbirth"));
        $designer->setemailaddress($this->request->getPost("emailaddress"));
        

        if (!$designer->save()) {

            foreach ($designer->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "Designer",
                'action' => 'edit',
                'params' => [$designer->getId()]
            ]);

            return;
        }

        $this->flash->success("Designer was updated successfully");

        $this->dispatcher->forward([
            'controller' => "Designer",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a Designer
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $designer = Designer::findFirstByid($id);
        if (!$designer) {
            $this->flash->error("Designer was not found");

            $this->dispatcher->forward([
                'controller' => "Designer",
                'action' => 'index'
            ]);

            return;
        }

        if (!$designer->delete()) {

            foreach ($designer->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "Designer",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("Designer was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "Designer",
            'action' => "index"
        ]);
    }

}
