<?php
class User {

    protected $dni;
    protected $first_name;
    protected $last_name;
    protected $date_of_birth;
    protected $email;
    protected $password;
    protected $preferences = [];

    public function getDni()
    {
        return $this->dni;
    }

    public function setDni($dni)
    {
        $this->dni = $dni;
    }

    public function getFirstName()
    {
        return $this->first_name;
    }

    public function setFirstName($firstName)
    {
        $this->first_name = trim($firstName);
    }

    public function getLastName()
    {
        return $this->last_name;
    }

    public function setLastName($lastName)
    {
        $this->last_name = trim($lastName);
    }

    public function getFullName()
    {
        return $this->getFirstName().' '.$this->getLastName();
    }

    public function getDateOfBirth()
    {
        return $this->date_of_birth;
    }

    public function setDateOfBirth($dateOfBirth)
    {
        $this->date_of_birth = $dateOfBirth;
    }

    public function getAge()
    {
        if($this->getDateOfBirth()){
            $bday = new DateTime($this->getDateOfBirth());
            $today = new Datetime(date('Y-m-d H:i'));
            $diff = $today->diff($bday);
            return $diff->y;
        }
        return null;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        if (! filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException(sprintf(
                '"%s" is not a valid email',
                $email
            ));
        }
        
        $this->email = $email;
    }

    public function getBasicData()
    {
        return [
            'full_name' => $this->getFullName(),
            'age' => $this->getAge(),
            'email' => $this->getEmail(),
        ];
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    public function getPreferences()
    {
        return $this->preferences;
    }

    public function setPreferences($preferences)
    {
        $this->preferences = $preferences;
    }
}