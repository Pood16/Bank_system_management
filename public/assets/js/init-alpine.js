function data() {
  function getThemeFromLocalStorage() {
    // if user already changed the theme, use it
    if (window.localStorage.getItem("dark")) {
      return JSON.parse(window.localStorage.getItem("dark"));
    }

    // else return their preferences
    return (
      !!window.matchMedia &&
      window.matchMedia("(prefers-color-scheme: dark)").matches
    );
  }

  function setThemeToLocalStorage(value) {
    window.localStorage.setItem("dark", value);
  }

  return {
    dark: getThemeFromLocalStorage(),
    toggleTheme() {
      this.dark = !this.dark;
      setThemeToLocalStorage(this.dark);
    },
    isSideMenuOpen: false,
    toggleSideMenu() {
      this.isSideMenuOpen = !this.isSideMenuOpen;
    },
    closeSideMenu() {
      this.isSideMenuOpen = false;
    },
    isNotificationsMenuOpen: false,
    toggleNotificationsMenu() {
      this.isNotificationsMenuOpen = !this.isNotificationsMenuOpen;
    },
    closeNotificationsMenu() {
      this.isNotificationsMenuOpen = false;
    },
    isProfileMenuOpen: false,
    toggleProfileMenu() {
      this.isProfileMenuOpen = !this.isProfileMenuOpen;
    },
    closeProfileMenu() {
      this.isProfileMenuOpen = false;
    },
    isPagesMenuOpen: false,
    togglePagesMenu() {
      this.isPagesMenuOpen = !this.isPagesMenuOpen;
    },
    // Modal
    isModalOpen: false,
    trapCleanup: null,
    openModal() {
      this.isModalOpen = true;
      this.trapCleanup = focusTrap(document.querySelector("#modal"));
    },
    closeModal() {
      this.isModalOpen = false;
      this.trapCleanup();
    },
    isModalTwoOpen: false,
    trapCleanupTwo: null,
    openModalTwo() {
      this.isModalTwoOpen = true;
      this.trapCleanupTwo = focusTrap(document.querySelector("#modal-two"));
    },
    closeModalTwo() {
      this.isModalTwoOpen = false;
      this.trapCleanupTwo();
    },
    isModal3Open: false,
    trapCleanup3: null,
    openModal3() {
      this.isModal3Open = true;
      this.trapCleanup3 = focusTrap(document.querySelector("#modal-3"));
    },
    closeModal3() {
      this.isModal3Open = false;
      this.trapCleanup3();
    },
  };
}
