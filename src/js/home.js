document.addEventListener("DOMContentLoaded", (event) => {
    const burger_navigation = document.querySelector(".burger-navigation")
    const burger_button = document.querySelector(".burger-menu-button")
    const body = document.querySelector("body")
    console.log(body)
    let menu_open = false
    burger_button.addEventListener("click", (e) => {
        if (menu_open) {
            burger_navigation.style.display = 'none'
            body.style.overflowY = 'auto'
        } else {
            burger_navigation.style.display = 'block'
            body.style.overflowY = 'hidden'
            window.scrollBy(0, -100)
        }
        menu_open = !menu_open
    })
})