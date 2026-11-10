window.addEventListener("DOMContentLoaded", () => {
    const button =document.getElementById("lookup");
    const input = document.getElementById("country");
    const result = document.getElementById("result");

    button.addEventListener("click", () => {
        const country = input.value.trim();

        fetch("world.php?country=" + encodeURIComponent(country))
            .then(response =>{
                if(!response.ok) {
                    throw new Error("Network response was not ok");
                }
                return response.text();
            })
            .then(data => { 
                result.innerHTML = data;
            })
            .catch(error => {
                console.error("Error fetching country data:", error);
                result.innerHTML = "<p>Error fetching country data.</p>";
            });
    });
});