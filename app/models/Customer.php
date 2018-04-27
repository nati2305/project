<?php
use Phalcon\Validation;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
class Customer extends \Phalcon\Mvc\Model
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
     * @Column(column="username", type="string", length=30, nullable=true)
     */
    protected $username;

    /**
     *
     * @var string
     * @Column(column="password", type="string", length=255, nullable=true)
     */
    protected $password;

    /**
     *
     * @var string
     * @Column(column="firstname", type="string", length=30, nullable=true)
     */
    protected $firstname;

    /**
     *
     * @var string
     * @Column(column="surname", type="string", length=30, nullable=true)
     */
    protected $surname;

    /**
     *
     * @var string
     * @Column(column="dateofbirth", type="string", nullable=true)
     */
    protected $dateofbirth;

    /**
     *
     * @var string
     * @Column(column="emailaddress", type="string", length=30, nullable=true)
     */
    protected $emailaddress;

    /**
     *
     * @var string
     * @Column(column="street", type="string", length=40, nullable=true)
     */
    protected $street;

    /**
     *
     * @var string
     * @Column(column="city", type="string", length=20, nullable=true)
     */
    protected $city;

    /**
     *
     * @var string
     * @Column(column="phonenumber", type="string", length=25, nullable=true)
     */
    protected $phonenumber;
	
	protected $role;

    /**
     *
     * @var string
     * @Column(column="validationkey", type="string", length=255, nullable=true)
     */
    protected $validationkey;

    /**
     *
     * @var string
     * @Column(column="status", type="string", length=255, nullable=true)
     */
    protected $status;

    /**
     *
     * @var string
     * @Column(column="createdat", type="string", nullable=true)
     */
    protected $createdat;

    /**
     *
     * @var string
     * @Column(column="updatedat", type="string", nullable=true)
     */
    protected $updatedat;

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
     * Method to set the value of field username
     *
     * @param string $username
     * @return $this
     */

    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Method to set the value of field password
     *
     * @param string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
    /**
     * Method to set the value of field firstname
     *
     * @param string $firstname
     * @return $this
     */
	
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Method to set the value of field surname
     *
     * @param string $surname
     * @return $this
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Method to set the value of field dateofbirth
     *
     * @param string $dateofbirth
     * @return $this
     */
    public function setDateofbirth($dateofbirth)
    {
        $this->dateofbirth = $dateofbirth;

        return $this;
    }

    /**
     * Method to set the value of field emailaddress
     *
     * @param string $emailaddress
     * @return $this
     */
    public function setEmailaddress($emailaddress)
    {
        $this->emailaddress = $emailaddress;

        return $this;
    }

    /**
     * Method to set the value of field street
     *
     * @param string $street
     * @return $this
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Method to set the value of field city
     *
     * @param string $city
     * @return $this
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Method to set the value of field phonenumber
     *
     * @param string $phonenumber
     * @return $this
     */
    public function setPhonenumber($phonenumber)
    {
        $this->phonenumber = $phonenumber;

        return $this;
    }
	public function setRole($role)
    {
        $this->role = $role;

        return $this;
    }

    /**
     * Method to set the value of field validationkey
     *
     * @param string $validationkey
     * @return $this
     */
    public function setValidationkey($validationkey)
    {
        $this->validationkey = $validationkey;

        return $this;
    }

    /**
     * Method to set the value of field status
     *
     * @param string $status
     * @return $this
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Method to set the value of field createdat
     *
     * @param string $createdat
     * @return $this
     */
    public function setCreatedat($createdat)
    {
        $this->createdat = $createdat;

        return $this;
    }

    /**
     * Method to set the value of field updatedat
     *
     * @param string $updatedat
     * @return $this
     */
    public function setUpdatedat($updatedat)
    {
        $this->updatedat = $updatedat;

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
     * Returns the value of field username
     *
     * @return string
     */
	 
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Returns the value of field password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * Returns the value of field firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Returns the value of field surname
     *
     * @return string
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Returns the value of field dateofbirth
     *
     * @return string
     */
    public function getDateofbirth()
    {
        return $this->dateofbirth;
    }

    /**
     * Returns the value of field emailaddress
     *
     * @return string
     */
    public function getEmailaddress()
    {
        return $this->emailaddress;
    }

    /**
     * Returns the value of field street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Returns the value of field city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Returns the value of field phonenumber
     *
     * @return string
     */
    public function getPhonenumber()
    {
        return $this->phonenumber;
    }

	/**
     * Returns the value of field role
     *
     * @return string
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Returns the value of field validationkey
     *
     * @return string
     */
    public function getValidationkey()
    {
        return $this->validationkey;
    }

    /**
     * Returns the value of field status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Returns the value of field createdat
     *
     * @return string
     */
    public function getCreatedat()
    {
        return $this->createdat;
    }

    /**
     * Returns the value of field updatedat
     *
     * @return string
     */
    public function getUpdatedat()
    {
        return $this->updatedat;
    }

    /**
     * Initialize method for model.
     */
    public function initialize()
    {
        $this->setSchema("shop");
        $this->setSource("Customer");
    }

    /**
     * Returns table name mapped in the model.
     *
     * @return string
     */
    public function getSource()
    {
        return 'Customer';
    }

    /**
     * Allows to query a set of records that match the specified conditions
     *
     * @param mixed $parameters
     * @return Customer[]|Customer|\Phalcon\Mvc\Model\ResultSetInterface
     */
    public static function find($parameters = null)
    {
        return parent::find($parameters);
    }

    /**
     * Allows to query the first record that match the specified conditions
     *
     * @param mixed $parameters
     * @return Customer|\Phalcon\Mvc\Model\ResultInterface
     */
    public static function findFirst($parameters = null)
    {
        return parent::findFirst($parameters);
    }
	public function validation()
	{
	   $validator= new Validation();
	   $uValidator = new UniquenessValidator(["message" => "this Username has already been chosen"]);
	   $validator->add('username', $uValidator);
	   return $this->validate($validator);
	}

}
