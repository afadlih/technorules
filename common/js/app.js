document.addEventListener("DOMContentLoaded", () => {
  const edit = document.querySelectorAll(".edit");
  const close = document.querySelectorAll(".close");
  const tebusan_pelanggaran = document.getElementById("tebusan-pelanggaran");
  let show = false;

  edit.forEach((e) => {
    e.addEventListener("click", () => {
      show = !show;
      tebusan_pelanggaran.style.display = show ? "block" : "none";
      document.body.style.overflow = show ? "hidden" : "auto";
    });
  });

  close.forEach((e) => {
    e.addEventListener("click", () => {
      show = !show;
      tebusan_pelanggaran.style.display = show ? "block" : "none";
      document.body.style.overflow = show ? "hidden" : "auto";
    });
  });
});