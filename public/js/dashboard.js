const COMPLETE_LINK = "/app/api/habits/complete.php";

const Dashboard = {
    Complete: (id, element) => {
        const URL = COMPLETE_LINK + "?" + new URLSearchParams({
            habit_id: id,
        });

        console.log(URL);

        fetch(URL)
        .then(response => {
            if(response.redirected == true) { // In the event that the user has been logged out, redirect to the page that the api endpoint requests
                console.log("redirect");
                window.location.replace(response.url)
            }
            return response.text();
        })
        .then(data => {
            if(data == "ok") {
                // Refresh page to include updated content
                console.log(element);
                element.classList = ["completed"];

                // Update Text
                const Number = document.getElementById("completed-" + id);
                Number.innerText = (parseInt(Number.innerText) + 1).toString(); 
            } else {
                alert("Error: " + data);
            }
        });
    }
}