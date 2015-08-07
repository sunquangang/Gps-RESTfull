<?php namespace App\Forms;

use Kris\LaravelFormBuilder\Form;

class CreateCategoryForm extends Form
{
    public function buildForm()
    {
        $this
            ->add('name', 'text', [
                'rules' => 'required|min:5'
            ])
            ->add('lyrics', 'textarea', [
                'rules' => 'max:5000'
            ])
            ->add('publish', 'checkbox');
    }
}