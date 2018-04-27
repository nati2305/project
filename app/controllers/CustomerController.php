<?php
 
use Phalcon\Mvc\Model\Criteria;
use Phalcon\Paginator\Adapter\Model as Paginator;


class CustomerController extends ControllerBase
{
    /**
     * Index action
     */
    public function indexAction()
    {
        $this->persistent->parameters = null;
    }

    /**
     * Searches for Customer
     */
    public function searchAction()
    {
        $numberPage = 1;
        if ($this->request->isPost()) {
            $query = Criteria::fromInput($this->di, 'Customer', $_POST);
            $this->persistent->parameters = $query->getParams();
        } else {
            $numberPage = $this->request->getQuery("page", "int");
        }

        $parameters = $this->persistent->parameters;
        if (!is_array($parameters)) {
            $parameters = [];
        }
        $parameters["order"] = "id";

        $customer = Customer::find($parameters);
        if (count($customer) == 0) {
            $this->flash->notice("The search did not find any Customer");

            $this->dispatcher->forward([
                "controller" => "Customer",
                "action" => "index"
            ]);

            return;
        }

        $paginator = new Paginator([
            'data' => $customer,
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
     * Edits a Customer
     *
     * @param string $id
     */
    public function editAction($id)
    {
        if (!$this->request->isPost()) {

            $customer = Customer::findFirstByid($id);
            if (!$customer) {
                $this->flash->error("Customer was not found");

                $this->dispatcher->forward([
                    'controller' => "Customer",
                    'action' => 'index'
                ]);

                return;
            }

            $this->view->id = $customer->getId();

            $this->tag->setDefault("id", $customer->getId());
            $this->tag->setDefault("firstname", $customer->getFirstname());
            $this->tag->setDefault("surname", $customer->getSurname());
            $this->tag->setDefault("dateofbirth", $customer->getDateofbirth());
            $this->tag->setDefault("emailaddress", $customer->getEmailaddress());
            $this->tag->setDefault("street", $customer->getStreet());
            $this->tag->setDefault("city", $customer->getCity());
            $this->tag->setDefault("phonenumber", $customer->getPhonenumber());
            
        }
    }

    /**
     * Creates a new Customer
     */
    public function createAction()
    {
        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "Customer",
                'action' => 'index'
            ]);

            return;
        }

        $customer = new Customer();
		$customer->setusername($this->request->getPost("username"));
		$customer->setpassword($this->security->hash($this->request->getPost("password")));
        $customer->setfirstname($this->request->getPost("firstname"));
        $customer->setsurname($this->request->getPost("surname"));
        $customer->setdateofbirth($this->request->getPost("dateofbirth"));
        $customer->setemailaddress($this->request->getPost("emailaddress"));
        $customer->setstreet($this->request->getPost("street"));
        $customer->setcity($this->request->getPost("city"));
        $customer->setphonenumber($this->request->getPost("phonenumber"));
		$customer->setrole("Registered Customer");
		$customer->setstatus("Active");
		$customer->setvalidationkey(md5($this->request->getPost("username") . uniqid()));
		$customer->setcreatedat((new DateTime())->format("Y-m-d H:i:s"));//will set to the current date/time
				

        if (!$customer->save()) {
            foreach ($customer->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "Customer",
                'action' => 'new'
            ]);

            return;
        }

        $this->flash->success("Customer was created successfully");

        $this->dispatcher->forward([
            'controller' => "Customer",
            'action' => 'index'
        ]);
    }

    /**
     * Saves a Customer edited
     *
     */
    public function saveAction()
    {

        if (!$this->request->isPost()) {
            $this->dispatcher->forward([
                'controller' => "Customer",
                'action' => 'index'
            ]);

            return;
        }

        $id = $this->request->getPost("id");
        $customer = Customer::findFirstByid($id);

        if (!$customer) {
            $this->flash->error("Customer does not exist " . $id);

            $this->dispatcher->forward([
                'controller' => "Customer",
                'action' => 'index'
            ]);

            return;
        }
		$customer->setusername($this->request->getPost("username"));
		$customer->setpassword($this->security->hash($this->request->getPost("password")));
        $customer->setfirstname($this->request->getPost("firstname"));
        $customer->setsurname($this->request->getPost("surname"));
        $customer->setdateofbirth($this->request->getPost("dateofbirth"));
        $customer->setemailaddress($this->request->getPost("emailaddress"));
        $customer->setstreet($this->request->getPost("street"));
        $customer->setcity($this->request->getPost("city"));
        $customer->setphonenumber($this->request->getPost("phonenumber"));
        

        if (!$customer->save()) {

            foreach ($customer->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "Customer",
                'action' => 'edit',
                'params' => [$customer->getId()]
            ]);

            return;
        }

        $this->flash->success("Customer was updated successfully");

        $this->dispatcher->forward([
            'controller' => "Customer",
            'action' => 'index'
        ]);
    }

    /**
     * Deletes a Customer
     *
     * @param string $id
     */
    public function deleteAction($id)
    {
        $customer = Customer::findFirstByid($id);
        if (!$customer) {
            $this->flash->error("Customer was not found");

            $this->dispatcher->forward([
                'controller' => "Customer",
                'action' => 'index'
            ]);

            return;
        }

        if (!$customer->delete()) {

            foreach ($customer->getMessages() as $message) {
                $this->flash->error($message);
            }

            $this->dispatcher->forward([
                'controller' => "Customer",
                'action' => 'search'
            ]);

            return;
        }

        $this->flash->success("Customer was deleted successfully");

        $this->dispatcher->forward([
            'controller' => "Customer",
            'action' => "index"
        ]);
    }

}
