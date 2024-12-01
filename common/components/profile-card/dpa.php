<div class="mt-10 h-fit w-[90%] mx-auto rounded-xl px-8 cursor-default py-5 bg-[#0242a6] text-white">
    <h4 class="text-gray-100/90 text-lg font-semibold">Dashboard</h4>
    <span class="flex mt-3 mb-2">
        <h2 class="text-2xl font-bold">
            <?php
            echo isset($_SESSION["username"]) ? $_SESSION["username"] : "20765667383801";
            ?>
            /
            <?php
            echo isset($_SESSION["full_name"]) ? $_SESSION["full_name"] : "Malik S.T., M.T.";
            ?>
        </h2>
    </span>
</div>