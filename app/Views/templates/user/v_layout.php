<?php
echo $this->include('templates/user/v_header');
echo $this->include('templates/user/v_sidebar');
echo $this->include('templates/user/v_topbar');
echo $this->renderSection('content');
echo $this->include('templates/user/v_footer');
