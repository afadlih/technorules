<aside class="fixed left-0 top-0 h-screen w-[5em] border-r border-gray-200 bg-[#0242a6] shadow-md transition-all duration-300 ease-in-out lg:w-[17rem] flex flex-col">
    <img src="/technorules/images/favicon.ico" alt="Logo Technorules Polinema" class="mx-auto my-4 w-4/5 hidden lg:flex" />
    <img src="/technorules/images/logo.svg" alt="Icon Technorules Polinema" class="mx-auto mt-4 mb-8 w-1/2 lg:hidden" />
    <section class="flex flex-col gap-6 px-6 text-gray-600 overflow-y-auto flex-1">
        <?php
        $sidebar_items = [
            ["gambar" => "/technorules/images/home.svg", "label" => "Dashboard", "url" => "/technorules/dpa"],
            ["gambar" => "/technorules/images/form.svg", "label" => "Form", "url" => "/technorules/dpa/form"],
            ["gambar" => "/technorules/images/class.svg", "label" => "Class", "url" => "/technorules/dpa/class"],
        ];
        foreach ($sidebar_items as $item) {
            ?>
            <div class="flex items-center justify-center lg:justify-between">
                <a href="<?php echo $item["url"]; ?>" class="inline-flex items-center gap-3">
                    <img src="<?php echo $item["gambar"]; ?>" class="h-10 w-10 p-1.5" />
                    <h3
                        class="group hidden text-lg text-slate-50 font-semibold transition-all duration-300 ease-in-out lg:block">
                        <span class="lg:bg-gradient-to-r lg:from-slate-50 lg:to-slate-50 lg:bg-[length:0%_0.125rem] lg:bg-left-bottom lg:bg-no-repeat lg:transition-all lg:duration-500 lg:ease-out lg:group-hover:bg-[length:100%_0.125rem]">
                            <?php echo $item["label"]; ?>
                        </span>
                    </h3>
                </a>
            </div>
            <?php
        }
        ?>
    </section>
    <section class="flex flex-col px-4 pt-2 pb-8">
        <a href="/technorules/dpa/profile" class="flex items-center justify-center w-full gap-3 bg-[#0a97ff] px-4 py-2 rounded-lg">
            <img src="/technorules/images/user.svg" alt="User" />
            <span class="text-white flex-1">
                <h5 class="font-bold">Malik S.T.,M.T.</h5>
                <h6 class="text-xs">Dosen</h6>
            </span>
        </a>
        <div class="mt-4 flex items-center justify-center w-full gap-3 bg-[#FF1111] px-4 py-3 rounded-lg cursor-pointer">
            <img src="/technorules/images/logout.svg" alt="Logout" />
            <h5 class="text-white flex-1 font-semibold">Keluar</h5>
        </div>
    </section>
</aside>
