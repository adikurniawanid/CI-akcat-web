<?php
echo $this->extend('/exam/v_layout');
echo $this->section('content');
?>

<!-- Divider -->
<!-- Navigation -->
<table>
    <tr>
        <?php
        $page_button = 1;
        for ($i = 1; $i <= 50; $i++) : ?>
            <td style='text-align: center;'>
                <button class='jump btn btn-block btn-outline-light bg-secondary' id='button_$page_button' name='$page_button' type='button'>
                    <?= $page_button ?>
                </button>
            </td>
        <?php
            if ($page_button % 5 == 0) {
                echo "</tr>";
                echo "<tr>";
            }
            $page_button++;
        endfor ?>
    </tr>
</table>
<!--  -->

<?= $this->endSection(); ?>