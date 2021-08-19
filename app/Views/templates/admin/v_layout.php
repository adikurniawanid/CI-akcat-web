<?php
echo $this->include('templates/admin/v_header');
echo $this->include('templates/admin/v_sidebar');
echo $this->include('templates/admin/v_topbar');
echo $this->renderSection('content');
echo $this->include('templates/admin/v_footer');
