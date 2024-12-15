document.addEventListener('click', (event) => {
  const dropdowns = document.querySelectorAll('.dropdown');
  dropdowns.forEach((dropdown) => {
    const button = dropdown.querySelector('.dropdown-button');
    const caret = dropdown.querySelector('.dropdown-caret');
    const menu = dropdown.querySelector('.dropdown-menu');
    const selectedText = dropdown.querySelector('.dropdown-text-selected');
    const options = dropdown.querySelectorAll('.dropdown-menu li');

    const isClickInside = dropdown.contains(event.target);

    if (isClickInside) {
      button.classList.toggle('dropdown-button-clicked');
      caret.classList.toggle('dropdown-caret-rotate');
      menu.classList.toggle('dropdown-menu-open');
    } else {
      button.classList.remove('dropdown-button-clicked');
      caret.classList.remove('dropdown-caret-rotate');
      menu.classList.remove('dropdown-menu-open');
    }

    options.forEach((option) => {
      option.addEventListener('click', () => {
        selectedText.innerText = option.innerText;

        options.forEach((opt) => opt.classList.remove('dropdown-option-active'));
        option.classList.add('dropdown-option-active');

        button.classList.remove('dropdown-button-clicked');
        caret.classList.remove('dropdown-caret-rotate');
        menu.classList.remove('dropdown-menu-open');
      });
    });
  });
});

document.addEventListener("DOMContentLoaded", () => {
  const searchDropdowns = document.querySelectorAll(".search-dropdown");

  // Funcion para cerrar todos los menu desplegables
  const closeAllDropdowns = () => {
    searchDropdowns.forEach((dropdown) => {
      const menu = dropdown.querySelector(".search-dropdown-menu");
      const caret = dropdown.querySelector(".search-dropdown-caret");
      if (menu) menu.classList.remove("search-dropdown-menu-open");
      if (caret) caret.classList.remove("search-dropdown-caret-rotate");
    });
  };

  searchDropdowns.forEach((searchDropdown) => {
    const searchDropdownButton = searchDropdown.querySelector(".search-dropdown-button");
    const searchDropdownMenu = searchDropdown.querySelector(".search-dropdown-menu");
    const searchDropdownCaret = searchDropdownButton.querySelector(".search-dropdown-caret");
    const searchInput = searchDropdown.querySelector(".search-dropdown-input");
    const searchOptions = searchDropdown.querySelectorAll(".search-dropdown-options li");
    const selectedText = searchDropdown.querySelector(".search-dropdown-text-selected");

    // Mostrar/Ocultar el menú
    searchDropdownButton.addEventListener("click", (e) => {
      e.stopPropagation();
      // Cerrar todos los demás menús antes de abrir este
      closeAllDropdowns();
      searchDropdownMenu.classList.toggle("search-dropdown-menu-open");
      searchDropdownCaret.classList.toggle("search-dropdown-caret-rotate");
    });

    // Filtrar opciones
    searchInput.addEventListener("input", (e) => {
      const filter = e.target.value.toLowerCase();
      searchOptions.forEach((option) => {
        const text = option.textContent.toLowerCase();
        option.style.display = text.includes(filter) ? "block" : "none";
      });
    });

    // Seleccionar opcion
    searchOptions.forEach((option) => {
      option.addEventListener("click", () => {
        selectedText.textContent = option.textContent;
        searchDropdownMenu.classList.remove("search-dropdown-menu-open");
        searchDropdownCaret.classList.remove("search-dropdown-caret-rotate");
      });
    });

    // Cerrar el menu si se hace clic fuera
    document.addEventListener("click", (e) => {
      if (!searchDropdown.contains(e.target)) {
        searchDropdownMenu.classList.remove("search-dropdown-menu-open");
        searchDropdownCaret.classList.remove("search-dropdown-caret-rotate");
      }
    });
  });
});
