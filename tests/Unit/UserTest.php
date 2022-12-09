<?php
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase{

	protected $user;

	public function setUp():void
	{
		$this->user = new User();
	}

	/** @test */
	public function thatWeCanGetDni()
	{
		$this->user->setDni('12345678');
		$this->assertEquals('12345678', $this->user->getDni());
	}

	/** @test */
	public function thatWeCanGetFirstName()
	{
		$this->user->setFirstName('John');
		$this->assertEquals('John', $this->user->getFirstName());
	}

	/** @test */
	public function thatWeCanGetLastName()
	{
		$this->user->setLastName('Smith');
		$this->assertEquals('Smith', $this->user->getLastName());
	}

	/** @test */
	public function fullNameIsReturned()
	{
		$this->user->setFirstName('John');
		$this->user->setLastName('Smith');
		$this->assertEquals('John Smith', $this->user->getFullName());
	}

	/** @test */
	public function firstAndLastNameIsTrimmed()
	{
		$this->user->setFirstName('John  ');
		$this->user->setLastName('  Smith');
		$this->assertEquals('John', $this->user->getFirstName());
		$this->assertEquals('Smith', $this->user->getLastName());
	}

	/** @test */
	public function emailCanBeSet()
	{
		$this->user->setEmail('jhon@smith.com');
		$this->assertEquals('jhon@smith.com', $this->user->getEmail());
	}

	/** @test */
	public function getAgeFromDateOfBirth()
	{
		$this->user->setDateOfBirth('2000-06-01');
		$this->assertEquals(22, $this->user->getAge());
	}

	/** @test */
	public function getBasicDataVariables()
	{
		$this->user->setFirstName('John');
		$this->user->setLastName('Smith');
		$this->user->setDateOfBirth('2000-06-01');
		$this->user->setEmail('jhon@smith.com');

		$basicData = $this->user->getBasicData();

		$this->assertArrayHasKey('full_name', $basicData);
		$this->assertArrayHasKey('age', $basicData);
		$this->assertArrayHasKey('email', $basicData);

		$this->assertEquals('John Smith', $basicData['full_name']);
		$this->assertEquals(22, $basicData['age']);
		$this->assertEquals('jhon@smith.com', $basicData['email']);
	}

	/** @test */
	public function passwordIsHashed()
	{
		$this->user->setPassword('s3cr3t');
		$this->assertTrue(password_verify('s3cr3t', $this->user->getPassword()));
	}

	/** @test */
	public function isCorrectInitializedPreferences()
	{
		$this->assertIsArray($this->user->getPreferences());
	}

}
