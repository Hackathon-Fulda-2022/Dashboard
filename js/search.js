window.addEventListener("load", () => {
    // (A) GET HTML ELEMENTS
    var filter = document.getElementById("form1"), // search box
        list = document.querySelectorAll("#patient-list li"); // all list items

    // (B) ATTACH KEY UP LISTENER TO SEARCH BOX
    filter.onkeyup = () => {
        // (B1) GET CURRENT SEARCH TERM
        let search = filter.value.toLowerCase();

        // (B2) LOOP THROUGH LIST ITEMS - ONLY SHOW THOSE THAT MATCH SEARCH
        for (let i of list) {
            let item = i.innerHTML.toLowerCase();
            if (item.indexOf(search) == -1) { i.classList.add("hide"); }
            else { i.classList.remove("hide"); }
        }
    };
});