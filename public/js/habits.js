const Modal = {
    Element: () => {
        return document.getElementById("popup");
    },
    Close: () => {
        console.log("Closing Modal");
        
        Modal.Element().className = "popup";
    },
    Open: (id, name, desc) => {
        console.log(id);

        // Set Textboxes
        const Name = document.getElementById("name").value = name;
        const Desc = document.getElementById("name").value = desc;

        Modal.Element().className = "popup show";
    }
}