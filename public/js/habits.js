const Modal = {
    Element: () => {
        return document.getElementById("popup");
    },
    Close: () => {
        console.log("Closing Modal");
        
        Modal.Element().className = "popup";
    },
    Open: (id, name, desc) => {
        console.log([
            id, name, desc
        ]);

        // Set Textboxes
        const Name = document.getElementById("name").value = name;
        const Desc = document.getElementById("description").value = desc;

        Modal.Element().className = "popup show";
    }
}