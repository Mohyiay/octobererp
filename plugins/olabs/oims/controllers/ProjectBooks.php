<?php

namespace Olabs\Oims\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

class ProjectBooks extends Controller {

    public $implement = ['Backend\Behaviors\ListController', 'Backend\Behaviors\FormController', 'Backend\Behaviors\ReorderController'];
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';
    
    public $requiredPermissions = ['olabs.oims.project_books'];

    public function __construct() {
        parent::__construct();
        BackendMenu::setContext('Olabs.Oims', 'oims_projects', 'project_books');
    }

}
