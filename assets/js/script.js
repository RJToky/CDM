const links = document.querySelectorAll(".container > header > nav > ul > a");

links.forEach((link) => {
  link.addEventListener("click", (e) => {
    // e.preventDefault();

    links.forEach((link) => {
      if (link.classList.value === "active") {
        link.className = "";
      }
    });

    link.classList.add("active");
  });
});

const iconBar = document.querySelector(
  ".container > header > nav > .icon-bars"
);
const nav = document.querySelector(".container > header > nav");

iconBar.addEventListener("click", () => {
  nav.classList.toggle("active");
});
