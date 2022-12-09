<?php
use PHPUnit\Framework\TestCase;

final class DataTest extends TestCase{

	protected $user;

	public function setUp():void
	{
		//$this->user = new User();
	}

	/** @dataProvider userProvider */
	public function testAddUser($first_name, $last_name)
    {
		$this->user = new User();
		$this->user->setFirstName($first_name);
		$this->user->setLastName($last_name);

		$uRepository = new UserRepository;
		$userAdd = $uRepository->add($this->user);
        $this->assertSame($userAdd->getFullName(), $first_name .' '. $last_name);
    }

    public function userProvider(): array
    {
        return [
            'One user'  => ['John', 'Smith'],
            'Two user' => ['Marc', 'Carlton'],
            'Three user' => ['Marie', 'Thomson'],
        ];
    }

	/** @dataProvider userProvider */
	public function testEditUser($first_name, $last_name)
    {
		$this->user = new User();
		$this->user->setFirstName($first_name.' abc');
		$this->user->setLastName($last_name.' def');

		$uRepository = new UserRepository;
		$userEdit = $uRepository->edit($this->user);
        $this->assertSame($userEdit->getFullName(), $first_name .' abc '. $last_name.' def');
    }

	/** @dataProvider userProvider */
	public function testDeleteUser($first_name, $last_name)
    {
		$this->user = new User();
		$this->user->setFirstName($first_name);
		$this->user->setLastName($last_name);

		$uRepository = new UserRepository;
		$userAdd = $uRepository->add($this->user);

		$id_for_delete = $userAdd->getDni();
		$result = $uRepository->delete($id_for_delete);
		$this->assertTrue($result);

		$this->assertNull($uRepository->find($id_for_delete));
    }
}
