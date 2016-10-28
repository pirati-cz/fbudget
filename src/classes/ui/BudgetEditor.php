<?php
namespace FlexiBudget\ui;

/**
 * Description of BudgetEditor
 *
 * @author vitex
 */
class BudgetEditor extends \Ease\TWB\Form
{
    /**
     * Budget object
     *
     * @var \FlexiBudget\Budget
     */
    public $budget = null;

    /**
     * Edit Form for Budget record
     *
     * @param \FlexiBudget\Budget $budget
     */
    public function __construct($budget)
    {
        $this->budget = $budget;
        $this->setTagID();
        parent::__construct('budget', null, 'post');
        $this->addItem($budget->inputWidget('name',
                ['minlength' => 5, 'maxlength' => 45, 'class' => 'required']));
//        $this->addItem($budget->inputWidget('description',
//                ['minlength' => 5, 'maxlength' => 45, 'class' => 'required']));
//        $this->addItem($budget->inputWidget('limit', ['class' => 'required']));
        $this->addItem($budget->inputWidget('approval_at',
                ['class' => 'required']));
        $id           = $budget->getMyKey();
        if (!is_null($id)) {
            $this->addItem(new \Ease\Html\InputHiddenTag('id', $id));
        }
        $this->addItem(new \Ease\TWB\SubmitButton(_('Save'), 'success'));
        $this->addItem(new \Ease\Html\JavaScript('$("#'.$this->getTagID().'").validate();'));
    }

    function finalize()
    {
        $this->includeJavaScript('js/jquery.validate.js');
    }
}