<?php
echo $this->include('templates/exam/v_header');
echo $this->include('templates/exam/v_sidebar_exam');
// echo $this->include('templates/v_topbar');
echo $this->renderSection('content');
echo $this->include('templates/exam/v_footer');
