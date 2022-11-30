let darkMode = localStorage.getItem("darkMode");

const darkModeToggle = document.querySelector("#checkbox");
if (darkMode !== "enabled") {
    $(".logo-light").removeClass("d-none");
    $(".logo-dark").addClass("d-none");
    darkModeToggle.checked = true;
} else {
    $(".logo-light").addClass("d-none");
    $(".logo-dark").removeClass("d-none");
    darkModeToggle.checked = false;
}
const enableDarkMode = () => {
    // 1. Add the class to the body
    document.body.classList.add("darkmode");
    $("a").addClass("darkmode");

    // 2. Update darkMode in localStorage
    localStorage.setItem("darkMode", "enabled");
};

const disableDarkMode = () => {
    // 1. Remove the class from the body
    document.body.classList.remove("darkmode");
    $("a").removeClass("darkmode");

    // 2. Update darkMode in localStorage
    localStorage.setItem("darkMode", null);
};

// If the user already visited and enabled darkMode
// start things off with it on
if (darkMode === "enabled") {
    enableDarkMode();
}
// When someone clicks the button
darkModeToggle.addEventListener("click", () => {
    // get their darkMode setting
    darkMode = localStorage.getItem("darkMode");

    // if it not current enabled, enable it
    if (darkMode !== "enabled") {
        enableDarkMode();
        $(".logo-light").addClass("d-none");
        $(".logo-dark").removeClass("d-none");
        // if it has been enabled, turn it off
    } else {
        $(".logo-dark").addClass("d-none");
        $(".logo-light").removeClass("d-none");
        disableDarkMode();
    }
});
