<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class ProjectController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for Project
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Project', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $project = Project::find($parameters);
        if (count($project) == 0) {
            $this->flash->notice("The search did not find any Project");

            $this->dispatcher->forward([
                "controller" => "Project",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $project,
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
     * Edits a Project
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $project = Project::findFirstByid($id);
            if (!$project) {
                $this->flash->error("Project was not found");

                $this->dispatcher->forward([
                    'controller' => "Project",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $project->getId();

            $this->tag->setDefault("id", $project->getId());
            $this->tag->setDefault("description", $project->getDescription());
            $this->tag->setDefault("customerid", $project->getCustomerid());
            $this->tag->setDefault("designerid", $project->getDesignerid());
            $this->tag->setDefault("price", $project->getPrice());
            $this->tag->setDefault("finish", $project->getFinish());
            
        }
    }

    /**
     * Creates a new Project
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "Project",
                'action' => 'index'
            ]);

            return;
        }

        $project = new Project();
        $project->setdescription($this->request->getPost("description"));
		$project->setcustomerid($this->request->getPost("customerid"));
        //$project->setdesignerid($this->request->getPost("designerid"));
        $project->setprice($this->request->getPost("price"));
        $project->setfinish($this->request->getPost("finish"));
		$project->setProjectPic(base64_encode(file_get_contents($this->request->getUploadedFiles()[0]->getTempName())));
        

        if (!$project->save()) {
            foreach ($project->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "Project",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("Project was created successfully");

        $this->dispatcher->forward([
            'controller' => "Project",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a Project edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "Project",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $project = Project::findFirstByid($id);

        if (!$project) {
            $this->flash->error("Project does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "Project",
                'action' => 'index'
            ]);

            return;
        }

        $project->setdescription($this->request->getPost("description"));
        $project->setcustomerid($this->request->getPost("customerid"));
        $project->setdesignerid($this->request->getPost("designerid"));
        $project->setprice($this->request->getPost("price"));
        $project->setfinish($this->request->getPost("finish"));
        

        if (!$project->save()) {

            foreach ($project->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "Project",
                'action' => 'edit',
                'params' => [$project->getId()]
            ]);

            return;
        }

        $this->flash->success("Project was updated successfully");

        $this->dispatcher->forward([
            'controller' => "Project",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a Project
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $project = Project::findFirstByid($id);
        if (!$project) {
            $this->flash->error("Project was not found");

            $this->dispatcher->forward([
                'controller' => "Project",
                'action' => 'index'
            ]);

            return;
        }

        if (!$project->delete()) {

            foreach ($project->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "Project",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("Project was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "Project",
            'action' => "index"
        ]);
    }

}
