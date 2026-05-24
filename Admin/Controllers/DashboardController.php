<?php

class DashboardController extends BaseController
{
    public function index(): void
    {
        $this->requireLogin();
        $this->render('dashboard.php');
    }
}
