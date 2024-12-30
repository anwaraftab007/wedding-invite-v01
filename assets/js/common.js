window.addEventListener("scroll", () => {
  const nav = document.querySelector("nav");
  const logo = nav.querySelector(".logo img");

  if (window.pageYOffset > 250) {
    nav.classList.add("shadow");
    logo.src = "./assets/images/logo-black.svg";
  } else {
    nav.classList.remove("shadow");

    logo.src = "./assets/images/logo-white.svg";
  }
});
