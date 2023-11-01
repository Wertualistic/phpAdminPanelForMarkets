let mylistgroups = document.querySelectorAll(".mylistgroup a");

mylistgroups.forEach((item) => {
  item.addEventListener("click", () => {
    item.children[0].classList.toggle("d-none");
  });
});


