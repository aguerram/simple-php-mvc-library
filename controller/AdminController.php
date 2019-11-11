<?php

    class AdminController extends Controller{
        public function start()
        {
            $this->middleware(["auth","admin"]);
        }
        public function indexGet()
        {
            $this->render("admin/index");
        }
    }