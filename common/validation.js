document.addEventListener("DOMContentLoaded", () => {
  const full_name = document.getElementById("full_name");
  const username = document.getElementById("username");
  const password = document.getElementById("password");
  const confirm_password = document.getElementById("confirm_password");
  const checkbox = document.getElementById("checkbox");
  const submit = document.getElementById("submit");
  
  const error_full_name = document.getElementById("error_full_name");
  const username_error = document.getElementById("error_username");
  const error_password = document.getElementById("error_password");
  const error_confirm_password = document.getElementById("error_confirm_password");

  full_name?.addEventListener("input", () => {
    const regex = /^[a-zA-Z\s]+$/;
    const value = full_name.value.trim();

    if (!regex.test(value)) {
      error_full_name.textContent = "Nama hanya boleh berisi huruf!";
    } else if (value.length < 5 || value.length > 30) {
      error_full_name.textContent = "Nama harus terdiri dari 5-30 karakter!";
    } else {
      error_full_name.textContent = "";
    }
  });

  username?.addEventListener("input", () => {
    const regex = /^[0-9]+$/;
    const value = username.value.trim();

    if (!regex.test(value)) {
      username_error.textContent = "Nama Pengguna hanya boleh berisi angka!";
    } else if (value.length < 5 || value.length > 30) {
      username_error.textContent = "Nama Pengguna harus terdiri dari 5-30 karakter!";
    } else {
      username_error.textContent = "";
    }
  });

  password?.addEventListener("input", () => {
    const regex = /^(?=.*[A-Z])(?=.*\d)[A-Za-z\d]{7,}$/;
    const value = password.value.trim();

    if (password.value.trim() === "") {
      error_password.textContent = "Bidang ini tidak boleh kosong!";
    } else if (!regex.test(value)) {
      error_password.textContent = "Kata sandi harus min. 7 karakter, 1 huruf besar & 1 angka!";
    } else {
      error_password.textContent = "";
    }
  });

  confirm_password?.addEventListener("input", () => {
    const value = confirm_password.value.trim();

    if (value !== password.value.trim()) {
      error_confirm_password.textContent = "Tidak cocok dengan kata sandi!";
    } else if (password.value.trim() === "") {
      error_confirm_password.textContent = "Bidang ini tidak boleh kosong!";
    } else {
      error_confirm_password.textContent = "";
    }
  });

  checkbox?.addEventListener("change", () => {
    if (checkbox.checked) {
      password.type = "text";
      confirm_password.type = "text";
    } else {
      password.type = "password";
      confirm_password.type = "password";
    }
  });

  submit?.addEventListener("click", (e) => e.preventDefault());
});