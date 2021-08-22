const URL = {
    CREATE: "/app/api/habits/create.php?"
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
