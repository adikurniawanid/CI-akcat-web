<?php
echo $this->include('templates/v_header');
echo $this->include('templates/v_sidebar');
echo $this->include('templates/v_topbar');
echo $this->renderSection('content');
echo $this->include('templates/v_footer');
