<?php

class Project extends \Phalcon\Mvc\Model
{

    /**
     *
     * @var integer
     * @Primary
     * @Identity
     * @Column(column="id", type="integer", length=11, nullable=false)
     */
    protected $id;

    /**
     *
     * @var string
     * @Column(column="description", type="string", length=50, nullable=true)
     */
    protected $description;

    /**
     *
     * @var integer
     * @Column(column="customerid", type="integer", length=11, nullable=true)
     */
    protected $customerid;

    /**
     *
     * @var integer
     * @Column(column="designerid", type="integer", length=11, nullable=true)
     */
    protected $designerid;

    /**
     *
     * @var double
     * @Column(column="price", type="double", length=65, nullable=true)
     */
    protected $price;

    /**
     *
     * @var string
     * @Column(column="finish", type="string", nullable=true)
     */
    protected $finish;

    /**
     *
     * @var string
     * @Column(column="projectpic", type="string", nullable=true)
     */
    protected $projectpic;

    /**
     * Method to set the value of field id
     *
     * @param integer $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Method to set the value of field description
     *
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Method to set the value of field customerid
     *
     * @param integer $customerid
     * @return $this
     */
    public function setCustomerid($customerid)
    {
        $this->customerid = $customerid;

        return $this;
    }

    /**
     * Method to set the value of field designerid
     *
     * @param integer $designerid
     * @return $this
     */
    public function setDesignerid($designerid)
    {
        $this->designerid = $designerid;

        return $this;
    }

    /**
     * Method to set the value of field price
     *
     * @param double $price
     * @return $this
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Method to set the value of field finish
     *
     * @param string $finish
     * @return $this
     */
    public function setFinish($finish)
    {
        $this->finish = $finish;

        return $this;
    }

    /**
     * Method to set the value of field projectpic
     *
     * @param string $projectpic
     * @return $this
     */
    public function setProjectpic($projectpic)
    {
        $this->projectpic = $projectpic;

        return $this;
    }

    /**
     * Returns the value of field id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns the value of field description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Returns the value of field customerid
     *
     * @return integer
     */
    public function getCustomerid()
    {
        return $this->customerid;
    }

    /**
     * Returns the value of field designerid
     *
     * @return integer
     */
    public function getDesignerid()
    {
        return $this->designerid;
    }

    /**
     * Returns the value of field price
     *
     * @return double
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Returns the value of field finish
     *
     * @return string
     */
    public function getFinish()
    {
        return $this->finish;
    }

    /**
     * Returns the value of field projectpic
     *
     * @return string
     */
    public function getProjectpic()
    {
        return $this->projectpic;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("shop");
        $this->setSource("Project");
        $this->belongsTo('customerid', '\Customer', 'id', ['alias' => 'Customer']);
        $this->belongsTo('designerid', '\Designer', 'id', ['alias' => 'Designer']);
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Project[]|Project|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Project|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'project';
    }

}
