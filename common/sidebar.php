<aside
    class="fixed left-0 top-0 h-screen w-fit border-r border-gray-200 bg-[#0242A6] shadow-md transition-all duration-300 ease-in-out md:w-60 lg:w-[17rem]">
    <img src="images/favicon.ico" alt="Logo Titib Polinema" class="mx-auto my-4 w-4/5" />
    <section class="flex flex-col gap-4 px-6 text-gray-600">
        <?php
        $sidebar_items = [
            ["gambar" => "images/home.png", "label" => "Dashboard", "url" => ""],
            ["gambar" => "images/form.png", "label" => "Form", "url" => "form"],
            ["gambar" => "images/class.png", "label" => "Class", "url" => "class"],
        ];
        foreach ($sidebar_items as $item) {
            ?>
            <div class="flex items-center justify-between">
                <a href="<?php echo $item["url"]; ?>" class="inline-flex items-center gap-3">
                    <img src="<?php echo $item["gambar"]; ?>" class="w-10 text-slate-50 text-xl" aria-hidden="true" />
                    <h3
                        class="group hidden text-lg text-slate-50 font-semibold transition-all duration-300 ease-in-out md:block">
                        <span
                            class="lg:bg-gradient-to-r lg:from-slate-50 lg:to-slate-50 lg:bg-[length:0%_0.125rem] lg:bg-left-bottom lg:bg-no-repeat lg:transition-all lg:duration-500 lg:ease-out lg:group-hover:bg-[length:100%_0.125rem]">
                            <?php echo $item["label"]; ?>
                        </span>
                    </h3>
                </a>
            </div>
            <?php
        }
        ?>
    </section>
</aside>