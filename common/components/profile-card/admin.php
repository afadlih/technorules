<?php
require_once './controller/adminController.php';
?>

<div class="mt-10 h-fit w-[90%] mx-auto rounded-xl px-8 cursor-default py-5 bg-[#0242a6] text-white">
    <h4 class="text-gray-100/90 text-lg font-semibold">Dashboard</h4>
    <span class="flex mt-3 mb-2">
        <h2 class="text-2xl font-bold">
            <?php echo $data['nip']; ?>
            /
            <?php echo $data['name']; ?>
        </h2>
    </span>
</div>