const URL = {
    CREATE: "/app/api/habits/crud/create.php?",
    UPDATE: "/app/api/habits/crud/update.php?",
    DELETE: "/app/api/habits/crud/delete.php?",
    READ: "/app/api/habits/crud/read.php?"
}

const CREATE = {
    ID: "create",
    Show: () => {
        document.getElementById(CREATE.ID).classList = ["modal show"];
    },
    Hide: () => {
        document.getElementById(CREATE.ID).classList = ["modal"];
    },
    Create: () => {
        const NAME = document.forms["create-form"]["habit-name"].value;
        const DESC = document.forms["create-form"]["habit-desc"].value;

        const FREQUENCY = {
            0: document.forms["create-form"]["mon"].checked,
            1: document.forms["create-form"]["tue"].checked,
            2: document.forms["create-form"]["wed"].checked,
            3: document.forms["create-form"]["thu"].checked, 
            4: document.forms["create-form"]["fri"].checked,
            5: document.forms["create-form"]["sat"].checked,
            6: document.forms["create-form"]["sun"].checked,
        }

        const Data = {
            habit_name: NAME,
            habit_desc: DESC,
            habit_freq: JSON.stringify(FREQUENCY),
        }
        
        fetch(URL.CREATE + new URLSearchParams(Data)).then(
            function(response) {
                if(response.status !== 200) {
                    alert("Error attempting to access " + URL.CREATE + new URLSearchParams(Data))
                    return;
                }

                response.text().then(function(data) {
                    if(data == "ok") {
                        location.reload();
                    } else {
                        alert("API Response returned error: " + data);
                    }
                })
            }
        )
    }
}

const EDIT = {
    ID: "edit",
    SELECTED_ID: null,
    Show: (id, name, desc) => {
        EDIT.SELECTED_ID = id;
        document.getElementById(EDIT.ID).classList = ["modal show"];
        document.forms["edit-form"]["habit-name"].value = name;
        document.forms["edit-form"]["habit-desc"].value = desc;
        
        // Get Habits From API Endpoint
        fetch(URL.READ + new URLSearchParams({id: id})).then(
            function(response) {
                if(response.status !== 200) {
                    alert("Error attempting to access: " + URL.READ + new URLSearchParams({id: id}));
                    return;
                }
                response.json().then(function(data) {
                    const freq = data[id].frequency;
                    
                    document.forms["edit-form"]["mon"].checked = freq[0];
                    document.forms["edit-form"]["tue"].checked = freq[1];
                    document.forms["edit-form"]["wed"].checked = freq[2];
                    document.forms["edit-form"]["thu"].checked = freq[3];
                    document.forms["edit-form"]["fri"].checked = freq[4];
                    document.forms["edit-form"]["sat"].checked = freq[5];
                    document.forms["edit-form"]["sun"].checked = freq[6];


                });
            }
        )
    },
    Hide: () => {
        document.getElementById(EDIT.ID).classList = ["modal"];
    },
    UPDATE: () => {
        const NAME = document.forms["edit-form"]["habit-name"].value;
        const DESC = document.forms["edit-form"]["habit-desc"].value;

        const FREQUENCY = {
            0: document.forms["edit-form"]["mon"].checked,
            1: document.forms["edit-form"]["tue"].checked,
            2: document.forms["edit-form"]["wed"].checked,
            3: document.forms["edit-form"]["thu"].checked, 
            4: document.forms["edit-form"]["fri"].checked,
            5: document.forms["edit-form"]["sat"].checked,
            6: document.forms["edit-form"]["sun"].checked,
        }

        const Data = {
            habit_name: NAME,
            habit_desc: DESC,
            habit_freq: JSON.stringify(FREQUENCY),
            habit_id: EDIT.SELECTED_ID,
        }
        
        fetch(URL.UPDATE + new URLSearchParams(Data)).then(
            function(response) {
                console.log(response);
                if(response.status !== 200) {
                    alert("Error attempting to access " + URL.UPDATE + new URLSearchParams(Data))
                    return;
                }
                response.text().then(function(data) {
                    console.log(data);
                    if(data == "ok" || data == "nothing changed") {
                        location.reload();
                        console.log(URL.UPDATE + new URLSearchParams(Data));
                    } else {
                        alert("API Response returned error: " + data);
                    }
                })
            }
        )
    },
    DELETE: () => {
        const Data = {
            habit_id: EDIT.SELECTED_ID,
        }

        console.log(Data);

        fetch(URL.DELETE + new URLSearchParams(Data)).then(
            function(response) {
                if(response.status !== 200) {
                    alert("Error attempting to access " + URL.DELETE + new URLSearchParams(Data));
                    return;
                }

                response.text().then(function(data) {
                    if(data == "ok") {
                        location.reload();
                        console.log(URL.DELETE + new URLSearchParams(Data));
                    } else {
                        alert("API Response returned error: " + data);
                    }
                });
            }
        )

    }
}

window.onload = () => {
    if(window.location.search.substr(1) == "create=1") {
        // Means that we should show the create habit page
        CREATE.Show();
    }    
}
