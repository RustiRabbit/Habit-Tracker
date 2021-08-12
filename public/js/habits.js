const CREATE_URL = "/app/api/habits/create.php";

const Edit = {
    Element: () => {
        return document.getElementById("edit");
    },
    Close: () => {
        console.log("Closing Modal");
        
        Edit.Element().className = "popup";
    },
    Open: (id, name, desc) => {
        console.log([
            id, name, desc
        ]);

        // Set Textboxes
        const Name = document.getElementById("edit-name").value = name;
        const Desc = document.getElementById("edit-description").value = desc;

        Edit.Element().className = "popup show";
    }
}

const New = {
    Element: () => {
        return document.getElementById("create");
    },
    Close: () => {
        New.Element().className = "popup";
    },
    Open: () => {
        // Clear Textboxes
        const Name = document.getElementById("new-name").value = "";
        const Desc = document.getElementById("new-description").value = "";

        New.Element().className = "popup show";
    },
    Create: () => {
        const Name = document.getElementById("new-name").value;
        const Desc = document.getElementById("new-description").value;

        const URL = CREATE_URL + "?" + new URLSearchParams({
            habit_name: Name,
            habit_desc: Desc
        });

        console.log(URL);

        fetch(URL)
        .then(response => {
            if(response.redirected == true) { // In the event that the user has been logged out, redirect to the page that the api endpoint requests
                console.log("redirect");
                window.location.replace(response.url)
            }
            return response.json();
        })
        .then(data => {
            if(data.message == "ok") {
                // Refresh page to include updated content
                location.reload();
            } else if(data.message == "error") {
                console.log("ERROR");
            }
        });
    }
}