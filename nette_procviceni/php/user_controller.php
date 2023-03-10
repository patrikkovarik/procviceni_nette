<?php


class UserController extends BasePresenter
{
    /** @var UserManager */
    private $userManager;

    public function __construct(UserManager $userManager)
    {
        $this->userManager = $userManager;
    }

    public function createComponentUserForm()
    {
        $form = new Form();

        $form->addText('email', 'E-mail:')
            ->setRequired(true)
            ->addRule(Form::EMAIL, 'Please enter a valid e-mail address.');

        $form->addPassword('password', 'Password:')
            ->setRequired(true)
            ->addRule(Form::MIN_LENGTH, 'The password must be at least %d characters long.', 6);

        $form->addSelect('role', 'Role:', [
            'admin' => 'Admin',
            'editor' => 'Editor',
            'contributor' => 'Contributor',
        ])->setRequired(true);

        $form->addSubmit('submit', 'Create User');

        $form->onSuccess[] = [$this, 'processUserForm'];

        return $form;
    }

    public function processUserForm(Form $form, ArrayHash $values)
    {
        $user = new User();
        $user->email = $values->email;
        $user->password = password_hash($values->password, PASSWORD_DEFAULT);
        $user->role = $values->role;
        $user->active = true;

        $this->userManager->save($user);

        $this->flashMessage('User has been created successfully.');
        $this->redirect('default');
    }
}
?>